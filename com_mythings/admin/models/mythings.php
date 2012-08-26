<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
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
              'id', 'owner','category','title','lent_by','lent'
      );
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

    return parent::getStoreId($id);
  }

  /**
   * Datenbankabfrage für die Listenansicht aufbauen.
   * Suchfilter und Sortierung werden berücksichtigt, ansonsten
   * wird aufsteigend nach `bezeichnung` sortiert.
   *
   * @return JDatabaseQuery
   */
  protected function getListQuery()
  {
    /* Referenz auf das Datenbankobjekt */
    $db	= $this->getDbo();

    /* Ein neues, leeres JDatabaseQuery-Objekt anfordern */
    $query	= $db->getQuery(true);

    /* Select-Abfrage in der Standardform aufbauen */
    $query->select('*')->from('#__mythings');

    /* Falls eine Eingabe im Filterfeld steht: Abfrage um eine WHERE-Klausel ergänzen */
    $search = $this->getState('filter.search');
    if (!empty($search)) {
		$s = $db->quote('%'.$db->escape($search, true).'%');
		$query->where('title LIKE ' .$s .'OR '
					  'owner LIKE ' .$s .'OR '
					  'title LIKE ' .$s .'OR '
					  'lent_by LIKE ' .$s);
    }

    /* Abfrage um die Sortierangaben ergänzen, Standardwert ist angegeben */
    $sort  = $this->getState('list.ordering', 'title');
    $order = $this->getState('list.direction', 'ASC');
    $query->order($db->escape($sort).' '.$db->escape($order));

    /* Fertig ist die Abfrage */
    return $query;
  }
}
