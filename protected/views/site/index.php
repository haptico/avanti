<?php $this->pageTitle = Yii::app()->name; ?>
<section id="section-home"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>A-VAN-TI <small>Sistema de Vans</small></h1>
                    <p>
                        Você precisa de transporte para seu trabalho?<br />
                        Encontre o melhor meio de e mais curto de transporte para ir ao trabalho.
                    </p>
<!--                    <p>
                        <a class="btn btn-primary btn-lg" role="button" href="#">Learn more</a>
                    </p>-->
                </div>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                <blockquote class="blockquote-reverse">
                    <h1>Encontre um trajeto <small>Compativel com sua necessidade.</small></h1>
                    <p>Informe seu ponto de origem, "onde você costumar pegar sua condução para ir ao trabalho".<br />
                        E seu ponto de destino, "o ponto mais próximo de seu trabalho ou lugar em que você possa descer do transporte com segurança".</p>
                    <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>                    
                </blockquote>
            </div>
        </div>
    </div>
</section>

<section id="section-first"> 
    <div id="map">&nbsp;</div>
    <div class="container">
        <div class="row">
            <!--            <div class="col-md-12">
                            <div class="page-header">
                                <h1>Encontre um trajeto <small>Compativel com sua necessidade.</small></h1>
                                <p>Informe seu ponto de origem, "onde você costumar pegar sua condução para ir ao trabalho".<br />
                                    E seu ponto de destino, "o ponto mais próximo de seu trabalho ou lugar em que você possa descer do transporte com segurança".</p>
                            </div>
                        </div>-->
            <div class="col-md-offset-1 col-md-3 busca-background first">
                <?php echo CHtml::beginForm("#", "post", array("class" => "form-horizontal", "role" => "form")); ?>
                <fieldset>
                    <legend>Ponto de origem</legend>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <?php
                            echo CHtml::dropDownList("origem_uf", 'origem_uf', CHtml::listData(UF::model()->findAll(), 'id', 'nome'), array("id" => "origem_uf", "class" => "form-control input-sm",
                                "ajax" => array(
                                    'type' => 'GET',
                                    'url' => CController::createUrl('/Cidade/GetCidadeByUf'),
                                    'update' => '#origem_cidade',
                                    'data' => array('uf_id' => 'js:$(this).val()')
                            )));
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo CHtml::dropDownList("origem_cidade", 'origem_cidade', array(), array("id" => "origem_cidade", "class" => "form-control input-sm",
                                "ajax" => array(
                                    'type' => 'GET',
                                    'url' => CController::createUrl('/Bairro/GetBairroByCidade'),
                                    'update' => '#origem_bairro',
                                    'data' => array('cidade_id' => 'js:$(this).val()')
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <?php echo CHtml::dropDownList("origem_bairro", 'origem_bairro', array(), array("id" => "origem_bairro", "class" => "form-control input-sm")); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" name="origem_endereco" id="origem_endereco" placeholder="Endereço">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Ponto de destino</legend>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <?php
                            echo CHtml::dropDownList("destino_uf", 'destino_uf', CHtml::listData(UF::model()->findAll(), 'id', 'nome'), array("id" => "destino_uf", "class" => "form-control input-sm",
                                "ajax" => array(
                                    'type' => 'GET',
                                    'url' => CController::createUrl('/Cidade/GetCidadeByUf'),
                                    'update' => '#destino_cidade',
                                    'data' => array('uf_id' => 'js:$(this).val()')
                            )));
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo CHtml::dropDownList("destino_cidade", 'destino_cidade', array(), array("id" => "destino_cidade", "class" => "form-control input-sm",
                                "ajax" => array(
                                    'type' => 'GET',
                                    'url' => CController::createUrl('/Bairro/GetBairroByCidade'),
                                    'update' => '#destino_bairro',
                                    'data' => array('cidade_id' => 'js:$(this).val()')
                            )));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <?php echo CHtml::dropDownList("destino_bairro", 'destino_bairro', array(), array("id" => "destino_bairro", "class" => "form-control input-sm")); ?>
                        </div>
                    </div>
                </fieldset>
                <br />
                <button type="submit" id="form-busca" class="btn btn-default">Buscar</button>
                <?php echo CHtml::endForm(); ?>
            </div>
            <!--            <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Resultados da Busca</div>
            
                                <div class="panel-body">
                                    <p>Ponto mais próximos de sua oregem e destino. Selecione sua origem e o destino que estão mas próximo de você.</p>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>Bairro</th>
                                            <th>Ponto</th>
                                            <th>Sentido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>RJ</td>
                                            <td>Rio de Janeiro</td>
                                            <td>Barra da tijuca</td>
                                            <td>Barra Shopping</td>
                                            <td>Chegada</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>RJ</td>
                                            <td>Rio de Janeiro</td>
                                            <td>Barra da tijuca</td>
                                            <td>Barra Square</td>
                                            <td>Chegada</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>RJ</td>
                                            <td>Rio de Janeiro</td>
                                            <td>Niteroi</td>
                                            <td>Santa Rosa</td>
                                            <td>Saida</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>RJ</td>
                                            <td>Rio de Janeiro</td>
                                            <td>Niteroi</td>
                                            <td>Icarai</td>
                                            <td>Saida</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>-->
        </div>
    </div>
</section>
<section id="section-second"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</section>
<section id="section-third">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
        </div>
    </div>
</section>
<section id="section-quarto">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
        </div>
    </div>
</section>
<section id="section-cinco">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
        </div>
    </div>
</section>