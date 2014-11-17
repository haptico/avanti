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
        <!--<link href="<?php //echo Yii::app()->request->baseUrl;                  ?>/css/justified-nav.css" rel="stylesheet">-->
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
        <script>
            $(function () {
                $(".date").datepicker({dateFormat: "dd/mm/yy"});
            });
        </script>        
    </head>

    <body>

        <div class="navbar-wrapper">
            <div class="container">

                <div class="navbar navbar-inverse navbar-static-top" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><?php echo("A-VAN-TI"); ?></a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'htmlOptions' => array('class' => 'nav navbar-nav'),
                                'items' => array(
                                    array('label' => 'Home', 'url' => array('/Post/index')),
                                    array('label' => Yii::t("user", "Registration"), 'url' => array('/Registration')),
                                    array('label' => Yii::t("user", 'About'), 'url' => array('/Site/page', 'view' => 'about')),
                                    array('label' => Yii::t("user", 'Contact'), 'url' => array('/Site/contact')),
                                    array('label' => Yii::t("user", 'Login'), 'url' => array('/Login'), 'visible' => Yii::app()->user->isGuest),
                                    array('label' => Yii::t("user", 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/Logout'), 'visible' => !Yii::app()->user->isGuest)
                                ),
                            ));
                            if (Yii::app()->user->isGuest) {
                                ?>
                                <?php echo CHtml::beginForm($this->createAbsoluteUrl('/Login'), "post", array("class" => "navbar-form navbar-right", "role" => "form")); ?>
                                <div class="form-group">
                                    <?php $login = new UserLogin(); ?>
                                    <?php echo CHtml::activeTextField($login, 'username', array("placeholder" => Yii::t("user", "Email"), "class" => "form-control")) ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::activePasswordField($login, 'password', array("placeholder" => Yii::t("user", "Password"), "class" => "form-control")) ?>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <?php echo CHtml::activeCheckBox($login, 'rememberMe'); ?> <?php echo Yii::t("user", "Remember me"); ?>
                                    </label>
                                </div>
                                <?php echo CHtml::submitButton(Yii::t("user", "Login"), array("type" => "submit", "class" => "btn btn-success")); ?>
                                <?php
                                echo CHtml::endForm();
                            } else {
                                ?>


                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/Desert.jpg" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/Hydrangeas.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery/Lighthouse.jpg" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
        <!-- /.carousel -->

        <div class="container">
            <?php echo $content; ?>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/js/bootstrap.js"></script>
    </body>
</html>