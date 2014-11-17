<?php
/* @var $this AvulsoController */
/* @var $model Avulso */

$this->breadcrumbs=array(
	'Avulsos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Avulso', 'url'=>array('index')),
	array('label'=>'Create Avulso', 'url'=>array('create')),
	array('label'=>'View Avulso', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Avulso', 'url'=>array('admin')),
);
?>

<h1>Update Avulso <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>