<?php
if (isset($_SESSION["MENU"]) && $_SESSION["MENU"] != "") {
    $pages = unserialize($_SESSION["ITENS"]);
    $menu = unserialize($_SESSION["MENU"]);
    $subMenu = unserialize($_SESSION["SUBMENU"]);
} else {
    $pages = NavigationAction::getNavigation();
    if (is_array($pages) && sizeof($pages) > 0) {
        foreach ($pages as $value) {
            if ($value->getParent() == "") {
                $menu[$value->getID()] = $value;
            } else {
                $subMenu[$value->getParent()][$value->getID()] = $value;
            }
        }
    }
    $_SESSION["ITENS"] = serialize($pages);
    $_SESSION["MENU"] = serialize($menu);
    $_SESSION["SUBMENU"] = serialize($subMenu);
}

$i = 0;
$strMenu = "";
$strMenuDrop = "";
if (count($menu) > 0) {
    foreach ($menu as $object) {
        if ($object->getVisivel() == 1) {
            if ($i < 7) {
                $strMenu .= "<li><a href=\"javascript: navigation('{$object->getID()}', '')\" title=\"{$object->getNome()}\">{$object->getNome()}</a></li>";
            } else {
                $strMenuDrop .= "<li><a href=\"javascript: navigation({$object->getID()}, '')\" title=\"{$object->getNome()}\" class=\"last-link\">{$object->getNome()}</a></li>";
            }
            $i++;
        }
    }
}
$navigation = <<<NAVI
        <ul id="nav">
            {$strMenu}
NAVI;
if ($i > 7) {
    $navigation.= <<<NAVI
            <li><a href="#" class="last-link">Mais ></a>
                <ul>
                    {$strMenuDrop}
                </ul>
            </li>
NAVI;
}
$navigation.= <<<NAVI
        </ul>
NAVI;

$option = ($opt) ? $opt : null;
if ($option) {

    if (isset($pages[$option])) {
        $idMenu = $pages[$option];
    } else {
        $idMenu = NavigationAction::Load($option);
    }

    $strSubMenu = "";
    if (is_a($idMenu, Navigation)) {

        $SYS_GIF_CORRENTE = ($idMenu->getGif()) ? Util::images($idMenu->getGif(), 32, 32) : "";
        $SYS_BARRA_LATERAL_CORRENTE = $idMenu->getNome();

        $buscaPai = true;
        while ($buscaPai) {
            if ($idMenu->getParent() != 0) {
                if (isset($pages[$idMenu->getParent()])) {
                    $idMenu = $pages[$idMenu->getParent()];
                } else {
                    $buscaPai = false;
                }
            } else {
                $buscaPai = false;
            }
        }

        if (count($subMenu[$idMenu->getID()]) > 0) {
            $strSubMenu .= <<<EOT
                <div id="menu">
                    <div id="content-menu">
EOT;
            $strSubMenu .= NavigationAction::getSubMenuHTML($subMenu, $idMenu->getID(), true, $option);
            $strSubMenu .= <<<EOT
                    </div>
                </div>
                <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
                <script type="text/javascript">qm_create(0,false,0,250,false,false,false,false,false);</script>
EOT;
        }
    }
}

