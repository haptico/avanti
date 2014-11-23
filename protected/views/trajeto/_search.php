<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */
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
        <?php echo $form->label($model,'descricao', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'descricao',array('class'=>'form-control', 'placeholder' => 'Descricao')); ?>
    </div>

            <div class="form-group">
        <?php echo $form->label($model,'hora_inicio', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'hora_inicio', array('class'=>'form-control', 'placeholder' => 'Hora Inicio')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'hora_fim', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'hora_fim', array('class'=>'form-control', 'placeholder' => 'Hora Fim')); ?>
    </div>

                <div class="form-group">
        <?php echo $form->label($model,'preco_mensalista', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'preco_mensalista',array('class'=>'form-control', 'placeholder' => 'Preco Mensalista')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'preco_avulso', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'preco_avulso',array('class'=>'form-control', 'placeholder' => 'Preco Avulso')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'ativo', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'ativo',array('class'=>'form-control', 'placeholder' => 'Ativo')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'created', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'created', array('class'=>'form-control', 'placeholder' => 'Created')); ?>
    </div>

<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
