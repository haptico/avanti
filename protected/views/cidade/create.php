<?php
/* @var $this CidadeController */
/* @var $model Cidade */

$this->breadcrumbs=array(
	'Cidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cidade', 'url'=>array('index')),
	array('label'=>'Manage Cidade', 'url'=>array('admin')),
);
?>
<div class="col-md-10">
<h2>Create Cidade</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>