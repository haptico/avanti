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
<div class="col-md-10">
<h2>Create Avulso</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>