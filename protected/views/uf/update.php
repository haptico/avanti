<?php
/* @var $this UfController */
/* @var $model Uf */

$this->breadcrumbs=array(
	'Ufs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Uf', 'url'=>array('index')),
	array('label'=>'Create Uf', 'url'=>array('create')),
	array('label'=>'View Uf', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Uf', 'url'=>array('admin')),
);
?>

<h1>Update Uf <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>