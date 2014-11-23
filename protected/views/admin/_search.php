
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array(
        'class' => 'form-inline'
    )
        ));
?>


<div class="form-group">
    <?php echo $form->label($model, 'username', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20, 'class' => 'form-control', 'placeholder' => 'Nome do usuário')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'email', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => 'Email')); ?>
</div>


<div class="form-group">
    <?php echo $form->label($model, 'create_at', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'create_at', array('class' => 'form-control date', 'placeholder' => 'Criado em')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'lastvisit_at', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'lastvisit_at', array('class' => 'form-control date', 'placeholder' => 'Atualizado em')); ?>
</div>
<div class="form-group">
    <?php echo $form->label($model, 'activkey', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'activkey', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => 'Chave de ativiação')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'superuser', array('class' => 'sr-only')); ?>
    <?php echo $form->dropDownList($model, 'superuser', $model->itemAlias('AdminStatus'), array('class' => 'form-control', 'placeholder' => 'Super Usuário')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'status', array('class' => 'sr-only')); ?>
    <?php echo $form->dropDownList($model, 'status', $model->itemAlias('UserStatus'), array('class' => 'form-control', 'placeholder' => 'Status')); ?>
</div>

<?php echo CHtml::submitButton(Yii::t("user", 'Search'), array('class' => 'btn btn-default')); ?>

<?php $this->endWidget(); ?>
