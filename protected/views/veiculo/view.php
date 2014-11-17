<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */

$this->breadcrumbs=array(
	'Veiculos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Veiculo', 'url'=>array('index')),
	array('label'=>'Create Veiculo', 'url'=>array('create')),
	array('label'=>'Update Veiculo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Veiculo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Veiculo', 'url'=>array('admin')),
);
?>

<h1>View Veiculo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descricao',
		'placa',
		'vagas',
		'tipo_veiculo_id',
		'user_id',
		'ativo',
		'created',
	),
)); ?>
