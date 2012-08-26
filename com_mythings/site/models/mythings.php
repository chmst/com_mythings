<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Datenmodell, Listenausgabe der vorhandenen Daten
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/* Import der Basisklasse JModelList */
jimport('joomla.application.component.modellist');

/**
 * Erweiterung der Basisklasse JModelList
 */
class MyThingsModelMyThings extends JModelList
{
 /**
 * Konstruktor - legt die Sortier-Felder fest
 */
  public function __construct($config = array())
  {
    if (empty($config['filter_fields'])) {
      $config['filter_fields'] = array(
             'category','title','lent_by','lent_from');
    }
    parent::__construct($config);
  }

  /**
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
    /* Den aktuellen Menüpunkt ermitteln, er entält die Parameter */
    $menu = JFactory::getApplication()->getMenu();
    $menu_item = $menu->getActive();

    /* Die globalen Parameter der Komponente ermitteln */
    $temp = JComponentHelper::getParams('com_mythings');

    /* Globale Parameter und Menüparameter usammenführen */
    if ($menu_item) {
        $temp->merge($menu_item->params);
    }

    /* Danach hat man die Sortierrichtung und das Sortierfeld*/
    $ordering  = $temp->get('ordercol', $ordering);
    $direction = $temp->get('orderdir', $direction);

    /* Sortieren wird netterweise von der Elternklasse übernommen */
    parent::populateState($ordering, $direction);
  }

  /**
   * Die Methode wird überschrieben, um den Tabellennamen und die
   * benötigten Spalten anzugeben.
   *
   * @return JDatabaseQuery für die Abfrage der Datentabelle
   */
  protected function getListQuery()
  {
    /* Neue JDatabaseQuery für die Abfrage der Datensätze anfordern */
    $db = $this->getDbo();
    $query = $db->getQuery(true);

    /* Name der Tabelle für die Komponente */
    $query->from('#__mythings AS a');

    /* Alle Tabellenspalte anfordern `*/
    $query->select('a.*');

    /* Kategorien aus '#__categories als left join */
    $query->select('c.title AS category');
    $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');

    /* Benutzernamen zu  lent_by_id aus #__users ermitteln, */
    $query->select('v.username AS lent_by');
    $query->join('LEFT', '#__users AS v ON v.id = a.lent_by_id');

	/* Abfrage um die Sortierangaben ergänzen */
	$sort  = $this->getState('list.ordering');
	$order = $this->getState('list.direction');
	$query->order($db->escape($sort).' '.$db->escape($order));


    /* Das Abfrageobjekt zurückgeben */
    return $query;
  }

}
