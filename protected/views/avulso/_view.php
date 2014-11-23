<?php
/* @var $this AvulsoController */
/* @var $data Avulso */
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
	<dt><?php echo CHtml::encode($data->getAttributeLabel('data')); ?></dt>
	<dd><?php echo CHtml::encode($data->data); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?></dt>
	<dd><?php echo CHtml::encode($data->valor); ?></dd>
    </dl>
</div>