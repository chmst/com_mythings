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

<div class="width-60 fltlft">
    <fieldset class="adminform">
        <legend><?php echo JText::_('COM_MYTHINGS_DATA_SET'); ?></legend>
        <ul class="adminformlist">
            <li>
            <?php echo $this->form->getLabel('title'); ?>
            <?php echo $this->form->getInput('title'); ?>
            </li>
            <li>
            <?php echo $this->form->getLabel('owner_id'); ?>
            <?php echo $this->form->getInput('owner_id'); ?>
            </li>
            <li>
            <?php echo $this->form->getLabel('category_id'); ?>
            <?php echo $this->form->getInput('category_id'); ?>
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
            <?php echo $this->form->getLabel('img'); ?>
            <?php echo $this->form->getInput('img'); ?>
            </li>
            <li>
            <?php echo $this->form->getLabel('description'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('description'); ?>
            </li>
        </ul>
    </fieldset>
</div>

<div class="width-40 fltrt">
<?php echo JHtml::_('sliders.start', 'lent-data'); ?>
<?php echo JHtml::_('sliders.panel',JText::_('COM_MYTHINGS_LENT_DATA'), 'lent-details'); ?>
	<fieldset class="panelform">
    	<ul class="adminformlist">
            <li>
            <?php echo $this->form->getLabel('lent_from'); ?>
            <?php echo $this->form->getInput('lent_from'); ?>
            </li>
            <li>
            <?php echo $this->form->getLabel('lent_to'); ?>
            <?php echo $this->form->getInput('lent_to'); ?>
            </li>
            <li>
            <?php echo $this->form->getLabel('lent_by_id'); ?>
            <?php echo $this->form->getInput('lent_by_id'); ?>
            </li>
    	</ul>
	</fieldset>

    <?php echo JHtml::_('sliders.panel',JText::_('COM_MYTHINGS_CONFIGURATION'), 'params'); ?>
    <fieldset class="panelform">
    <ul class="adminformlist">
        <?php foreach ($this->form->getFieldset('detail_layout') as $field) : ?>
            <li>
            <?php echo $field->label; ?>
            <?php echo $field->input; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </fieldset>
</div>
<?php echo JHtml::_('sliders.end'); ?>
<div class="clr"></div>

<div class="width-100 fltlft">
   <?php echo JHtml::_('sliders.panel',JText::_('COM_MYTHINGS_ACCESS'), 'mythings-access'); ?>
    <fieldset class="panelform">
        <?php echo $this->form->getLabel('rules'); ?>
        <?php echo $this->form->getInput('rules'); ?>
    </fieldset>
</div>

<?php echo JHtml::_('sliders.end'); ?>

<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>

</form>
