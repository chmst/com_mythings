<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Standard-Ansicht com_mythings im Frontend.
 *
 * @package    Mythings
 * @subpackage Frontend
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
   * Überschreiben der Methode display
   *
   * @param string $tpl Alternative Layoutdatei, leer = 'default'
   */
  function display($tpl = null)
  {

    /* Die Datensätze mit getItems() aus JModelList aufrufen */
    $this->items = $this->get('Items');

    /* View ausgeben - zurückdelegiert an die Elternklasse */
    parent::display($tpl);
  }
}
