<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */

$this->breadcrumbs=array(
	'Veiculos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Veiculo', 'url'=>array('index')),
	array('label'=>'Create Veiculo', 'url'=>array('create')),
	array('label'=>'View Veiculo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Veiculo', 'url'=>array('admin')),
);
?>

<h1>Update Veiculo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>