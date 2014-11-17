<?php
/* @var $this BairroController */
/* @var $model Bairro */

$this->breadcrumbs=array(
	'Bairros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bairro', 'url'=>array('index')),
	array('label'=>'Create Bairro', 'url'=>array('create')),
	array('label'=>'View Bairro', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bairro', 'url'=>array('admin')),
);
?>

<h1>Update Bairro <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>