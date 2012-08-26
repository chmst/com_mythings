<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Einstiegspunkt im Backend
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPL
 */
defined('_JEXEC') or die;
JLoader::import('joomla.application.component.controller');


/* Nur Benutzer mit der Berechtigung 'manage' dürfen zugreifen */
if (!JFactory::getUser()->authorise('core.manage', 'com_mythings')) {
	return JError::raiseWarning(403, JText::_('JERROR_MYTHINGS_NO_ACCESS'));
}

/* Einstieg in die Komponente - MyThingsController instanziieren */
$controller	= JController::getInstance('mythings');

/* Das Anwendungsobjekt holen  */
$app = JFactory::getApplication();

/* Aufgabe (task) ausführen. Hier ist das die Ausgabe der Standardview */
$controller->execute($app->input->get('task'));

/* Dialogsteuerung */
$controller->redirect();
