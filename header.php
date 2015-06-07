<?php 
if (isset($_GET['pg'])){
    $getMenu=$_GET['pg'];
}else{
    $getMenu='';
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
              <a class="navbar-brand" href="index.php?pg=sobre">Business Facility</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li <?php if ($getMenu==''){echo 'class="active"';}?>><a href="index.php">Home</a></li>
                <li <?php if ($getMenu=='sobre'){echo 'class="active"';}?>><a href="index.php?pg=sobre">Sobre</a></li>
                <li <?php if ($getMenu=='contato'){echo 'class="active"';}?>><a href="index.php?pg=contato">Contato</a></li>                
                <li <?php if ($getMenu=='sysadmin' || $getMenu=='utilities'){echo 'class="active"';}?> class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Produtos <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"><a href="index.php?pg=sysadmin"><h5><b>BF-SysAdmin</b></h5></a></li>
                        <li><a href="index.php?pg=sysadmin#global">Módulo Global</a></li>
                        <li><a href="index.php?pg=sysadmin#financeiro">Módulo Financeiro</a></li>
                        <li><a href="index.php?pg=sysadmin#planos">Planos</a></li>
                        <li class="divider"></li>
                    <li class="dropdown-header"><a href="index.php?pg=utilities"><h5><b>BF-Utilities</b></h5></a></li>
                    <li><a href="index.php?pg=utilities#Utilities">Painel Contábil</a></li>
                    <li><a href="index.php?pg=utilities#Utilities">Painel Financeiro</a></li>
                    <li><a href="index.php?pg=utilities#Utilities">Painel Vendas</a></li>
                    <li><a href="index.php?pg=utilities#Utilities">Painel Fiscal</a></li>
                    <li><a href="index.php?pg=utilities#Utilities">Painel Frotas</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right"> 
                    <button type="button" class="btn btn-default navbar-btn" onclick="location. href= 'http://bfsysadmin.net'">LOGIN <strong>BF-SYSADMIN</strong></button>
                    &nbsp; 
                </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>