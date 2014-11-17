<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */

$this->breadcrumbs=array(
	'Mensalistas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mensalista', 'url'=>array('index')),
	array('label'=>'Manage Mensalista', 'url'=>array('admin')),
);
?>

<h1>Create Mensalista</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>