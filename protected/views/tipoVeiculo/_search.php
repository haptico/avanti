<?php
/* @var $this TipoVeiculoController */
/* @var $model TipoVeiculo */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions' => array(
            'class' => 'form-inline'
        )
)); ?>

            <div class="form-group">
        <?php echo $form->label($model,'nome', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'nome',array('class'=>'form-control', 'placeholder' => 'nome')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'ativo', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'ativo',array('class'=>'form-control', 'placeholder' => 'ativo')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'created', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'created', array('class'=>'form-control', 'placeholder' => 'created')); ?>
    </div>

<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
