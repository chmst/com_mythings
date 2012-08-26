<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Detailansicht von com_mythings im Frontend.
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/*/* Import der Basisklasse JView */
jimport('joomla.application.component.view');

/**
 * Erweiterung der Basisklasse JView zur Anzeige der Detailansicht
 */
class MyThingsViewMyThing extends JView
{
	/* Der Datensatz */
    protected $item;

	/**
	* Überschreiben der Methode display
	*
	* @param string $tpl alternative Layoutdatei, leer = 'default'
	*/
    function display($tpl = null)
    {
	    /* getItem() aus JModelList aufrufen */
        $this->item	= $this->get('Item');

        /* View ausgeben - zurückdelegiert an die Elternklasse */
        parent::display($tpl);
    }
}
