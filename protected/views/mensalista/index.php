<?php
/* @var $this MensalistaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Mensalistas',
);

$this->menu = array(
    array('label' => 'Create Mensalista', 'url' => array('create')),
    array('label' => 'Manage Mensalista', 'url' => array('admin')),
);
?>
<div class="col-md-10">
    <h1>Mensalistas</h1>

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ));
    ?>
</div>