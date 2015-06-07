<?php
session_start();
ob_start();
require_once 'class/query.class.php';
require_once 'class/ferramenta.class.php';

$Ferramenta = new Ferramenta();
$Query = new Query();

date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

?>
<!DOCTYPE html>
<html lang="en">
<a name="topo"></a>
  <head>
<!--     <meta charset="utf-8"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content=" Sistemas de gestão, buscando maior controle agilidade e lucratividade.">
    <meta name="author" content="Atrati Consulting">
    <META NAME="keywords" CONTENT="sistema financeiro web, sistema financeiro, sistemas financeiros, BF, (BF), Business Facility,
    BF SysAdmin, BF Utilities, Atrati Consultoria, sysadmin, sisadmin, bf sistemas,online, on-line, on line ">
    <link rel="icon" href="favicon.ico">

    <title>Business Facility</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">

  </head>

<?php

function getKey($key)
{
// Verifica se $_GET[$key] está com algum valor, se estiver retorna, senão passa nulo
    return isset($_GET[$key]) ? $_GET[$key] : null;
}

// Busca o nome da Page e o Modulo Selecionado
$pg = getKey('pg');

//Inclusão do Header
    include_once 'header.php';
    
// Inclusão do home
// Se a pagina existir inclua, senão traga a home
// echo 'pages/' . $pg . '.php';
if (is_file('pages/' . $pg . '.php')) {
    include 'pages/' . $pg . '.php';
} else {
    include 'pages/home.php';
}

//Inclusão do footer
    include_once 'footer.php';?>