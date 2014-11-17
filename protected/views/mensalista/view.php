<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */

$this->breadcrumbs=array(
	'Mensalistas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mensalista', 'url'=>array('index')),
	array('label'=>'Create Mensalista', 'url'=>array('create')),
	array('label'=>'Update Mensalista', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mensalista', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mensalista', 'url'=>array('admin')),
);
?>

<h1>View Mensalista #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'trajeto_id',
		'ponto_id',
		'data_inicio',
		'data_fim',
	),
)); ?>
