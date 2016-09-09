<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
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
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');

$nullDate = JFactory::getDbo()->getNullDate();

/* Nach dieser Spalte wird die Tabelle sortiert */
$listOrder = $this->escape($this->state->get('list.ordering'));

/* Die Sortierrichtung - aufsteigend oder absteigend */
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php?option=com_mythings&view=mythings'); ?>" method="post" name="adminForm" id="adminForm">

<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container" class="span12">
<?php endif; ?>

		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search" class="element-invisible">
					<?php echo JText::_('COM_MYTHINGS_SEARCH');?>
				</label>
				<input type="text" name="filter_search" id="filter_search"
					   placeholder="<?php echo JText::_('COM_MYTHINGS_SEARCH'); ?>"
					   value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
					   title="<?php echo JText::_('COM_KANDANDAEVENTS_SEARCH_IN_TITLE'); ?>"
					   />
			</div>
			<div class="btn-group pull-left">
				<button class="btn hasTooltip"
						type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
					<i class="icon-search"></i>
				</button>
				<button class="btn hasTooltip"
						type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="document.id('filter_search').value='';this.form.submit();">
					<i class="icon-remove"></i>
				</button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</div>
		<div class="clearfix"> </div>

	<div class="clr"></div>
	<table class="table table-striped">
		<thead>
		<tr>
					<th width="1%" class="center hidden-phone">
						<input type="checkbox" name="checkall-toggle"
							   value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
							   onclick="Joomla.checkAll(this)"
							   />
					</th>
			<th><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_TITLE', 'title', $listDirn, $listOrder); ?></th>
			<th width="20%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_OWNER', 'owner', $listDirn, $listOrder); ?></th>
			<th width="20%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_CAT', 'category', $listDirn, $listOrder); ?>
				<br />
				<select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
					<?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_mythings'), 'value', 'text', $this->state->get('filter.category_id'));?>
				</select>
			</th>
			<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_MYTHINGS_LENT', 'lent_from', $listDirn, $listOrder); ?></th>
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
			<td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
			<td><?php
				/* Link zur Formularansicht für dieses Ding */
				$mylink = JRoute::_("index.php?option=com_mythings&task=mything.edit&id=" . $item->id);
				echo '<a href="' . $mylink . '">' . $this->escape($item->title) . '</a>';
				?>
			</td>
			<td><?php echo $this->escape($item->owner); ?></td>
			<td><?php echo $this->escape($item->category); ?></td>
			<td><?php
				if ($item->lent_from != $nullDate) {
					echo JHtml::_('date', $item->lent_from, JText::_('DATE_FORMAT_LC4'));
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
