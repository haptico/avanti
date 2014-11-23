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
<div class="col-md-10">
<h2>Create TipoVeiculo</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>