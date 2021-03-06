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
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
        'htmlOptions' => array(
            'class' => 'form-inline'
        )
)); ?>\n"; ?>

<?php foreach ($this->tableSchema->columns as $column): ?>
    <?php
    $field = $this->generateInputField($this->modelClass, $column);
    if (strpos($field, 'password') !== false || strpos($field, 'id') !== false)
        continue;
    ?>
    <div class="form-group">
        <?php echo "<?php echo \$form->label(\$model,'{$column->name}', array('class' => 'sr-only')); ?>\n"; ?>
        <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
    </div>

<?php endforeach; ?>
<?php echo "<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>\n"; ?>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>