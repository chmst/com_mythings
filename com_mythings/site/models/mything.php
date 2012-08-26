<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
* Datenmodell, Ausgabe eines einzelnen Items
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/* Import der Basisklasse JModelItem für genau einen Datensatz */
jimport('joomla.application.component.modelitem');

/**
 * Erweiterung der Basisklasse JModelItem
 */
class MyThingsModelMyThing extends JModelItem
{
  /**
   * Die Methode wird überschrieben, um den Tabellennamen und die
   * benötigten Spalten anzugeben.
   *
   * @return $result - Ergebnis der Datenbankabfrage
   */
    public function getItem()
    {

	  /* Applikationspbjekt anfpordern  */
      $app = JFactory::getApplication();

	  /* Die Id des Datensatzes, den der Benutzer angeklicht hat  */
      $requested_id = $app->input->get('id', 0, 'int');


      if ($requested_id > 0) {

	    /* Datenbankanschluss */
        $db = $this->getDbo();

	    /* Neues Datenbankabfrage-Objekt besorgen  */
        $query = $db->getQuery(true);

	    /* Datenbankabfrage aufbauen */
        $query->from('#__mythings');
        $query->select('*');
        $query->where('id = ' .$requested_id );

		/* Datenbankabfrage an die Datenbank übergeben */
        $db->setQuery($query);

		/* und ausführen. Das Ergebnis ist ein Objekt */
        $result = $db->loadObject();

      }
	  /* Übergabe des Ergebnisobjekts an die View */
      return $result;
    }
}
