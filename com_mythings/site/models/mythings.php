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
             'category','title','lent_by','lent');
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
    $app = JFactory::getApplication();

	// Sortierung aus der angeklickten Tabellenspalte
	$ordering  = $app->input->get('filter_order', $ordering);
	$direction = $app->input->get('filter_order_Dir', $direction);

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
    $query->from('#__mythings');

    /* Alle Tabellenspalte anfordern `*/
    $query->select('*');

	/* Abfrage um die Sortierangaben ergänzen */
	$sort  = $this->getState('list.ordering');
	$order = $this->getState('list.direction');
	$query->order($db->escape($sort).' '.$db->escape($order));

    /* Das Abfrageobjekt zurückgeben */
    return $query;
  }

}
