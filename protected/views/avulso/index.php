<?php
/* @var $this AvulsoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avulsos',
);

$this->menu=array(
	array('label'=>'Create Avulso', 'url'=>array('create')),
	array('label'=>'Manage Avulso', 'url'=>array('admin')),
);
?>

<h1>Avulsos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
