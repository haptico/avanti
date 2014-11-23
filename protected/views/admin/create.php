<?php
$this->breadcrumbs = array(
    Yii::t("user", 'Users') => array('admin'),
    Yii::t("user", 'Create'),
);

$this->menu = array(
    array('label' => Yii::t("user", 'Manage Users'), 'url' => array('admin')),
    array('label' => Yii::t("user", 'List User'), 'url' => array('/user')),
);
?>
<div class="col-md-10">
    <h1><?php echo Yii::t("user", "Create User"); ?></h1>

    <?php echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile)); ?>
</div>