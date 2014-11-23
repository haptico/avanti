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
<div class="col-md-10">
<h2>Create Trajeto</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>