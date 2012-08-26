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
 * @todo  HTML-Ausgabe escapen
 */
defined('_JEXEC') or die;

/* Das Item, Eigenschaft der View, die hier ausgegeben wird */
$item = $this->item;

/* Das Null-Datum der Datenbank, als Vergleichswert */
$nullDate = JFactory::getDbo()->getNullDate();
?>

<h1><?php echo $item->title; ?></h1>
<strong><?php echo $item->description; ?></strong>
<table>
	<tr>
		<td>Zustand: </td>
		<td><?php echo $item->state; ?></td>
		</tr>
		<tr>
		<td>Wert: </td>
		<td><?php echo $item->value; ?></td>
		</tr>
		<tr>
		<td>Gewicht: </td>
		<td><?php echo $item->weight; ?></td>
	</tr>
</table>
<h1>
	<?php
	/**
	 * Das Ausleihdatum wird gegen das Null-Datum der Datenbank verglichen.
	 */
	if ($item->lent ==  $nullDate) { ?>
		Ist ausleihbar
	<?php  } else {?>
		Ist gerade verliehen.
	<?php }?>
</h1>

