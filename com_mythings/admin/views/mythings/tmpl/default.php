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

/* Nach dieser Spalte wird die Tabelle sortiert */
$listOrder = $this->escape($this->state->get('list.ordering'));

/* Die Sortierrichtung - aufsteigend oder absteigend */
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php?option=com_mythings&view=mythings'); ?>"
	method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl">
				<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>
			</label>
			<input type="text" name="filter_search" id="filter_search"
			       value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
			       title="<?php echo JText::_('COM_MYTHINGS_SEARCH'); ?>"/>
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();">
				<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>
			</button>
		</div>
	</fieldset>
	<div class="clr"></div>
	<table class="adminlist">
		<thead>
		<tr>
			<th width="10">
				<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)"/>
			</th>
			<th><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_TITLE', 'title', $listDirn, $listOrder); ?></th>
			<th width="20%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_OWNER', 'owner', $listDirn, $listOrder); ?></th>
			<th width="20%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_CAT', 'category', $listDirn, $listOrder); ?></th>
			<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_LENT', 'lent', $listDirn, $listOrder); ?></th>
			<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_LENT_BY', 'lent_by', $listDirn, $listOrder); ?></th>
			<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_ID', 'id', $listDirn, $listOrder); ?></th>
		</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
		</tfoot>
		<tbody>
	<?php foreach ($this->items as $i => $item) : ?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
			<td><?php
				/* Link zur Formularansicht für dieses Ding */
				$mylink = JRoute::_("index.php?option=com_mythings&task=mything.edit&id=" . $item->id);
				echo '<a href="' . $mylink . '">' . $this->escape($item->title) . '</a>';
				?>
			</td>
			<td><?php echo $this->escape($item->owner); ?></td>
			<td><?php echo $this->escape($item->category); ?></td>
			<td><?php
				if ($item->lent != $nullDate) {
					echo JHtml::_('date', $item->lent, JText::_('DATE_FORMAT_LC4'));
				}
				?>
			</td>
			<td><?php echo $this->escape($item->lent_by); ?></td>
			<td class="center"><?php echo (int)$item->id; ?></td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
