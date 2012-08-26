<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Detail-Layout für das Frontend. Ausgabe als HTML-Tabelle.
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 *
 * @todo  HTML-Ausgabe mit CSS anhübschen
 */
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

/* Das Item, Eigenschaft der View, die hier ausgegeben wird */
$item = $this->item;

/* Parameter für diesen Datensatz */
$params = $this->params;

/* Der Benutzer, für die Prüfung der Zugriffsberechtigung */
$user = JFactory::getUser();

/* Das Null-Datum der Datenbank, als Vergleichswert */
$nullDate = JFactory::getDbo()->getNullDate();
?>

<h1><?php echo $item->title; ?></h1>
<strong><?php echo $item->description; ?></strong>
<table>
    <tr>
        <td><?php echo JText::_('COM_MYTHINGS_STATE'); ?></td>
        <td><?php 
		switch ($item->state) {
	    case '0':
	    	echo JText::_('COM_MYTHINGS_STATE_NEW');
	    break;
	
	    case '1':
	    	echo JText::_('COM_MYTHINGS_STATE_GOOD');
	    break;
	
	    case '2':
	    	echo JText::_('COM_MYTHINGS_STATE_USED');
	    break;
	
	    case '3':
	    	echo JText::_('COM_MYTHINGS_STATE_SCRAPE');
	    break;
	
	    default:
	    	echo JText::_('COM_MYTHINGS_STATE_UNKOWN');
	    break;
	}
	?></td>
    </tr>
<?php if ($params->get('value')) : ?>
	<tr>
	<td><?php echo JText::_('COM_MYTHINGS_VALUE'); ?></td>
	<td><?php echo $this->escape($item->value); ?></td>
    </tr>
<?php endif; ?>
<?php if ($params->get('weight')) : ?>
	<tr>
	<td><?php echo JText::_('COM_MYTHINGS_WEIGHT'); ?></td>
	<td><?php echo $this->escape($item->weight); ?></td>
	</tr>
<?php endif; ?>
</table>

<h1>
	<?php
	/**
	 * Das Ausleihdatum wird gegen das Null-Datum der Datenbank verglichen.
	 */
	if ($item->lent_from ==  $nullDate) {
		echo JText::_('COM_MYTHINGS_AVAILABLE');
	} else {
		echo JText::_('COM_MYTHINGS_NOT_AVAILABLE');
	}?>
</h1>
<?php if ($item->img) { ?>
<p><img src="<?php echo $this->escape($item->img); ?>" /></p>
<?php } ?>
