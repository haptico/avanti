<?php
/* @var $this PontoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pontos',
);

$this->menu=array(
	array('label'=>'Create Ponto', 'url'=>array('create')),
	array('label'=>'Manage Ponto', 'url'=>array('admin')),
);
?>

<h1>Pontos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
