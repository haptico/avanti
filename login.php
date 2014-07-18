<?php
if ($acaoSenha) {
    if ($email != '') {
        if ($login2 != "") {
            $usuario = UsuarioAction::loadByEmail($email, $login2);
            if ($usuario instanceof Usuario) {
                //passa pro email a senha dele
                $senha_resetada = uniqid();
                $ret = UsuarioAction::resetarSenha($senha_resetada, $usuario->getID());
                if (is_null($ret)) {
                    $mail = new PHPMailer(true);
                    $mail->SetFrom('no-reply@between-br.com.br');
                    $mail->Subject = "[INTEGRA] Senha de acesso";
                    $mail->Body = "Sua nova senha de acesso � " . $senha_resetada;
                    $mail->AddAddress($email);
                    if ($mail->Send()) {
                        $msg = "A nova senha foi enviada para o email informado.";
                    } else {
                        $msg = "Ocorreu um erro no envio do email, se o problema persistir, favor contate o suporte técnico.";
                    }
                } else {
                    $msg = "Não foi possível resetar a senha, se o problema persistir, favor contate o suporte técnico.";
                }
            } else {
                $msg = "Usuário não encontrado ou inativo";
            }
        } else {
            $msg = "Login inválido";
        }
    } else {
        $msg = 'Email inválido.';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?= $servidor_processador; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="img/icons/btw_icone.ico" />
        <link rel="stylesheet" type="text/css" href="css/view.css" />
        <link rel="stylesheet" type="text/css" href="css/login.css" />

        <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#input_login").focus();
            });
            $('#dialog_link, ul#icons li').hover(
            function() { $(this).addClass('ui-state-hover'); },
            function() { $(this).removeClass('ui-state-hover'); }
        ); 
        </script>
    </head>
    <body>
        <div id="header" class="container_16">
            <div id="header-container">
                <div class="grid_3" style="text-align:left;">&nbsp;</div>
                <div id="logo">
                    <? if ($database != 'cttoprd') { ?>
                        <h1><?= $servidor_processador; ?></h1>
                    <? } ?>
                </div>
            </div>
        </div>
        <div id="container">
            <div id="login">
                <div style="overflow:hidden;">
                    <form name="flogin" action="<?= $PHP_SELF; ?>" method="post" class="appnitro">
                        <input type="hidden" name="opt" value="<?= $opt ?>" />
                        <input type="hidden" name="id_usuario_logado2" />
                        <input type="hidden" name="acaoSenha" id="acaoSenha" value="" />
                        <input type="hidden" name="LOGIN" id="logar_no_sistema" value="1" />
                        <ul>
                            <li>
                                <div id="logar" style="float:left; display:block; width:50%;">
                                    <ul>
                                        <li><label class="label" for="login">Login:</label></li>
                                        <li><input type="text" id="input_login" name="login" value="" class="element text large" onkeyup="if(event.keyCode == 13){javascript:$('#acaoSenha').val('');$('#logar_no_sistema').val('1');document.flogin.submit();}" /></li>
                                        <li><label class="label"  for="senha">Senha:</label></li>
                                        <li><input type="password" name="senha" id="senha" value="" onkeyup="if(event.keyCode == 13){javascript:$('#acaoSenha').val('');$('#logar_no_sistema').val('1');document.flogin.submit();}" class="element text large" /></li>
                                        <li><a href="#" onclick="javascript:$('#acaoSenha').val('');$('#logar_no_sistema').val('1');document.flogin.submit();" class="login">Entrar</a></li>
                                        <li>
                                            <a href="#"  onclick="javascript: $('#logar').hide();$('#esqsenha').show();" class="trocar-senha">Esqueci a Senha</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div id="esqsenha" style="display:none; float:left;width:50%;">
                                    <ul>
                                        <li><label class="label" for="login2">Login:</label></li>
                                        <li><input type="text" name="login2" id="login2" style="margin-left: 0px; padding-bottom: 5px;" value="" class="element text large" /></li>
                                        <li><label class="label" for="email">Email:</label></li>
                                        <li><input type="text" name="email" id="email" onkeyup="if(event.keyCode == 13){javascript:$('#acaoSenha').val('enviarEmail');$('#logar_no_sistema').val('');document.flogin.submit();}" value="" class="element text large" /></li>
                                        <li><a href="#" onclick="javascript:$('#acaoSenha').val('enviarEmail');$('#logar_no_sistema').val('');document.flogin.submit();" class="trocar-senha">Enviar Senha</a></li>
                                        <li>
                                            <a href="#" onclick="javascript: $('#esqsenha').hide();$('#logar').show();" class="login">Voltar</a>
                                        </li>
                                    </ul>
                                </div>
                                <div style="float:right;padding:0px 0 0;color: red;width: 170px">&nbsp; <?= $msg; ?> </div>
                            </li>
                           
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>