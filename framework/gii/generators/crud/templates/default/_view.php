<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $data <?php echo $this->getModelClass(); ?> */
?>
<div class="col-md-6">
    <dl class="dl-horizontal">
        <?php
        echo "\t<dt><?php echo CHtml::encode(\$data->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?></dt>\n";
        echo "\t<dd><?php echo CHtml::link(CHtml::encode(\$data->{$this->tableSchema->primaryKey}), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?></dd>";
        $count = 0;
        foreach ($this->tableSchema->columns as $column) {
            if ($column->isPrimaryKey)
                continue;
            if (++$count == 7)
                echo "\t<?php /*\n";
            echo "\t<dt><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?></dt>\n";
            echo "\t<dd><?php echo CHtml::encode(\$data->{$column->name}); ?></dd>\n";
        }
        if ($count >= 7)
            echo "\t*/ ?>\n";
        ?>
    </dl>
</div>