<?php
/* @var $this TipoVeiculoController */
/* @var $model TipoVeiculo */

$this->breadcrumbs=array(
	'Tipo Veiculos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoVeiculo', 'url'=>array('index')),
	array('label'=>'Manage TipoVeiculo', 'url'=>array('admin')),
);
?>

<h1>Create TipoVeiculo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>