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
<div class="col-md-10">
<h2>Create Ponto</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>