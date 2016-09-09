<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Einstiegspunkt im Frontend
 * @package    	Frontend
 * @subpackage  com_mythings
 * @author      chmst.de, webmechanic.biz
 * @license	    GNU/GPL
 */
defined('_JEXEC') or die;

/* Einstieg in die Komponente - MyThingsController instanziieren */
$controller	= JControllerLegacy::getInstance('mythings');

/* Eingabe des Applikationsobjekts besorgen */
$input = JFactory::getApplication()->input;

/* Aufgabe (task) ausführen. Hier ist das die Ausgabe des Standardviews */
$controller->execute($input->get('task'));

/* Dialogsteuerung */
$controller->redirect();
