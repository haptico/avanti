<?php
/* @var $this AvulsoController */
/* @var $model Avulso */

$this->breadcrumbs=array(
	'Avulsos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Avulso', 'url'=>array('index')),
	array('label'=>'Create Avulso', 'url'=>array('create')),
	array('label'=>'Update Avulso', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Avulso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Avulso', 'url'=>array('admin')),
);
?>

<h1>View Avulso #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-bordered table-hover table-condensed'
        ),
	'attributes'=>array(
		'id',
		'user_id',
		'trajeto_id',
		'ponto_id',
		'data',
		'valor',
	),
)); ?>
