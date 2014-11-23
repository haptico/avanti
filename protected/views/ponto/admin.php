<?php
/* @var $this PontoController */
/* @var $model Ponto */

$this->breadcrumbs=array(
	'Pontos'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Ponto', 'url'=>array('index')),
array('label'=>'Create Ponto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#ponto-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="col-md-10">
    <h1>Manage Pontos</h1>

    <p>
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </p>
<?php echo CHtml::link('Busca avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'ponto-grid',
'dataProvider' => $model->search(),
'htmlOptions' => array(
    'class' => 'table-responsive'
),
'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
'itemsCssClass' => 'table table-striped table-hover table-bordered table-condensed',
'cssFile' => false,
'summaryCssClass' => 'dataTables_info',
'summaryText' => 'Showing {start} to {end} of {count} entries',
'template' => '<div class="row"><div class="col-md-4 col-sm-12">{summary}</div><div class="col-md-8 col-sm-12">{pager}</div></div>{items}<div class="row"><div class="col-md-4 col-sm-12">{summary}</div><div class="col-md-8 col-sm-12">{pager}</div></div><br />',
'pager' => array(
    'htmlOptions' => array(
        'class' => 'pagination',
    ),
    'class' => 'CLinkPager',
        'htmlOptions' => array(
            'class' => 'pagination'
        ),
    'header' => false,
    'maxButtonCount' => 5,
    'cssFile' => false,
),
'filter' => $model,
'columns' => array(
array(
    'class' => 'CButtonColumn',
    'template' => '{update}{delete}'
),
		'id',
		'nome',
		'descricao',
		'bairro_id',
		'ativo',
		'created',
		/*
		'trajeto_id',
		*/
),
)); ?>
