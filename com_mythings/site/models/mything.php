<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Datenmodell, Ausgabe eines einzelnen Items
 *
 * @package    Mythings
 * @subpackage Mythings.Frontend
 * @author     webmechanic.biz, chmst.de
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;


/**
 * Erweiterung der Basisklasse JModel
 */
class MyThingsModelMyThing extends JModelForm
{
    /**
    * Daten aus der Datenbank lesen
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

        $params = $this->getState('params');

      }

	  /* Übergabe des Ergebnisobjekts an die View */
      return $result;
    }

  /**
   * Abstrakte Methode getForm() überschreiben, um Formularfelder
   * anhand der XML-Beschreibung (/forms/mything.xml) dieses Models
   * zu generieren.
   *
   * @return JForm oder false wenn das XML fehlt/nicht korrekt ist
   * @uses JModelForm::loadForm()
   */
  public function getForm($data = array(), $loadData = true)
  {
    // Angaben zu den HTML-Elementen
    $options = array('control' => 'jform', 'load_data' => $loadData);
    $form    = $this->loadForm('mythings', 'mything', $options);
    if (empty($form)) {
      return false;
    }

    return $form;
  }

  /**
   * Ermittelt die Daten für das Formular aus einem vorherigen
   * Dialogschritt (passiert bei einem Eingabefehler) oder dem
   * aktuellen Datensatz.
   *
   * @return object Datensatz oder Eingaben aus vorherigem Dialogschritt
   */
  protected function loadFormData()
  {
    /* Daten aus dem Sitzungsspeicher holen sofern vorhanden */
    $app  = JFactory::getApplication();
    $data = $app->getUserState('com_mythings.lend.mything.data', array());

    /* ggf. Datensatz aus der Tabelle einlesen */
    if (empty($data)) {
      $data = $this->getItem();
	}
    return $data;
  }
}
