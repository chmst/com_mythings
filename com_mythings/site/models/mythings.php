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

    /* Das Abfrageobjekt zurückgeben */
    return $query;
  }

}
