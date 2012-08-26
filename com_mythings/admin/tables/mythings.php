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
	* @var string $hits - So oft wurde die Detailansicht aufgerufen
	*/
	public $hits;

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
    * Konstruktor setzt Tabellenname, Primärschlüssel und das
    * übergebene Datenbankobjekt.
    */
    public function __construct($db)
    {
        parent::__construct('#__mythings', 'id', $db);
    }
}


