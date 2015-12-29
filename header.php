<?php
if (isset($_GET['pg'])) {
    $getMenu = $_GET['pg'];
} else {
    $getMenu = '';
}
?>
<!-- NAVBAR
================================================== -->
<body>
    <div class="navbar-wrapper">
        <div class="container">

            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/sobre">Business Facility</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li <?php
                            if ($getMenu == '') {
                                echo 'class="active"';
                            }
                            ?>><a href="/">Home</a></li>
                            <li <?php
                            if ($getMenu == 'sobre') {
                                echo 'class="active"';
                            }
                            ?>><a href="/sobre">Sobre</a></li>
                            <li <?php
                            if ($getMenu == 'contato') {
                                echo 'class="active"';
                            }
                            ?>><a href="/contato">Contato</a></li>                
                            <li <?php
                            if ($getMenu == 'sysadmin' || $getMenu == 'utilities') {
                                echo 'class="active"';
                            }
                            ?> class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Produtos <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-header"><a href="/sysadmin"><h5><b>BF-SysAdmin</b></h5></a></li>
                                    <li><a href="/sysadmin">M�dulo Global</a></li>
                                    <li><a href="/sysadmin">M�dulo Financeiro</a></li>
                                    <li><a href="/sysadmin">Planos</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><a href="/utilities"><h5><b>BF-Utilities</b></h5></a></li>
                                    <li><a href="/utilities">Painel Cont�bil</a></li>
                                    <li><a href="/utilities">Painel Financeiro</a></li>
                                    <li><a href="/utilities">Painel Vendas</a></li>
                                    <li><a href="/utilities">Painel Fiscal</a></li>
                                    <li><a href="/utilities">Painel Frotas</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form method="post" name="formulario">
                            <ul class="nav navbar-nav navbar-right"> 
                                <button type="submit" class="btn btn-default navbar-btn">Pesquisar</button>
                                &nbsp; 
                            </ul>
                            <ul class="nav navbar-nav navbar-right"> 
                                <input class="form-control" name="pesquisa"></input>
                            </ul>
                        </form>

                    </div>
                </div>
            </nav>

        </div>
    </div>