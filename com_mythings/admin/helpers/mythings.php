<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
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


}
