<?php
/* @var $this UfController */
/* @var $model Uf */

$this->breadcrumbs=array(
	'Ufs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Uf', 'url'=>array('index')),
	array('label'=>'Create Uf', 'url'=>array('create')),
	array('label'=>'Update Uf', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Uf', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Uf', 'url'=>array('admin')),
);
?>

<h1>View Uf #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-bordered table-hover table-condensed'
        ),
	'attributes'=>array(
		'id',
		'sigla',
		'nome',
	),
)); ?>
