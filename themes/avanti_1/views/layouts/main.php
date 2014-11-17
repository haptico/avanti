<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href=".<?php echo Yii::app()->request->baseUrl; ?>/assets/ico/favicon.ico">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- jQuery ui -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/ui/1.9.2/css/blitzer/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

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
            $(function() {
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
                <!--                <ul class="nav nav-justified">
                                    <li class="active"><a href="#">Home</a></li>
                                    <li><a href="#">Projects</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Downloads</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>-->
            </div>

            <!-- Jumbotron -->
            <!--            <div class="jumbotron">
                            <h1>Marketing stuff!</h1>
                            <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
                            <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>
                        </div>-->

            <!-- Example row of columns -->
            <!--<div class="row">-->
            <?php echo $content; ?>
            <!--                <div class="col-lg-4">
                                <h2>Safari bug warning!</h2>
                                <p class="text-danger">As of v7.0.1, Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
                            </div>
                            <div class="col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                                <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
                            </div>
                            <div class="col-lg-4">
                                <h2>Heading</h2>
                                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                                <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
                            </div>-->
            <!--</div>-->

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