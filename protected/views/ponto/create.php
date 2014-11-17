<?php
/* @var $this PontoController */
/* @var $model Ponto */

$this->breadcrumbs=array(
	'Pontos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ponto', 'url'=>array('index')),
	array('label'=>'Manage Ponto', 'url'=>array('admin')),
);
?>

<h1>Create Ponto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>