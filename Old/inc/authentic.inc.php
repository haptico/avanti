<?php
if(!isset($_SESSION)){
    session_start();
}
$lastAccess = $_SESSION["lastAccess"];
$now = time("d/m/Y G:i:s");
$tempoTranscorrido = ($now-$lastAccess);
if(!isset($_SESSION["lastAccess"]) || ($tempoTranscorrido >= 300) || !UsuarioAction::isLogged()){
    session_destroy();
    if(function_exists("redirect")){
        redirect("login.php");
    }else{
        die("<script type='text/javescript'>self.location='login.php'</script>");
    }
}else{
    $_SESSION["lastAccess"] = $now;
}
?>

