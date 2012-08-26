<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * View Mything - Formularansicht zur Bearbeitung eines Items
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license	  GNU/GPL
 */
defined('_JEXEC') or die;

/* Import der Basisklasse JView */
jimport('joomla.application.component.view');

/**
 * Erweiterung der Basisklasse JView
 */
class MyThingsViewMyThing extends JView
{
   /**
    * Der Datensatz, der angezeigt bzw. bearbeitet wird
    * @var object $item
    */
    protected $item;

   /**
    * Das Formular
    * @var object $form
    */
    protected $form;

	/**
	 * Die Methode display wird überschrieben, um den für die
	 * Formularansicht verwendeten Datensatz bereitzustellen.
	 *
	 * @param string $tpl Alternative Layoutdatei, leer = 'default'
	 */
	public function display($tpl = null)
	{
		/* Sperren des Hauptmenus */
		JFactory::getApplication()->input->set('hidemainmenu', true);

		/* Das Form-Objekt wird aufgebaut */
		$this->form = $this->get('Form');

		/* Bei Änderung: Der Datensatz wird aus der Datenbank geholt*/
		$this->item = $this->get('Item');

        /* Fehler abfangen, die beim Aufbau der View aufgetreten sind  */
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('/n', $errors));
        }

		/* Aufruf der Funktion für die Toolbar*/
		$this->addToolbar();

		/* Ausgabe des View-Templates delegieren an die Elternklasse */
		parent::display($tpl);
    }

	/**
	 * Seitentitel und Werkzeugleiste aufbauen
	 */
	protected function addToolbar()
	{
		/* Der Toolbar-Titel wird gesetzt: Neuaufnahme oder Änderung */
        $isNew	= ($this->item->id == 0);
        if ($isNew) {
            JToolBarHelper::title(JText::_('COM_MYTHINGS_NEW'));
        } else {
            JToolBarHelper::title(JText::_('COM_MYTHINGS_CHANGE'));
        }

        /* Speichern */
		JToolBarHelper::apply('mything.apply', 'JTOOLBAR_APPLY');

		/* Speichern und Schließen Controller mything */
		JToolBarHelper::save('mything.save', 'JTOOLBAR_SAVE');

        /*
         * Um einen neuen Satz zu speichern muss der
         * Benutzer die Berechtigung haben, die Kategorie zu ändern
         */
        $user = JFactory::getUser();
        if (count($user->getAuthorisedCategories('com_mythings', 'core.create') > 0)) {
            JToolBarHelper::save2new('mything.save2new');
            if (!$isNew) {
				/* Button "als Kopie speichern". Kein spezielles Icon ausgewählt */
                JToolBarHelper::save2copy('mything.save2copy');
            }
        }

        /* Button cancel; Controller mything */
        JToolBarHelper::cancel('mything.cancel');
    }
}

