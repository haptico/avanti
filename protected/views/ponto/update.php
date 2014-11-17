<?php
/* @var $this PontoController */
/* @var $model Ponto */

$this->breadcrumbs=array(
	'Pontos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ponto', 'url'=>array('index')),
	array('label'=>'Create Ponto', 'url'=>array('create')),
	array('label'=>'View Ponto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ponto', 'url'=>array('admin')),
);
?>

<h1>Update Ponto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>