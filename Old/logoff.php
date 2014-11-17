<?php
session_start();
unset($_SESSION['IDPERFILUSERLOGADO_AVANTI']);
unset($_SESSION['PERFILUSERLOGADO_AVANTI']);
unset($_SESSION['USERLOGADO_AVANTI']);
header('Location: index.php' ) ;
?>