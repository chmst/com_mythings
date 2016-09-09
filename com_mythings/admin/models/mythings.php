<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Das Model MyThings liefert Daten für die Übersicht
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPL
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.modellist');

/**
 * Erweiterung der Klasse JModelList, abgeleitet von JModel
 */
class MyThingsModelMyThings extends JModelList
{
  /**
   * Konstruktor - legt die Filter-Felder fest, die bei Sortierung
   * und Suche verwendet werden
   */
  public function __construct($config = array())
  {
    if (empty($config['filter_fields'])) {
      $config['filter_fields'] = array(
              'id', 'owner', 'category', 'title', 'lent_from', 'lent_by');
    }

    parent::__construct($config);
  }

  /*
   * Ergänzungen zum Setzen des "Datenzustandes" (state) des Models
   * damit der Suchfilter nicht verloren geht. Standard: sortiert
   * nach title, aufsteigend
   *
   * @param string $ordering  Tabellenspalte nach der sortiert wird
   * @param string $direction Sortierrichtung, ASC = aufsteigend
   * @see JModelList::populateState()
   */
  protected function populateState($ordering = 'title', $direction = 'ASC')
  {
  	/* Suchbegriff aus vorheriger Eingabe ermitteln */
    $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search', '', 'string');

    /* Suchbegriff für diese Ausgabe setzen */
    $this->setState('filter.search', $search);

    /* Auswahl des Benutzers in der Kategorie-Auswahl, übertragen in das state-Objekt */
    $categoryId = $this->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id', '');
    $this->setState('filter.category_id', $categoryId);

	/* Sortieren wird netterweise von der Elternklasse übernommen */
    parent::populateState($ordering, $direction);
  }

  /**
   * Ident-Schlüssel für den aktuellen Datenzustand anpassen,
   * damit eine gleichzeitige Suche in anderen Fenstern nicht
   * zu Verwechslungen führt.
   *
   * @see JModelList::getStoreId()
   */
  protected function getStoreId($id = '')
  {
    $id	.= ':'.$this->getState('filter.search');
    $id .= ':'.$this->getState('filter.category_id');

    return parent::getStoreId($id);
  }

  /**
   * Datenbankabfrage für die Listenansicht aufbauen.
   * Suchfilter und Sortierung werden berücksichtigt, ansonsten
   * wird aufsteigend nach `title` sortiert.
   *
   * @return JDatabaseQuery
   */
  protected function getListQuery()
  {
    /* Referenz auf das Datenbankobjekt */
    $db = $this->getDbo();

    /* Ein neues, leeres JDatabaseQuery-Objekt anfordern */
    $query	= $db->getQuery(true);

    /* Select-Anfrage aufbauen: Basis ist die Tabelle #__mythings */
    $query->from('#__mythings AS a');

    /* Alle Spalten von #__mythings auswählen */
    $query->select('a.*' );

    /*
     * Benutzernamen zu den owner_id aus #__users ermitteln,
     * über einen left join
     */
    $query->select('u.username AS owner');
    $query->join('LEFT', '#__users AS u ON u.id = a.owner_id');

    /*
     * Benutzernamen zu den lent_by_id aus #__users ermitteln,
     * über einen left join
     */
    $query->select('v.username AS lent_by');
    $query->join('LEFT', '#__users AS v ON v.id = a.lent_by_id');

    /*
     * Kategorienamen zu den category_id aus #__categories ermitteln,
     * über einen left join
     */
    $query->select('c.title AS category');
    $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');

    /* Auswahl des Anwenders im Kategoriefilter ermitteln */
    $categoryId = $this->getState('filter.category_id');

    /*
     * Wenn der Anwender eine Kategorie gewählt hat, ist der Wert numerisch
     * Suche einschränken auf diese category_id
     */
    if (is_numeric($categoryId)) {
        $query->where('a.category_id = '.(int) $categoryId);
    }

    /* Falls eine Eingabe im Suchfeld steht: Suche ergänzen */
    $search = $this->getState('filter.search');

    if (!empty($search)) {

      /* Um code-injection vorzubeugen haben wir hier quote() verwendent */
      $s = $db->quote('%'.$db->escape($search, true).'%');
      $query->where('a.title LIKE '. $s .' OR u.username LIKE '. $s .' OR c.title LIKE '. $s .' OR v.username LIKE '. $s);
    }

    /* Abfrage um die Sortierangaben ergänzen, Standardwert ist angegeben */
    $sort  = $this->getState('list.ordering', 'title');
    $order = $this->getState('list.direction', 'ASC');

    $query->order($db->escape($sort).' '.$db->escape($order));

    /* Fertig ist die Abfrage */
    return $query;
  }
}
