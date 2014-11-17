<?php
/* @var $this PontoController */
/* @var $model Ponto */

$this->breadcrumbs=array(
	'Pontos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ponto', 'url'=>array('index')),
	array('label'=>'Create Ponto', 'url'=>array('create')),
	array('label'=>'Update Ponto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ponto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ponto', 'url'=>array('admin')),
);
?>

<h1>View Ponto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'descricao',
		'bairro_id',
		'ativo',
		'created',
		'trajeto_id',
	),
)); ?>
