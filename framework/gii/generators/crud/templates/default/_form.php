<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

<div class="row">
  <div class="col-md-12"><p class="note">Fields with <span class="required">*</span> are required.</p></div>
</div>

<div class="row">
  <div class="col-md-12"><?php echo "<?php echo \$form->errorSummary(\$model, NULL, NULL, array()); ?>\n"; ?></div>
</div>
<?php
foreach ($this->tableSchema->columns as $column) {
    if ($column->autoIncrement)
        continue;
    ?>
    <div class="form-group">
        <?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
        <div class="col-sm-10">
            <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
            <?php echo "<?php echo \$form->error(\$model,'{$column->name}', array('class'=>'help-block')); ?>\n"; ?>
        </div>
    </div>
    <?php
}
?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Criar' : 'Atualizar', array('class'=>'btn btn-default')); ?>\n"; ?>
    </div>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>