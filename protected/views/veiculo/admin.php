<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */

$this->breadcrumbs = array(
    'Veiculos' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Veiculo', 'url' => array('index')),
    array('label' => 'Create Veiculo', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $('#veiculo-grid').yiiGridView('update', {
                data: $(this).serialize()
        });
        return false;
    });
");
?>
<div class="col-md-10">
    <h1>Manage Veiculos</h1>
    <p>
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </p>

    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'veiculo-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'itemsCssClass' => 'table table-striped table-bordered table-hover table-condensed',
        'blankDisplay' => 'Ação',
        'columns' => array(
            array(
                'class' => 'CButtonColumn',
                'template' => '{update}{delete}'
            ),
            'id',
            'descricao',
            'placa',
            'vagas',
            'tipo_veiculo_id',
            'user_id',
            array(
                'name' => 'ativo',
                'filter' => array('S' => 'Active', 'N' => 'Inactive'),
                'type' => 'html',
                'value' => '
                            CHtml::tag("div", array(
                                "style"=>"text-align: center",
                            ),
                            UtilityHtml::getStatusSpan(CHtml::value($data, "ativo"))
                        )'
            ),
            array(
                'name' => 'created',
                'value' => 'date("M j, Y", $data->created)',
            ),
        ),
    ));
    ?>
</div>