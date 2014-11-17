<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */

$this->breadcrumbs=array(
	'Trajetos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Trajeto', 'url'=>array('index')),
	array('label'=>'Create Trajeto', 'url'=>array('create')),
	array('label'=>'View Trajeto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Trajeto', 'url'=>array('admin')),
);
?>

<h1>Update Trajeto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>