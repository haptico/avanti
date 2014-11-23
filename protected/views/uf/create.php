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
<div class="col-md-10">
<h2>Create Uf</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>