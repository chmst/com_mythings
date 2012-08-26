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
