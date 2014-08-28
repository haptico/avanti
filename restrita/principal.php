<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Bem-vindo ao site AVANTI" /> 
        <title>AVANTI || Motorista</title>

        <link type="text/css" rel="stylesheet" href="restrita/css/default.css" />
        <link rel="stylesheet" href="css/plugins/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css/jquery.tablesorter.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery.tablesorter.pager.css" />

        <script type="text/javascript" src="js/util.js"></script>
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="js/ui-1.10.0/jquery.ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui-1.10.0/jquery.ui.widget.min.js"></script>
        <script type="text/javascript" src="js/ui-1.10.0/jquery.ui.tabs.min.js"></script>
        <script type="text/javascript" src="js/ui-1.10.0/jquery.ui.position.min.js"></script>
        <script type="text/javascript" src="js/jquery.ui.timepicker.js?v=0.3.3"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
        <script type="text/javascript">
            function navega(target, acao, ID) {
                $('#ID').val(ID);
                $('#acao').val(acao);
                $('#target').val(target);
                $('#form').submit();
            }
            function navegaMenu(idAcesso) {
                $('#ID').val('');
                $('#acao').val('');
                $('#target').val('');
                $('#id_acesso').val(idAcesso);
                $('#form').submit();
            }
            function limpaAlert() {
                $("#alertCadastro").html('');
                $("#alertCadastro").hide();
                $("#alertSucesso").hide();
            }
        </script>
    </head>    
    <body>
        <form method="post" enctype="multipart/form-data" id="form" action="index.php">
            <input type="hidden" name="id_acesso" id="id_acesso" value="<?= $_POST['id_acesso']; ?>" />
            <input type="hidden" name="target" id="target" value="" />
            <input type="hidden" name="acao" id="acao" value="" />
            <div id="all">
                <div id="header">
                    <h1>Painel Administrativo</h1>
                </div>
                <hr />
                <div id="content">
                    <div class="menu">
                        <fieldset>
                            <legend></legend>
                            <?= AcessoAction::exibeMenu(); ?>
                            <ul>
                                <li><a href="logoff.php">Sair</a></li>
                            </ul>
                        </fieldset>
                    </div>
                    <? 
                        $interna = "home.php";
                        $idAcesso = $_POST['id_acesso'];
                        if ($idAcesso > 0){
                            $retAcesso = AcessoAction::exibeAcesso($idAcesso);
                            $interna = $retAcesso["ARQUIVO"];
                        }
                        $pagina = 'restrita/' . $_SESSION['PERFILUSERLOGADO_AVANTI'] . '/' . $interna;
                        include $pagina;
                    ?>
                    <div id="footer">
                        <table border="0" width="100%">
                            <tr>
                                <td width="60%" align="center">
                                    <small>&copy; Copyright 2014 AVANTI - Todos os direitos reservados.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>                                