<?php
/* @var $this PontoController */
/* @var $data Ponto */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        	<dt><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></dt>
	<dd><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></dd>	<dt><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?></dt>
	<dd><?php echo CHtml::encode($data->nome); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?></dt>
	<dd><?php echo CHtml::encode($data->descricao); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('bairro_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->bairro_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('ativo')); ?></dt>
	<dd><?php echo CHtml::encode($data->ativo); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('created')); ?></dt>
	<dd><?php echo CHtml::encode($data->created); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('trajeto_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->trajeto_id); ?></dd>
    </dl>
</div>