$titulo_pagina['nome'] = $servidor_processador;
if ($SYS_BARRA_LATERAL_CORRENTE) {
    $titulo_pagina['item_acessado'] = $SYS_BARRA_LATERAL_CORRENTE;
} else {
    $titulo_pagina['item_acessado'] = "HOME";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="cache-control" content="no-cache, must-revalidate"/>
        <title><?= implode(" :: ", $titulo_pagina); ?></title>
        <link rel="shortcut icon" href="img/icons/btw_icone.ico"  /> 
        <link rel="stylesheet" type="text/css" href="css/reset.css?<?= filemtime(ROOT . '/css/reset.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="css/text.css?<?= filemtime(ROOT . '/css/text.css'); ?>" media="all" />
        <link rel="stylesheet" type="text/css" href="css/styles.css?<?= filemtime(ROOT . '/css/styles.css'); ?>" media="all" />
        <link rel="stylesheet" type="text/css" href="css/template.css?<?= filemtime(ROOT . '/css/template.css'); ?>" media="all" />
        <!--<link rel="stylesheet" type="text/css" href="css/view.css?<?//= filemtime(ROOT . '/css/view.css'); ?>" media="all" />-->
        <!--<link rel="stylesheet" type="text/css" href="css/form.css?<?//= filemtime(ROOT . '/css/form.css'); ?>" media="all" />-->
        <link rel="stylesheet" type="text/css" href="templates/bootstrap/css/bootstrap/bootstrap.css?<?= filemtime(ROOT . '/templates/bootstrap/css/bootstrap/bootstrap.css'); ?>" media="all" />
        <link rel="stylesheet" type="text/css" href="css/menu.css?<?= filemtime(ROOT . '/css/menu.css'); ?>" media="all" />
        <link rel="stylesheet" type="text/css" href="css/datagrid.css?<?= filemtime(ROOT . '/css/datagrid.css'); ?>" media="all" />
        <link type="text/css" href="css/redmond/jquery-ui-1.8.16.custom.css?<?= filemtime(ROOT . '/css/redmond/jquery-ui-1.8.16.custom.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/tableTools.ui.css?<?= filemtime(ROOT . '/css/tableTools.ui.css'); ?>"/>

        <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/view.js"></script>
        <script type="text/javascript" src="js/DD_roundies.js"></script>
        <script type="text/javascript" src="js/jquery.meio.mask.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
        <script type="text/javascript" src="js/util.js?<?= filemtime(ROOT . '/js/util.js'); ?>"></script>
        <script type="text/javascript" src="js/functions.js?<?= filemtime(ROOT . '/js/functions.js'); ?>"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="js/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
        <script type="text/javascript" src="js/tabletools/jquery.dataTables.js"></script>   
        <script type="text/javascript">
            $(document).ready(function(){
                $("#qm0").css('display', 'block');
                try {
                    $("#container").ajaxStart(function(){$("#lightBox").show()})
                    .ajaxStop(function(){$("#lightBox").hide()})
                    .ajaxError(function(){$("#lightBox").hide()});
                    // Menu dropdown
                    jQuery("#nav ul").css({display: "none"}); // Opera Fix
                    jQuery("#nav li").hover(function(){
                        jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400);
                    },function(){
                        jQuery(this).find('ul:first').css({visibility: "hidden"});
                    });

                    DD_roundies.addRule('.titles', '3px 3px 0px 0px', true);
                    DD_roundies.addRule('.botao', '5px 5px 5px 5px', true);
                    if($("#li_filtros :input")){
                        $("#li_filtros :input").each(highlightFiltros);
                    }
                    // Coloca a marcação de linha em todas as tabelas que implementam a classe Display.
                    $(".display").click( function(e) {
                        $(e.target).parent('tr').toggleClass('row_selected');
                    });
                } catch(erro) {
                    alert(erro.message);
                }
            });
            function sair(){
                $("#acao").val("LOGOFF");
                $("#form").submit();
            }
        </script>
    </head>
    <body>
        <div id="container">
            <div id="erro_post" style="display: none"></div>
            <!-- lightBox --> 
            <div id="lightBox" style="display: none; background-image:  url(imagens/lightBox.png); position: fixed; left: 0px; top: 0px; width:100%; height:100%; text-align:center; z-index: 300;">
                <div id="conteudoEmail" style="position: absolute; left: 0px; top: 0px; width:100%; height:100%; text-align:center; z-index: 1000;">
                    <div id="conteudo" style=" margin: 100px auto; padding:15px; text-align:center;"><img src="imagens/icones/modelo1/LoadingGif/loading_animation.gif" /><br /><span style="color: #fff;">Carregando...</span></div>
                </div>
            </div>    
            <!-- lightBox --> 
            <div id="status">
                <div id="user">
                    <span class="dataPorEstenso"><?= strftime("%d de %B de %Y", time()); ?></span>
                    <ul>
                        <li class="user"><?= $dadosUsuarioLogado->getNome(); ?></li>
                        <li class="account"><?= $dadosUsuarioLogado->getPerfil(); ?></li>
                        <li class="user"><a href="#" onclick="navigation('')">Usuários Logados</a></li>
                        <li class="chpwd"><a href="#" onclick="navigation(55)">Trocar Senha</a></li>
                        <li class="logout"><a href="#" onclick="sair()">Sair</a></li>
                        <? /*if ($DESENVOLVEDOR) { ?>
                            <li id="department">
                                <form name="ch_dep" id="ch_dep" action="" method="post">
                                    <?
                                    $depts = array("CPTFA", "GP", "LP", "Prevendas", "Elaborador CPCOM", 'MW Planning', 'Gestão', 'Vendas', 'Fiber', 'Configuração', 'Tim Fixo');
                                    echo combo_array2('sup_departamento', $depts, $qry->data["departamento"], 1, 1);
                                    ?>
                                </form>
                            </li>
                        <? } */ ?>
                    </ul>
                </div>
            </div>
            <div id="header">
                <div id="header-container">
                    <div id="logo">
                        <a href="#" onclick="navigation('')" title="Between - Sistema Integra.">
                            <img src="img/btw.png" alt="Between - Sistema Integra" border="0" style="float:left" />
                        </a>
                        <? if ($database != 'cttoprd') { ?>
                            <h1><?= $servidor_processador; ?></h1>
                        <? } else { ?>
                            <img src="img/cruscotto-logo.png" alt="Sistema Cruscotto" style="float: left;" />
                        <? } ?>
                    </div>
                    <div id="search" class="search">
                        <div class="coluna"> <span class="opt-title">Procurar</span>
                            <form name="search_form" id="search_form" action="" method="post">
                                <div class="search-string">
                                    <input name="searchString" onkeyup="if(event.keyCode == 13){javascript:buscaGeral();}" id="searchString" class="type-text inputs" type="text" />
                                </div>
                                <a href="javascript:buscaGeral();" class="search-btn"><img src="img/search/header.gif" alt="buscar" /></a>
                            </form>
                        </div>
                    </div>
                    <div style="clear:both" class="invisibletwo">&nbsp;</div>
                    <div id="navigation">
                        <? echo($navigation); ?>
                    </div>
                </div>
            </div>
            <div id="content">
                <img src="img/body/content.corner-left.jpg" class="content-left-corner" alt="" />
                <img src="img/body/content.corner-right.jpg" class="content-right-corner" alt="" />
                <div id="content-container">
                    <form action="<?= $PHP_SELF; ?>" method="post" enctype="multipart/form-data" name="form" id="form" class="appnitro" >

                        <input type="hidden" name="id_entidade_wf" id="id_entidade_wf" value="" />
                        <input type="hidden" name="id_wf_posto_pendencia_wf" id="id_wf_posto_pendencia_wf" value="" />
                        <input type="hidden" name="acao_wf" id="acao_wf" value="" />

                        <input type="hidden" name="id_registro_alterar" value="" />
                        <input type="hidden" name="strBusca" id="strBusca" value="" />
                        <!-- OPT FOI PARA O RODAPE -->
                        <input type="hidden" name="opt2" id="opt2" value="<?= $opt2; ?>" />
                        <input type="hidden" name="acao" id="acao" value="" />
                        <input type="hidden" name="acao2" id="acao2" value="" />
                        <input type="hidden" name="pagina" value="<?= ((!$pagina) ? "1" : $pagina); ?>" />
                        <?php echo($strSubMenu); ?>
                        <div id="conteudo">
                            <?php
                            if ($opt) {
                                switch ($opt) {
                                    case("55"):
                                        $SYS_NOME_RELATORIO = "Troca Senha";
                                        require_once(ROOT . "/troca.senha.tela.php" );
                                        break;
                                    default:
                                        $arquivoInclude = $idWfPostoTmp = '';

                                        if (isset($pages[$opt])) {
                                            $page = $pages[$opt];
                                        } else {
                                            $page = NavigationAction::Load($opt);

                                            $SYS_GIF_CORRENTE = ($page->getGif()) ? Util::images($page->getGif(), 32, 32) : "";
                                            $SYS_BARRA_LATERAL_CORRENTE = $page->getNome();
                                        }

                                        // se tem '?' é pq tem querystring, entao popula um array chamado $arrParams com a key->value dos gets
                                        if (strpos($page->getArquivo(), '?') > 0) {
                                            $arquivoInclude = substr($page->getArquivo(), 0, strpos($page->getArquivo(), '?'));
                                            $params = substr($page->getArquivo(), strpos($page->getArquivo(), '?') + 1);
                                            if ($params!='') {
                                                $arrParamsTemp = split('&', $params);
                                            }
                                            if (count($arrParamsTemp) > 0) {
                                                foreach ($arrParamsTemp as $pTemp) {
                                                    $arrParams[substr($pTemp, 0, strpos($pTemp, '='))] = substr($pTemp, strpos($pTemp, '=') + 1);
                                                }
                                            }
                                        } else {
                                            $arquivoInclude = $page->getArquivo();
                                        }
                                        $idWfPostoTmp = $page->getIdPostoWf();
                                        $arquivoIncludeCompleto = ROOT . '/' . $arquivoInclude;
                                        if (($DESENVOLVEDOR)) {
                                            echo('<p class="info">' . $arquivoIncludeCompleto . ' - ID: ' . $opt . ' </p>');
                                        }
                                        if (trim($arquivoInclude) != "" && file_exists($arquivoIncludeCompleto)) {
                                            echo '<input type="hidden" name="id_posto_wf" id="id_posto_wf" value="' . $idWfPostoTmp . '" />';
                                            require_once($arquivoIncludeCompleto);
                                        } else {
                                            echo '<h1 class="alert">Página não encontrada</h1>';
                                        }
                                        break;
                                }
                            } else {
                                // HOME
                                require_once(ROOT . "/inc/home.php");
                            }
                            ?>
                        </div>
                        <?php
                        require_once("rodape_geral.inc.php");
                        $tempoFim = microtime(true);
                        if ($DESENVOLVEDOR) {
                            ?>
                            <div id="systemInfo">
                                <table class="tablesorter">
                                    <thead>
                                        <tr>
                                            <th>Tempo Total</th>
                                            <th>Tempo PHP</th>
                                            <th>Tempo Banco</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $tempoFim - $tempoIni ?></td>
                                            <td><?= $tempoFim - $tempoIni - $tempoBanco ?></td>
                                            <td><?= $tempoBanco ?></td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                            <?
                            if ($servidor_processador == 'CRUSCOTTO') {
                                //DESTACA A TELA QUE ESTA ACESSANDO PRODUCAO
                                ?>
                                <style type="text/css"  >
                                    #content{background: #ff0000 !important}
                                    #content-container{background: #fff !important}
                                </style>
                                <?
                            }
                        }
                        ?>
