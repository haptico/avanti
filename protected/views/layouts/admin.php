<?php $this->beginContent('application.views.layouts.main'); ?>
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


                <?php
            }

            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                'items' => array(
                    array('label' => 'Home', 'url' => array('/')),
                    array('label' => Yii::t("user", "Veiculos"), 'url' => array('/Veiculo')),
//                    array('label' => Yii::t("user", 'About'), 'url' => array('Site/page', 'view' => 'about')),
//                    array('label' => Yii::t("user", 'Contact'), 'url' => array('/Site/contact')),
//                    array('label' => Yii::t("user", 'Login'), 'url' => array('/Login'), 'visible' => Yii::app()->user->isGuest),
//                    array('label' => Yii::t("user", 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/Logout'), 'visible' => !Yii::app()->user->isGuest)
                ),
            ));
            ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <?php
            $this->beginWidget('zii.widgets.CPortlet');
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'nav nav-pills'),
            ));
            $this->endWidget();
            ?>
        </div>
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>