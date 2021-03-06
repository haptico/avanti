<?php
$this->breadcrumbs = array(
    Yii::t("user", 'Users') => array('/user'),
    Yii::t("user", 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t("user", 'Create User'), 'url' => array('create')),
    array('label' => Yii::t("user", 'Manage Users'), 'url' => array('admin')),
    array('label' => Yii::t("user", 'List User'), 'url' => array('/user')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<div class="col-md-10">
    <h1><?php echo Yii::t("user", "Manage Users"); ?></h1>

    <p><?php echo Yii::t("user", "You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

    <?php echo CHtml::link(Yii::t("user", 'Advanced Search'), '#', array('class' => 'search-button')); ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'user-grid',
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
            array(
                'name' => 'id',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
            ),
            array(
                'name' => 'username',
                'type' => 'raw',
                'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
            ),
            array(
                'name' => 'email',
                'type' => 'raw',
                'value' => 'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
            ),
            'create_at',
            'lastvisit_at',
            array(
                'name' => 'superuser',
                'value' => 'User::itemAlias("AdminStatus",$data->superuser)',
                'filter' => User::itemAlias("AdminStatus"),
            ),
            array(
                'name' => 'status',
                'value' => 'User::itemAlias("UserStatus",$data->status)',
                'filter' => User::itemAlias("UserStatus"),
            ),
        ),
    ));
    ?>
</div>
