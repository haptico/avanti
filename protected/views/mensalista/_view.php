<?php
/* @var $this MensalistaController */
/* @var $data Mensalista */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        	<dt><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></dt>
	<dd><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></dd>	<dt><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->user_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('trajeto_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->trajeto_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('ponto_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->ponto_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('data_inicio')); ?></dt>
	<dd><?php echo CHtml::encode($data->data_inicio); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?></dt>
	<dd><?php echo CHtml::encode($data->data_fim); ?></dd>
    </dl>
</div>