<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Allgemeiner Controller der Komponente mythings
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;

/* helperklasse dem JLoader melden, bei Bedarf wird sie schell geladen */
JLoader::register('MyThingsHelper', JPATH_COMPONENT . '/helpers/mythings.php');

/**
 * Erweiterung der Basisklasse JController
 */
class MyThingsController extends JControllerLegacy
{
	/**
	 * @var string Standardview
	 */
	protected $default_view = 'mythings';

	/**
	 * Ausgabe der View mythings.
	 * @inherit
	 */
	public function display($cachable = false, $urlparams = false)
	{
		/* @var $input JInput Unsere Einnahmequelle */
		$input = JFactory::getApplication()->input;

		// alle Variablen mit Vorgabewerten initialisieren
		$view   = $input->get('view', $this->default_view);
		$layout = $input->get('layout', 'default');
		$id     = $input->get('id');

		// Bevor die View aufgebaut wird, erstellt die Helperklasse
		// ein Untermenü zum Wechseln zwischen Categories und Things
		MyThingsHelper::addSubmenu($view);

		if ($view == 'mything' && $layout == 'edit')
		{
			// checkEditId() ist eine Methode von JController, die den Kontext prüft
			if (!$this->checkEditId('com_mythings.edit.mything', $id)) {
				// Kommentarlos zurück zur default-view
				$this->setRedirect(JRoute::_('index.php?option=com_mythings&view=mythings', false));
				return false;
			}
		}

		// Alles geprüft und ok, die View kann ausgegeben werden
		parent::display($cachable, $urlparams);
	}
}
