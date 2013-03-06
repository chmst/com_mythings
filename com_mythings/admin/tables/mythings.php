<?php
/**
* Joomla! 2.5 - Erweiterungen programmieren
*
* Tabelle Mythings
*
* @package    MyThings
* @subpackage Backend
* @author     chmst.de, webmechanic.biz
* @license    GNU/GPL
*/
defined('_JEXEC') or die;

/**
* Erweiterung der Klasse JTable
*/
class MyThingsTableMyThings extends JTable
{
	/**
	* @var int $id Primärschlüssel
	*/
	public $id;

	/**
	* @var int $asset_id Primärschlüssel des asset-Sates
	*/
	public $asset_id;

	/**
	* Jedes Ding hat einen Besitzer
	* @var integer $owner_id - verweist auf einen Eintrag in #__users
	*/
	public $owner_id;

	/**
	* Ein Oberbegriff für das Ding
	* @var integer $category_id - verweist auf einen Eintrag in #__category
	*/
	public $category_id;

	/**
	* @var string $title - Benennung, Kurzbezeichnung
	*/
	public $title;

	/**
	* @var string $description - kann ausführlich ausfallen
	*/
	public $description;

	/**
	* @var string $state - Zustand : neuwertig, beschädigt etc.
	*/
	public $state;

	/**
	* @var string $value - Wert
	*/
	public $value;

	/**
	* @var string $weight - Gewicht
	*/
	public $weight;

	/**
	* @var string $img - Dateiname für ein hochgeladenes Bild
	*/
	public $img;

	/**
	* @var string $lent_from - Ausleihdatum
	*/
	public $lent_from;

	/**
	* @var string $lent_to - Rückgabedatum
	*/
	public $lent_to;

	/**
	* @var string $lent_by_id - User_id der ausleihenden Person
	*/
	public $lent_by_id;

	/**
	* @var string $hits - So oft wurde die Detailansicht aufgerufen
	*/
	public $hits;

	/**
	* @var string $params - Konfigurationsparameter im JSON-Format
	*/
	public $params;

    /**
    * Konstruktor setzt Tabellenname, Primärschlüssel und das
    * übergebene Datenbankobjekt.
    */
    public function __construct($db)
    {
        parent::__construct('#__mythings', 'id', $db);
    }

    /**
    * Überschreiben der Methode bind von JTable
    */
    public function bind($array, $ignore = '')
    {
        /*
         * Die Eingabe in die Parameter-Felder muss in das
         * JSON-Format konvertiert werden.
         */
        if (isset($array['params']) && is_array($array['params']))
        {
            $registry = new JRegistry;
            $registry->loadArray($array['params']);
            $array['params'] = (string) $registry;
        }
		/* Die Zugriffsregeln stehen im JAccessRules fertig verwendbar */
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}

        /* Weitere Verarbeitung an die Eltern-Klasse delegieren */
        return parent::bind($array, $ignore);
    }

	/**
	 * Der asset-name wird hier definiert
	 */
	protected function _getAssetName() {

		/* der Primärschlüssel der Tabelle #__mythings (= id) */
		$k = $this->_tbl_key;

		/* Name des asset, mit der id des zugehörigen Satzes in #__mythings */
		return 'com_mythings.mything.'.(int) $this->$k;
	}

	/**
	 * Überschreiben der Methode, die den Titel des assets erzeugt
	 */
	protected function _getAssetTitle()
	{
		return $this->title;
	}

	/**
	 * Unsere assets gehören alle zu com_mythings
	 */
	protected function _getAssetParentId($table = null, $id = null)
	{
		$asset = JTable::getInstance('asset');
		$asset->loadByName('com_mythings');
		return $asset->id;
	}

}
