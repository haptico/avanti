<?php
/* @var $this UfController */
/* @var $model Uf */

$this->breadcrumbs=array(
	'Ufs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Uf', 'url'=>array('index')),
	array('label'=>'Manage Uf', 'url'=>array('admin')),
);
?>

<h1>Create Uf</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>