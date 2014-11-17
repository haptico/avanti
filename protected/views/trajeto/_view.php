<?php
/* @var $this TrajetoController */
/* @var $data Trajeto */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        	<dt><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></dt>
	<dd><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></dd>	<dt><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?></dt>
	<dd><?php echo CHtml::encode($data->descricao); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('veiculo_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->veiculo_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('hora_inicio')); ?></dt>
	<dd><?php echo CHtml::encode($data->hora_inicio); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('hora_fim')); ?></dt>
	<dd><?php echo CHtml::encode($data->hora_fim); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('bairro_origem_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->bairro_origem_id); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('bairro_destino_id')); ?></dt>
	<dd><?php echo CHtml::encode($data->bairro_destino_id); ?></dd>
	<?php /*
	<dt><?php echo CHtml::encode($data->getAttributeLabel('preco_mensalista')); ?></dt>
	<dd><?php echo CHtml::encode($data->preco_mensalista); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('preco_avulso')); ?></dt>
	<dd><?php echo CHtml::encode($data->preco_avulso); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('ativo')); ?></dt>
	<dd><?php echo CHtml::encode($data->ativo); ?></dd>
	<dt><?php echo CHtml::encode($data->getAttributeLabel('created')); ?></dt>
	<dd><?php echo CHtml::encode($data->created); ?></dd>
	*/ ?>
    </dl>
</div>