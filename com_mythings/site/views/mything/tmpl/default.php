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

/* Das Null-Datum der Datenbank, als Vergleichswert */
$nullDate = JFactory::getDbo()->getNullDate();
?>

<h1><?php echo $item->title; ?></h1>
<strong><?php echo $item->description; ?></strong>
<table>
    <tr>
        <td><?php echo JText::_('COM_MYTHINGS_STATE'); ?></td>
        <td><?php echo $this->escape($item->state); ?></td>
    </tr>
    <tr>
        <td><?php echo JText::_('COM_MYTHINGS_VALUE'); ?></td>
        <td><?php echo $this->escape($item->value); ?></td>
    </tr>
    <tr>
        <td><?php echo JText::_('COM_MYTHINGS_WEIGHT'); ?></td>
        <td><?php echo $this->escape($item->weight); ?></td>
    </tr>
</table>
<h1>
	<?php
	/**
	 * Das Ausleihdatum wird gegen das Null-Datum der Datenbank verglichen.
	 */
	if ($item->lent ==  $nullDate) {
		echo JText::_('COM_MYTHINGS_AVAILABLE');
	} else {
		echo JText::_('COM_MYTHINGS_NOT_AVAILABLE');
	}?>
</h1>

