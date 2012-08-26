<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Standard-Layout für das Frontend. Ausgabe als HTML-Tabelle.
 *
 * @package    Mythings
 * @subpackage Frontend
 * @author     chmst.de, webmechanic.biz
 * @license	   GNU/GPLv2 or later
 *
 * @todo  HTML-Ausgabe mit CSS anhübschen
 */
defined('_JEXEC') or die;

/* Das Null-Datum der Datenbank, als Vergleichswert */
$nullDate = JFactory::getDbo()->getNullDate();

/* Nach dieser Spalte wird die Tabelle sortiert */
$listOrder	= $this->escape($this->state->get('list.ordering'));

/* Die Sortierrichtung - aufsteigend oder absteigend */
$listDirn	= $this->escape($this->state->get('list.direction'));

?>
<?php echo $this->before_display ?>

<h1><?php echo JText::_('COM_MYTHINGS_SLOGAN'); ?></h1>

<?php if ($this->items) { ?>

<table>
<tr>

	<th style="background: #ccc;">
		<?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_TITLE', 'title', $listDirn, $listOrder); ?>
	</th>
	<th style="background: #ccc;">
		<?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_CATEGORY', 'category', $listDirn, $listOrder); ?>
	</th>
	<th style="background: #ccc;">
		<?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_LENT_BY', 'lent_by', $listDirn, $listOrder); ?>
	</th>
	<th style="background: #ccc;">
		<?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_LENT', 'lent_from', $listDirn, $listOrder); ?>
	</th>

</tr>
<?php foreach ($this->items as $item) : ?>
<tr>

  <td>
	<?php
	/* Link zur Detailansicht */
    $link = JRoute::_("index.php?option=com_mythings&view=mything&id=" .$item->id);
	echo '<a href="' .$link .'">' .$item->title .'</a>';
	?>
  </td>

	<td>
	<?php echo $this->escape($item->category); ?>
	</td>
	<td>
	<?php echo $this->escape($item->lent_by); ?>
	</td>
	<td><?php
	if ($item->lent_from != $nullDate) {
		echo JHtml::_('date', $this->escape($item->lent_from), 'd.m.Y');
	} ?>
  </td>

</tr>
<?php endforeach; ?>
</table>


<form action="<?php echo JRoute::_('index.php?option=com_mythings&view=mythings'); ?>"
      method="post" name="adminForm" id="adminForm">
<?php echo $this->pagination->getListFooter(); ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_mythings" />
<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
<?php echo JHtml::_('form.token'); ?>
</form>

<?php } ?>
