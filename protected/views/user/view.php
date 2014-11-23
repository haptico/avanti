<?php
$this->breadcrumbs = array(
    Yii::t("user", 'Users') => array('index'),
    $model->username,
);

$this->menu = array(
    array('label' => Yii::t("user", 'List User'), 'url' => array('index')),
);
?>
<div class="col-md-10">
    <h1><?php echo Yii::t("user", 'View User') . ' "' . $model->username . '"'; ?></h1>
    <?php
// For all users
    $attributes = array(
        'username',
    );

    array_push($attributes, 'create_at', array(
        'name' => 'lastvisit_at',
        'value' => (($model->lastvisit_at != '0000-00-00 00:00:00') ? $model->lastvisit_at : Yii::t("user", 'Not visited')),
            )
    );

    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => $attributes,
    ));
    ?>
</div>