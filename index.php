<?php
session_start();
ob_start();
require_once 'class/query.class.php';
require_once 'class/ferramenta.class.php';

$Ferramenta = new Ferramenta();
$Query = new Query();

date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

include './Conexao.php';
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
        <script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

    </head>

    <?php
    //VERSÃO EM BANCO DE DADOS//
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
    $Paginaeget = explode('?', $uri);
    $Pagina = explode('/', $Paginaeget[0]);
    $pg = $Pagina[1];

// Inclus�o do home
// Se a pagina existir inclua, sen�o traga a home
// echo 'pages/' . $pg . '.php';
    //Estabelece a conexão com o banco de dados
    $con = conexaoDB();
    //Prepara a seleção da pagina
    $stmt = $con->prepare('select * from site where uri = :nome');
    //Seta o nome da pagina
    $stmt->bindValue(':nome', $pg);
    //Executa a seleção 
    $stmt->execute();


    //Verifica se foi informada alguma uri
    if (isset($_POST['pesquisa'])) {
        include_once 'header.php';
        echo "   <div  style='height: 100px' class='container' ></div><div class='container marketing'><h4>Resultado da pesquisa</h4>";

        $stmt = $con->prepare('select * from site where conteudo like :nome');
        //Seta o nome da pagina
        $stmt->bindValue(':nome', '%' . $_POST['pesquisa'] . '%');

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $Dados = $stmt->fetchall(PDO::FETCH_NAMED);
            foreach ($Dados as $ViewDados) {
                echo "<a href='{$ViewDados['uri']}'>Pagina:{$ViewDados['uri']}</a><br>";
            }
        } else {
            echo "Nenhuma pagina encontrada com o conteúdo informado!";
        }
        //Inclus�o do footer
        include_once 'footer.php';
    } elseif ($pg === "admin") {
        include_once 'header.php';
        echo '<div style="height:50px"></div>';
        include_once 'login.php';
        include_once 'footer.php';
    } elseif ($pg === "manutpaginas") {
        include_once 'header.php';
        echo '<div style="height:100px"></div>';
        include_once 'manutpaginas.php';
        include_once 'footer.php';
    } elseif ($pg === "edicaopaginas") {
        include_once 'header.php';
        echo '<div style="height:100px"></div>';
        include_once 'edicaopaginas.php';
        include_once 'footer.php';
    } elseif ($pg === "fixture") {
        echo '<div style="height:50px"></div>';
        include_once 'header.php';
        echo "<br>INICIANDO<br>";
        echo "removendo tabelas ...<br>";
        $con->query('DROP TABLE IF EXISTS clientes');
        $con->query('DROP TABLE IF EXISTS usuarios');
        echo "<br>removendo tabelas = ok<br>";
        
        echo "criando tabelas ...<br>";
        $con->query('CREATE TABLE clientes (
            id  int(7) NOT NULL AUTO_INCREMENT ,
            name  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
            PRIMARY KEY (id)
            )');
        
        $con->query('CREATE TABLE usuarios (
            id  int(11) NOT NULL AUTO_INCREMENT ,
            usuario  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            email  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            senha  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            PRIMARY KEY (`id`)
            )');
        
        echo "<br>criando tabelas = ok<br>";
        
        echo "Inserindo dados de teste ...<br>";
        for ($index = 1; $index < 10; $index++) {
            $stmt = $con->prepare("INSERT INTO clientes VALUES ('{$index}', 'Clinte {$index}')");
            $stmt->execute();
            $hash = password_hash('123456',PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO `usuarios` VALUES ('{$index}', 'usuario{$index}', 'usuario{$index}@gmail.com', '{$hash}')");
            $stmt->execute();
        }
        echo "<br>Inserindo dados de teste = ok<br>";
        echo "<br>CONCLUÍDO<br>";
        include_once 'footer.php';
    } elseif ($stmt->rowCount() > 0) {
        //Inclus�o do Header

        include_once 'header.php';

        $dados = $stmt->fetch(PDO::FETCH_NAMED);

        echo $dados['conteudo'];
        //Inclus�o do footer
        include_once 'footer.php';
        //Executa caso não tenha sido selecionada nenhuma uri
    } elseif ($pg === "") {
        //Inclus�o do Header
        include_once 'header.php';
        $stmt = $con->prepare('select * from site where uri = "home"');
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_NAMED);
        echo $dados['conteudo'];

        //Inclus�o do footer
        include_once 'footer.php';
        //Executa caso tenha sido informada uma uri inexistente
    } else {
        $stmt = $con->prepare('select * from site where uri = "ERRO_404"');
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_NAMED);
        echo $dados['conteudo'];
        //header("Location:" . $pg . '.php');
        header("HTTP/1.0 404 Not Found");
        die;
    }




//    //VERSÃO EM ARQUIVOS//
////function getKey($key)
////{
////// Verifica se $_GET[$key] est� com algum valor, se estiver retorna, sen�o passa nulo
////    return isset($_GET[$key]) ? $_GET[$key] : null;
////}
////echo $_SERVER['SERVER_NAME'].'<BR>';
////echo $_SERVER['REQUEST_URI'].'<BR>';
////
////echo $_SERVER['SERVER_PROTOCOL'].'<BR>';
////ECHO $_SERVER['HTTP_HOST'].'<br>';
//// Busca o nome da Page e o Modulo Selecionado
//    $uri = $_SERVER['REQUEST_URI'];
//    $Pagina = explode('/', $uri);
//    $pg = $Pagina[1];
//
//
//// Inclus�o do home
//// Se a pagina existir inclua, sen�o traga a home
//// echo 'pages/' . $pg . '.php';
//    if (is_file('pages/' . $pg . '.php')) {
//        //Inclus�o do Header
//        include_once 'header.php';
//        include 'pages/' . $pg . '.php';
//        //Inclus�o do footer
//        include_once 'footer.php';
//    } elseif ($pg === "") {
//        //Inclus�o do Header
//        include_once 'header.php';
//        include 'pages/home.php';
//        //Inclus�o do footer
//        include_once 'footer.php';
//    } else {
//        include 'pages/ERRO_404.php';
//        //header("Location:" . $pg . '.php');
//        header("HTTP/1.0 404 Not Found");
//        die;
//    }
    ?>