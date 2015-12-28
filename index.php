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
        <meta name="description" content=" Sistemas de gest�o, buscando maior controle agilidade e lucratividade.">
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
//function getKey($key)
//{
//// Verifica se $_GET[$key] est� com algum valor, se estiver retorna, sen�o passa nulo
//    return isset($_GET[$key]) ? $_GET[$key] : null;
//}
//echo $_SERVER['SERVER_NAME'].'<BR>';
//echo $_SERVER['REQUEST_URI'].'<BR>';
//
//echo $_SERVER['SERVER_PROTOCOL'].'<BR>';
//ECHO $_SERVER['HTTP_HOST'].'<br>';
// Busca o nome da Page e o Modulo Selecionado
    $uri = $_SERVER['REQUEST_URI'];
    $Pagina = explode('/', $uri);
    $pg = $Pagina[1];


// Inclus�o do home
// Se a pagina existir inclua, sen�o traga a home
// echo 'pages/' . $pg . '.php';
    if (is_file('pages/' . $pg . '.php')) {
        //Inclus�o do Header
        include_once 'header.php';
        include 'pages/' . $pg . '.php';
        //Inclus�o do footer
        include_once 'footer.php';
    }elseif($pg===""){
                //Inclus�o do Header
        include_once 'header.php';
        include 'pages/home.php';
        //Inclus�o do footer
        include_once 'footer.php';
    } else {
        include 'pages/ERRO_404.php';
        //header("Location:" . $pg . '.php');
        header("HTTP/1.0 404 Not Found");
die;
    }
    ?>

    <?php
    ?>