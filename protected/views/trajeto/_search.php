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
        <?php echo $form->label($model,'id', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'id', array('class'=>'form-control', 'placeholder' => 'id')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'descricao', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'descricao',array('class'=>'form-control', 'placeholder' => 'descricao')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'veiculo_id', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'veiculo_id', array('class'=>'form-control', 'placeholder' => 'veiculo_id')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'hora_inicio', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'hora_inicio', array('class'=>'form-control', 'placeholder' => 'hora_inicio')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'hora_fim', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'hora_fim', array('class'=>'form-control', 'placeholder' => 'hora_fim')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'bairro_origem_id', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'bairro_origem_id', array('class'=>'form-control', 'placeholder' => 'bairro_origem_id')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'bairro_destino_id', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'bairro_destino_id', array('class'=>'form-control', 'placeholder' => 'bairro_destino_id')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'preco_mensalista', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'preco_mensalista',array('class'=>'form-control', 'placeholder' => 'preco_mensalista')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'preco_avulso', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'preco_avulso',array('class'=>'form-control', 'placeholder' => 'preco_avulso')); ?>
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
