<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Standard-Ansicht com_mythings im Backend.
 *
 * @package    Mythings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/* Import der Basisklasse JView */
jimport('joomla.application.component.view');

/**
 * Erweiterung der Basisklasse JView
 */
class MyThingsViewMyThings extends JView
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
   * Die Konfiguration
   * @var object $cparams
   */
  protected $cparams;

  /**
   * Überschreiben der Methode display
   *
   * @param string $tpl Alternative Layoutdatei, leer = 'default'
   */
    function display($tpl = null)
    {
        /* JView holt die Daten vom Model */

        /* Die Datensätze aus der Tabelle mythings */
        $this->items		= $this->get('Items');

        /* Statusinformationen für die Sortierung */
        $this->state		= $this->get('State');

        /* Daten für die Blätterfunktion  */
        $this->pagination	= $this->get('Pagination');

        /* Aufbau der Toolbar */
        $this->addToolbar();

        /* View ausgeben - zurückdelegiert an die Elternklasse */
        parent::display($tpl);
    }

    /**
     * Aufbau der Toolbar, es werden nur die Buttons eingefügt,
     * für die der Benutzer eine Berechtigung hat.
     */
    protected function addToolbar()
    {

        /* Links oben der Titel */
        JToolBarHelper::title(JText::_('COM_MYTHINGS_ADMIN'));

        /* Button addNew;  Ein Datensatz, daher Controller mything, task add */
        JToolBarHelper::addNew('mything.add', 'JTOOLBAR_NEW');

        /* Button editList;  Ein Datensatz, daher Controller mything, task edit */
        JToolBarHelper::editList('mything.edit', 'JTOOLBAR_EDIT');

        /* Button delete, kann sich auf mehrere Datensätze beziehen, daher mythings */
        JToolBarHelper::deleteList('', 'mythings.delete', 'JTOOLBAR_DELETE');

        /* Button "Optionen" nur zeigen wenn der Benutzer die Berechtigung hat */
        JToolBarHelper::preferences('com_mythings');

    }

}
