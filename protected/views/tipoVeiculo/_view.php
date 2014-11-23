<?php
/* @var $this TipoVeiculoController */
/* @var $data TipoVeiculo */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        	<dt><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></dt>
	<dd><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></dd>	<dt><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?></dt>
	<dd><?php echo CHtml::encode($data->nome); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('ativo')); ?></dt>
	<dd><?php echo CHtml::encode($data->ativo); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('created')); ?></dt>
	<dd><?php echo CHtml::encode($data->created); ?></dd>
    </dl>
</div>