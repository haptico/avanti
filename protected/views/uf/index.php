<?php
/* @var $this UfController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ufs',
);

$this->menu=array(
	array('label'=>'Create Uf', 'url'=>array('create')),
	array('label'=>'Manage Uf', 'url'=>array('admin')),
);
?>

<h1>Ufs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'htmlOptions' => array(
            'class' => 'rows'
        ),
	'itemView'=>'_view',
)); ?>
