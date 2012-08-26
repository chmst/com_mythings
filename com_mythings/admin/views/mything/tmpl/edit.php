<?php
/**
 * Joomla! 2.5 - Erweiterungen programmieren
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
<form action="<?php echo JRoute::_('index.php?option=com_mythings&id='.(int) $this->item->id); ?>"
	method="post" name="adminForm" id="mything-form" class="form-validate">

	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_MYTHINGS_DATA_SET'); ?></legend>
		<ul class="adminformlist">
			<li>
			<?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('owner'); ?>
			<?php echo $this->form->getInput('owner'); ?>
			</li>
            <li>
			<?php echo $this->form->getLabel('category'); ?>
			<?php echo $this->form->getInput('category'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('state'); ?>
			<?php echo $this->form->getInput('state'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('value'); ?>
			<?php echo $this->form->getInput('value'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('weight'); ?>
			<?php echo $this->form->getInput('weight'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('description'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('description'); ?>
			</li>
		</ul>
	</fieldset>

	<fieldset class="adminform">
		<legend>
		<?php echo JText::_('COM_MYTHINGS_LENT_DATA'); ?>
		</legend>
		<ul class="adminformlist">
			<li>
			<?php echo $this->form->getLabel('lent'); ?>
			<?php echo $this->form->getInput('lent'); ?>
			</li>
			<li>
			<?php echo $this->form->getLabel('lent_by'); ?>
			<?php echo $this->form->getInput('lent_by'); ?>
			</li>
		</ul>
	</fieldset>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>


</form>
