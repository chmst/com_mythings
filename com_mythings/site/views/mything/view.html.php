<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Detailansicht von com_mythings im Frontend.
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 */
defined('_JEXEC') or die;

/**
 * Erweiterung der Basisklasse JView zur Anzeige der Detailansicht
 */
class MyThingsViewMyThing extends JViewLegacy
{
	/* Der Datensatz */
    protected $item;

    /* Die Parameter */
    protected $params;

    /* Für den Ausleihvorgang: form */
    protected $form;


    /**
    * Überschreiben der Methode display
    *
    * @param string $tpl alternative Layoutdatei, leer = 'default'
    */
    function display($tpl = null)
    {
        /* getItem() aus JModelList aufrufen */
        $this->item	= $this->get('Item');

        /* getForm() aus JModelForm aufrufen */
        $this->form	= $this->get('Form');

        /* Parameter aus dem item in ein Array umwandeln */
        $params = new JRegistry();
        $params->loadString($this->item->params);

        /* Die globalen Komponentenparameter holen */
        $temp = JComponentHelper::getParams('com_mythings');

        /*
        * Die Parameter des items mit den globalen Parametern
        * zusammenführen, und die globalen Parameter
        * dabei überschreiben
        */
        $temp->merge($params);

        /* Jetzt haben wir die aktuellen Parameter */
        $this->params = $temp;

        /* Fehler abfangen, duie beim Aufbau der View aufgetreten sind  */
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

        /* Triggern des Event onMythingDisplay */
        JPluginHelper::importPlugin('mythings');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onMythingDisplay',
            array ('com_mythings.mything', &$this->item, &$this->params));

		parent::display($tpl);
    }
}
