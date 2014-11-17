<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */

$this->breadcrumbs=array(
	'Trajetos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Trajeto', 'url'=>array('index')),
	array('label'=>'Manage Trajeto', 'url'=>array('admin')),
);
?>

<h1>Create Trajeto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>