<?php
/* @var $this BairroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bairros',
);

$this->menu=array(
	array('label'=>'Create Bairro', 'url'=>array('create')),
	array('label'=>'Manage Bairro', 'url'=>array('admin')),
);
?>

<h1>Bairros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
