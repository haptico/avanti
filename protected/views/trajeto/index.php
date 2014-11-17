<?php
/* @var $this TrajetoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trajetos',
);

$this->menu=array(
	array('label'=>'Create Trajeto', 'url'=>array('create')),
	array('label'=>'Manage Trajeto', 'url'=>array('admin')),
);
?>

<h1>Trajetos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'htmlOptions' => array(
            'class' => 'rows'
        ),
	'itemView'=>'_view',
)); ?>
