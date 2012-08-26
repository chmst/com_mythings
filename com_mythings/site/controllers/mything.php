<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Controller für das Formular MyThing
 *
 * @package    Frontend
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');

/**
 * Der Controller steuert das Formular MyThing
 */
class MyThingsControllerMyThing extends JControllerForm
{
	/**
	 * Tabelle `mythings` instanziieren.
	 *
	 * @return MyThingsTable
	 */
	public function getTable($type = 'MyThings', $prefix = 'MyThingsTable', $config = array())
	{
		/* Tabellen-Klassen sind im Backend zuhause. Pfad angeben */
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');

		/* Instanz der Tabelle wird zurückgegeben */
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Der Ausleihvorgang
	 */
	public function lend()
	{
		/* Sicherstellen, dass die Eingabe wirklich aus dem Formular kommt */
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		/* Die Eingaben ins Formular stehen im Inputbereich */
		$input = JFactory::getApplication()->get('input');

		/* Die Eingaben als Array aus jform des Input-Bereichs holen */
		$data = $input->get('jform', array(), 'post', 'array');

		/* Die id des Benutzers als Ausleiher-id in das Array der Daten eintragen */
		$data['lent_by_id'] = JFactory::getUser()->id;

		/* Es geht stets zurück zur Übersicht */
		$this->redirect = 'index.php?option=com_mythings&view=mythings';

		try
		{
			/* Daten übergeben und speichern */
			$table = $this->getTable();

			if ($table->save($data)) {
				// Erfolgsmeldung
				$this->message = JText::_('Ausleihe erfolgreich');
			} else {
				// altmodischer JError-Fehler aus JTable
				$this->message = JText::_( $table->getError() );
			}
		}
		catch(Exception $e)
		{
			// Meldung aus dem Ausnahmefehler
			$this->message = $e->getMessage();
		}

		/* Zurück zur Übersicht */
		$this->redirect();
	}

}
