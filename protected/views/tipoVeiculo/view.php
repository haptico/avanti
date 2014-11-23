<?php
/* @var $this TipoVeiculoController */
/* @var $model TipoVeiculo */

$this->breadcrumbs=array(
	'Tipo Veiculos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoVeiculo', 'url'=>array('index')),
	array('label'=>'Create TipoVeiculo', 'url'=>array('create')),
	array('label'=>'Update TipoVeiculo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoVeiculo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoVeiculo', 'url'=>array('admin')),
);
?>

<h1>View TipoVeiculo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-bordered table-hover table-condensed'
        ),
	'attributes'=>array(
		'id',
		'nome',
		'ativo',
		'created',
	),
)); ?>
