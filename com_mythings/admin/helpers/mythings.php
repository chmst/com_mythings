<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Helperklasse für die Komponente mythings
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;

class MyThingsHelper {

    /**
     * In der Listenansicht im Contenberich ein Submenü aufbauen
     * Damit ist ein Wechsel zwischen Kategorien und Things möglich.
     *
     * @param type $name
     */
    public static function addSubmenu($name) {

        /* Tab "MyThings" */
        JSubMenuHelper::addEntry(
            JText::_('COM_MYTHINGS_SUBMENU_MYTHINGS'),
            'index.php?option=com_mythings&view=mythings', $name == 'mythings'
        );

        /* Tab "Kategorien" */
        JSubMenuHelper::addEntry(
            JText::_('COM_MYTHINGS_SUBMENU_CATEGORIES'),
            'index.php?option=com_categories&extension=com_mythings', $name == 'categories'
        );

        /*
         * Auf der Listenansicht der Kategorien wird der normale Seitentitel
         * "Kategorien" erweitert mit dem Namen unserer Komponente
         */
        if ($name == 'categories') {
            JToolBarHelper::title(
                JText::sprintf('COM_MYTHINGS_CATEGORIES_TITLE',
                    JText::_('com_mythings')), 'mythings-categories');
        }
    }

    /**
     * Diese Methode baut ein Werteobjekt auf mit den Namen aller
     * Aktionen, die in der access.xml definiert sind und gibt bei
     * jeder Aktion an, ob sie der Benutzer ausführen darf.
     *
     * @param  int $categoryId
     * @return JObject
     */
    public static function getActions($categoryId = 0) {

        /* Der User, der gerade aktiv ist und dessen Berechtigungen ermittelt werden */
        $user = JFactory::getUser();

        /* Falls eine categoryId übergeben wurde, ist sie unser Asset */
        if (empty($categoryId)) {
            $assetName = 'com_mythings';
        } else {
            $assetName = 'com_mythings.category.' . (int) $categoryId;
        }

        /* Das Ausgabeobjekt wird neu angelegt */
        $result = new JObject;

        /* Die Aktionen einlesen, die bei MyThings möglich sind */
        $actions =  JAccess::getActions('com_mythings');

        // Für jede Aktion wird geprüft, ob der User authorisiert ist,
        // diese auszuführen (TRUE/FASLE)
        foreach ($actions as $action) {
            $result->set($action->name, $user->authorise($action, $assetName));
        }

        return $result;
    }

}
