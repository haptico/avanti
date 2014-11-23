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

            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                'items' => array(
                    array('label' => 'Home', 'url' => array('/')),
                    array('label' => Yii::t("user", "Usuários"), 'url' => array('/Admin')),
                    array('label' => Yii::t("user", "Mensalistas"), 'url' => array('/Mensalista')),
                    array('label' => Yii::t("user", "Avulso"), 'url' => array('/Avulso')),
                    array(
                        'label' => 'Veiculos <span class="caret"></span>',
                        'url' => '#',
                        'htmlOptions' => array('class' => 'dropdown-menu', "role" => "menu"),
                        'linkOptions' => array(
                            "class" => "dropdown-toggle",
                            "data-toggle" => "dropdown",
                            "role" => "button",
                            "aria-expanded" => "false",
                        ),
                        'itemOptions' => array('class' => 'dropdown'),
                        'items' => array(
                            array('label' => Yii::t("user", "Veiculos"), 'url' => array('/Veiculo')),
                            array('label' => Yii::t("user", "Tipos de Veiculo"), 'url' => array('/TipoVeiculo')),
                        )
                    ),
                    array(
                        'label' => 'Trajetos <span class="caret"></span>',
                        'url' => '#',
                        'htmlOptions' => array('class' => 'dropdown-menu', "role" => "menu"),
                        'linkOptions' => array(
                            "class" => "dropdown-toggle",
                            "data-toggle" => "dropdown",
                            "role" => "button",
                            "aria-expanded" => "false",
                        ),
                        'itemOptions' => array('class' => 'dropdown'),
                        'items' => array(
                            array('label' => Yii::t("user", "Trajetos"), 'url' => array('/Trajeto')),
                            array('label' => Yii::t("user", "Pontos"), 'url' => array('/Ponto')),
                        )
                    ),
                    array(
                        'label' => 'Localização <span class="caret"></span>',
                        'url' => '#',
                        'htmlOptions' => array('class' => 'dropdown-menu', "role" => "menu"),
                        'linkOptions' => array(
                            "class" => "dropdown-toggle",
                            "data-toggle" => "dropdown",
                            "role" => "button",
                            "aria-expanded" => "false",
                        ),
                        'itemOptions' => array('class' => 'dropdown'),
                        'items' => array(
                            array('label' => Yii::t("user", "UF"), 'url' => array('/Uf')),
                            array('label' => Yii::t("user", "Cidades"), 'url' => array('/Cidade')),
                            array('label' => Yii::t("user", "Bairros"), 'url' => array('/Bairro')),
                        )
                    ),
                    array('label' => Yii::t("user", "Logout") . ' (' . Yii::app()->user->name . ')', 'url' => $this->logoutUrl, 'visible' => !Yii::app()->user->isGuest),
                ),
                'encodeLabel' => false,
                'submenuHtmlOptions' => array(
                    'class' => 'dropdown-menu',
                    "role" => "menu",
                )
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