<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Bem-vindo ao site AVANTI" /> 
    <title>AVANTI || Motorista</title>
    
    <link type="text/css" rel="stylesheet" href="internas/motorista/css/default.css" />
    <link type="text/css" rel="stylesheet" href="css/jquery.tablesorter.css" />
    <link type="text/css" rel="stylesheet" href="css/jquery.tablesorter.pager.css" />
    
    <script type="text/javascript" src="js/util.js"></script>
    <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
    <script type="text/javascript">
        function navega(target, acao, ID){
            $('#ID').val(ID);
            $('#acao').val(acao);
            $('#target').val(target);
            $('#form').submit();
        }
        function navegaMenu(idAcesso){
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
    
