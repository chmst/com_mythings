<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
 *
 * Das HTML-Layout zur tabellarischen MyThings-Übersicht
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$nullDate = JFactory::getDbo()->getNullDate();
?>

<form action="<?php echo JRoute::_('index.php?option=com_mythings&view=mythings'); ?>"
      method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
		<tr>
			<th width="10">
				<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)"/>
			</th>
			<th><?php echo JText::_('COM_MYTHINGS_TITLE'); ?></th>
			<th width="20%"><?php echo JText::_('COM_MYTHINGS_OWNER'); ?></th>
			<th width="20%"><?php echo JText::_('COM_MYTHINGS_CAT'); ?></th>
			<th width="10%"><?php echo JText::_('COM_MYTHINGS_LENT'); ?></th>
			<th width="10%"><?php echo JText::_('COM_MYTHINGS_LENT_BY'); ?></th>
			<th width="10%"><?php echo JText::_('COM_MYTHINGS_ID'); ?></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($this->items as $i => $item) : ?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
			<td><?php
				/* Link zum Formular */
				$mylink = JRoute::_("index.php?option=com_mythings&task=mything.edit&id=" . $item->id);
				echo '<a href="' . $mylink . '">' . $this->escape($item->title) . '</a>';
				?>
			</td>
			<td><?php echo $this->escape($item->category); ?></td>
			<td><?php echo $this->escape($item->owner); ?></td>
			<td><?php
				if ($this->escape($item->lent) != $nullDate) {
					echo JHtml::_('date', $item->lent, JText::_('DATE_FORMAT_LC4'));
				}
			?></td>
			<td><?php echo $this->escape($item->lent_by); ?></td>
			<td class="center"><?php echo (int)$item->id; ?></td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>

	<input type="hidden" name="task"/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
