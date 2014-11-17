<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */

$this->breadcrumbs=array(
	'Trajetos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Trajeto', 'url'=>array('index')),
	array('label'=>'Create Trajeto', 'url'=>array('create')),
	array('label'=>'Update Trajeto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Trajeto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Trajeto', 'url'=>array('admin')),
);
?>

<h1>View Trajeto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-bordered table-hover table-condensed'
        ),
	'attributes'=>array(
		'id',
		'descricao',
		'veiculo_id',
		'hora_inicio',
		'hora_fim',
		'bairro_origem_id',
		'bairro_destino_id',
		'preco_mensalista',
		'preco_avulso',
		'ativo',
		'created',
	),
)); ?>
