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
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <link rel="stylesheet" type="text/css" href="css/view.css" />

        <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
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
        <header> 
            <div class="box-header"> 
                <a href="index.php"> 
                    <img src="img/cruscotto_logo.png" height="30px" alt="Avanti" class="logo" /> 
                </a> 
<!--                <ul> 
                    <li>
                        <a href="#transporte" title="Encontre transportes">Buscar Transporte</a>
                    </li> 
                    <li>
                        <a href="#passageiro" title="Encontre passageiros para seu transporte">Encontrar Passageiros</a>
                    </li> 
                </ul> -->
                <div class="box-deslogado"> 
                    <div class="box-deslogado-menu"> 
                        <ul> 
                            <li>
                                <a href="javascript:void(0);" class="btnLogin">Log in</a>
                            </li> 
                            <li>
                                <a href="#register">Cadastre-se</a>
                            </li> 
                        </ul> 
                    </div> 
                    <div class="box-deslogado-login"> 
                        <div class="tip tipOpcoes"> 
                            <img src="http://www.99freelas.com.br/images/topTip.png" /> 
                        </div> 
                        <div class="float-box"> 
                            <div class="float-box-login"> 
                                <div class="box-result-validation cp-box-error">
                                    <b>Ops!</b> Verifique os dados informados!
                                </div> 
                                <input id="email" type="text" placeholder="Email" maxlength="200" name="email" /> 
                                <input id="senha" type="password" placeholder="Senha" maxlength="50" /> 
                                <button id="btnEfetuarLogin" class="facebookStyle facebookStyleBlue">Continuar</button> 
                                <div class="box-login-opcoes"> 
                                    <div class="left"> 
                                        <input type="checkbox" id="mantenhaMeLogado" checked="" /> 
                                        <label for="mantenhaMeLogado">Mantenha-me logado</label> 
                                    </div> 
                                    <div class="right"> 
                                        <a href="#password">Esqueceu sua senha?</a> 
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </header>        
    </body>
</html>