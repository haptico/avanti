<?php
$this->breadcrumbs = array(
    Yii::t("user", "Users"),
);
//if (UserModule::isAdmin()) {
$this->menu = array(
    array('label' => Yii::t("user", 'Manage Users'), 'url' => array('/admin')),
);
//}
?>
<div class="col-md-10">
<h1><?php echo Yii::t("user", "List User"); ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
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
    'columns' => array(
        array(
            'name' => 'username',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
        ),
        'create_at',
        'lastvisit_at',
    ),
));
?>
</div>