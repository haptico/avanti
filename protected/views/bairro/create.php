<?php
/* @var $this BairroController */
/* @var $model Bairro */

$this->breadcrumbs=array(
	'Bairros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bairro', 'url'=>array('index')),
	array('label'=>'Manage Bairro', 'url'=>array('admin')),
);
?>

<h1>Create Bairro</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>