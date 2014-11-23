<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */

$this->breadcrumbs=array(
	'Mensalistas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mensalista', 'url'=>array('index')),
	array('label'=>'Create Mensalista', 'url'=>array('create')),
	array('label'=>'View Mensalista', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mensalista', 'url'=>array('admin')),
);
?>
<div class="col-md-10">
<h1>Update Mensalista <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>