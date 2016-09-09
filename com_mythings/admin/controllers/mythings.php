<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * Controller für die Listenansicht mythings
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;

/**
 * Erweiterung der Klasse JControllerForm
 */
class MyThingsControllerMyThings extends JControllerAdmin
{
  /**
   * Verbindung zu MyThingsModelMyThing, damit die dort
   * enthaltenen Methoden zum Lesen von Datensätzen
   * verwendet werden können.
   *
   * @return MyThingsModelMyThings Das Model für die Listenansicht
   */
  public function getModel($name = 'MyThing', $prefix = 'MyThingsModel', $config = array())
  {
    // Model nicht automatisch mit Inhalten aus dem Request befüllen
    $config['ignore_request'] = true;

    // restliche Arbeit der Elternklasse überlassen
    return parent::getModel($name, $prefix, $config);
  }

}
