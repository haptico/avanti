<?php
/* @var $this BairroController */
/* @var $data Bairro */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        	<dt><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></dt>
	<dd><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></dd>	<dt><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?></dt>
	<dd><?php echo CHtml::encode($data->nome); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('cidade_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->cidade_id); ?></dd>
    </dl>
</div>