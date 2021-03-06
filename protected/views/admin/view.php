<?php
$this->breadcrumbs = array(
    Yii::t("user", 'Users') => array('admin'),
    $model->username,
);


$this->menu = array(
    array('label' => Yii::t("user", 'Create User'), 'url' => array('create')),
    array('label' => Yii::t("user", 'Update User'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t("user", 'Delete User'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t("user", 'Are you sure to delete this item?'))),
    array('label' => Yii::t("user", 'Manage Users'), 'url' => array('admin')),
    array('label' => Yii::t("user", 'List User'), 'url' => array('/user')),
);
?>
<div class="col-md-10">
    <h1><?php echo Yii::t("user", 'View User') . ' "' . $model->username . '"'; ?></h1>

    <?php
    $attributes = array(
        'id',
        'username',
    );

    array_push($attributes, 'password', 'email', 'activkey', 'create_at', 'lastvisit_at', array(
        'name' => 'superuser',
        'value' => User::itemAlias("AdminStatus", $model->superuser),
            ), array(
        'name' => 'status',
        'value' => User::itemAlias("UserStatus", $model->status),
            )
    );

    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => $attributes,
    ));
    ?>
</div>
