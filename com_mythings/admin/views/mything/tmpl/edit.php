<?php
/**
 * Joomla 2.5 - Erweiterungen programmieren - angepasst an Joomla 3.0
 *
 * HTML-Formular zum Anlegen und Bearbeiten eines Datensatzes.
 *
 * @package    MyThings
 * @subpackage Backend
 * @author     chmst.de, webmechanic.biz
 * @license    GNU/GPL
 */
defined('_JEXEC') or die;

// lädt JavaScript-Helfer für Tooltips, Eingabeprüfung
// und zum Aufrechterhalten der Session bei Untätigkeit,
// um Datenverluste während dem Bearbeiten zu vermeiden.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

?>
<form action="<?php echo JRoute::_('index.php?option=com_mythings'
		. (!empty($this->item->id) ? '&id=' . (int) $this->item->id : '')
	) ?>"
		method="post"
		name="adminForm"
		id="adminForm"
		class="form-validate">
<div class="span10 row-fluid form-horizontal">
	<div class="row-fluid">

		<div id="j-main-container" class="span10">

		<fieldset>
			<legend><?php echo JText::_('COM_MYTHINGS_DATA_SET'); ?></legend>
			<?php echo JHtml::_('bootstrap.startTabSet', 'mtTab', array('active' => 'data')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'mtTab', 'data', JText::_('COM_MYTHINGS_DATA_SET', true)); ?>
			<fieldset>
				<div class="form-horizontal pull-left ">
					<?php foreach ($this->form->getFieldset('mythings-data') as $field) : ?>
						<div class="control-group">
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
							<div class="controls">
								<?php echo $field->input; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'mtTab', 'params', JText::_('COM_MYTHINGS_PARAMS', false)); ?>
			<fieldset>
				<div class="form-horizontal pull-left ">
					<?php foreach ($this->form->getFieldset('detail_layout') as $field) : ?>
						<div class="control-group">
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
							<div class="controls">
								<?php echo $field->input; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'mtTab', 'access', JText::_('COM_MYTHINGS_ACCESS', false)); ?>

					<?php echo $this->form->getInput('rules'); ?>

			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.endTabSet'); ?>

			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>


</form>
