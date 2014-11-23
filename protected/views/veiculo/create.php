<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */

$this->breadcrumbs = array(
    'Veiculos' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Veiculo', 'url' => array('index')),
    array('label' => 'Manage Veiculo', 'url' => array('admin')),
);
?>
<div class="col-md-10">
    <h1>Create Veiculo</h1>

    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>