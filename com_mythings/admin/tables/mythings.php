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
	* @var string $owner - Jedes Ding hat einen Besitzer
	*/
	public $owner;

	/**
	* @var string $category - Ein Oberbegriff für das Ding
	*/
	public $category;

	/**
	* @var string $title -Benennung, Kurzbezeichnung
	*/
	public $title;

	/**
	* @var string $description - kann ausführlich ausfallen
	*/
	public $description;

	/**
	* @var string $state - Zustand, z.B. Neu, gebraucht 
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
	* @var string $lent - Datum an dem das Ding ausgeliehen wurde
	*/
	public $lent;

	/**
	* @var string $lent_by - Name der ausleihenden Person
	*/
	public $lent_by;

	/**
	* Konstruktor setzt Tabellenname, Primärschlüssel und das
	* übergebene Datenbankobjekt.
	*/
	public function __construct($db)
	{
		parent::__construct('#__mythings', 'id', $db);
	}

}
