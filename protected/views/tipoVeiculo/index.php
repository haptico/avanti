<?php
/* @var $this TipoVeiculoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Veiculos',
);

$this->menu=array(
	array('label'=>'Create TipoVeiculo', 'url'=>array('create')),
	array('label'=>'Manage TipoVeiculo', 'url'=>array('admin')),
);
?>

<h1>Tipo Veiculos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
