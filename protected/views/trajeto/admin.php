<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */

$this->breadcrumbs=array(
	'Trajetos'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Trajeto', 'url'=>array('index')),
array('label'=>'Create Trajeto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#trajeto-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="row">
    <div class="col-md-12">
        <h1>Manage Trajetos</h1>

        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>
    </div>
</div>
<?php echo CHtml::link('Busca avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'trajeto-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    array(
            'class' => 'CButtonColumn',
        ),
		'id',
		'descricao',
		'veiculo_id',
		'hora_inicio',
		'hora_fim',
		'bairro_origem_id',
		/*
		'bairro_destino_id',
		'preco_mensalista',
		'preco_avulso',
		'ativo',
		'created',
		*/
),
)); ?>
