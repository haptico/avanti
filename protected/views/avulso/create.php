<?php
/* @var $this AvulsoController */
/* @var $model Avulso */

$this->breadcrumbs=array(
	'Avulsos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Avulso', 'url'=>array('index')),
	array('label'=>'Manage Avulso', 'url'=>array('admin')),
);
?>

<h1>Create Avulso</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>