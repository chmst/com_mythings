<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Standard-Ansicht com_mythings im Frontend.
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license       GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/**
 * Erweiterung der Basisklasse JView
 */
class MyThingsViewMyThings extends JViewLegacy
{
	/**
	 * Die Tabellenzeilen für den mittleren Teil der View
	 * @var object $items
	 */
	protected $items;

	/**
	 * Die Daten für die Blätterfunktion
	 * @var object $pagination
	 */
	protected $pagination;

	/**
	 * Die Daten der aktuellen Session
	 * @var object $state
	 */
	protected $state;

	/**
	 * Die Menü-Parameter
	 * @var object $params
	 */
	protected $params;

	/**
	 * Überschreiben der Methode display
	 *
	 * @param string $tpl Alternative Layoutdatei, leer = 'default'
	 */
	function display($tpl = null)
	{
		/* Die Datensätze mit getItems() aus JModelList aufrufen */
		$this->items = $this->get('Items');

		/* Statusinformationen, für die  Sortierung */
		$this->state = $this->get('State');

		/* Daten für die Blätterfunktion  */
		$this->pagination = $this->get('Pagination');


		/* Die Parameter */
		$this->params = $this->state->get('params');

		/* Fehler abfangen, die beim Aufbau der View aufgetreten sind  */
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}


		JPluginHelper::importPlugin('mythings');
		$num_items = count($this->items);
		$dispatcher = JDispatcher::getInstance();
		$result = $dispatcher->trigger('onMythingsBeforeDisplay',
			array('com_mythings.mythings', $num_items));
		// ins Template
		$this->before_display = implode("\n", $result);

		if ($num_items > 0) {
			foreach ($this->items as $item) {
				$dispatcher->trigger('onMythingsDisplay',
					array('com_mythings.mythings', &$item, $this->params));
			}
		}

		/* View ausgeben - zurückdelegiert an die Elternklasse */
		parent::display($tpl);
	}
}
