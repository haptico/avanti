<?php
/* @var $this BairroController */
/* @var $model Bairro */

$this->breadcrumbs=array(
	'Bairros'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bairro', 'url'=>array('index')),
	array('label'=>'Create Bairro', 'url'=>array('create')),
	array('label'=>'Update Bairro', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bairro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bairro', 'url'=>array('admin')),
);
?>

<h1>View Bairro #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'cidade_id',
	),
)); ?>
