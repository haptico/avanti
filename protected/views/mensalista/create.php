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
<div class="col-md-10">
<h2>Create Mensalista</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>