
<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ico/favicon.ico">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/css/bootstrap-theme.css" rel="stylesheet">

        <!-- jQuery ui -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/css/blitzer/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <!--<link href="<?php //echo Yii::app()->request->baseUrl;               ?>/css/justified-nav.css" rel="stylesheet">-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/carousel.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/2.1.1.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/i18n/jquery.ui.datepicker-pt-BR.js"></script>
    </head>

    <body>
        <?php echo $content; ?>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".date").datepicker({
                    dateFormat: "dd/mm/yy",
                    buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/img/calendar.gif",
                    buttonImageOnly: true,
                    buttonText: "Select date"
                });
                $(".datetime").datepicker({
                    dateFormat: "dd/mm/yy H:i:s",
                    buttonImage: "<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/img/calendar.gif",
                    buttonImageOnly: true,
                    buttonText: "Select date time"
                });
                $(".slow-scrolling").click(function () {
                    $("html, body").animate({scrollTop: $(this.hash).offset().top}, 700);
                    return false;
                });
            });
        </script>
    </body>
</html>