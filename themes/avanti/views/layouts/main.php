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
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery ui -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/css/blitzer/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/justified-nav.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="<?php echo Yii::app()->request->baseUrl; ?>/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/2.1.1.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script>
            $(function () {
                $(".date").datepicker({dateFormat: "dd/mm/yy"});
            });
        </script>        
    </head>

    <body>

        <div class="container">

            <div class="masthead">
                <h3 class="text-muted"><?php echo CHtml::encode($this->pageTitle); ?></h3>
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'nav nav-justified'),
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div>

            <?php echo $content; ?>

            <!-- Site footer -->
            <div class="footer">
                <p>&copy; Company 2014</p>
            </div>

        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    </body>
</html>