<?php $this->beginContent('application.views.layouts.main'); ?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sigin.css" rel="stylesheet">

<?php echo $content; ?>

<?php $this->endContent(); ?>