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
        <!--<link href="<?php //echo Yii::app()->request->baseUrl;                             ?>/css/justified-nav.css" rel="stylesheet">-->
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
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <?php if (Yii::app()->user->isGuest) { ?>
                        <?php echo CHtml::beginForm($this->createAbsoluteUrl('/Login'), "post", array("class" => "navbar-form navbar-right", "role" => "form", "style" => "display:none;")); ?>
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
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#section-home" class="slow-scrolling">Home</a></li>
                        <li><a href="#section-first" class="slow-scrolling">Busca</a></li>
                        <li><a href="#section-second" class="slow-scrolling">Cadastre-se</a></li>
                        <li><a href="#section-third" class="slow-scrolling">Login</a></li>
                        <li><a href="#section-quarto" class="slow-scrolling">Sobre</a></li>
                        <li><a href="#section-cinco" class="slow-scrolling">Contato</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <?php echo $content; ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/bootstrap/3.1.1/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".date").datepicker({dateFormat: "dd/mm/yy"});
            });
            $(document).ready(function () {
                $(".slow-scrolling").click(function () {
                    $("html, body").animate({scrollTop: $(this.hash).offset().top}, 700);
                    return false;
                });
            });
        </script>
    </body>
</html>