<?php

require_once './header.php';

require_once './Usuario.php';

//Cria uma instancia de clientes
$Usuario = new Usuario();
if (isset($_POST['usuario'])) {
    if (!$Usuario->logar($_POST['usuario'], $_POST['senha'])) {
        $msg = "Não foi possível efetuar o login, tente novamente.";
    } else {
       $_SESSION['logado']=1;
       header('location:manutpaginas');
    }
}
?>
<div class="container">
    <h1>Login</h1>
    <div CLASS="row">
        <form method="post">
            <div class="col-lg-12">
                <hr class="divider">
            </div>
            <div class="col-lg-12">
                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
            </div>
            <div class="col-lg-offset-5 col-lg-2">
                <label class="control-label">Usuário</label>
                <input class="form-control" name="usuario" />
            </div>
            <div class="col-lg-offset-5 col-lg-2">
                <label class="control-label">senha</label>
                <input type="password" class="form-control" name="senha" />
            </div>

            <div class="col-lg-12">
                <hr class="divider">
            </div>
            <div class="col-lg-offset-5 col-lg-2">
                <button type="submit"   class="btn btn-info">Logar</button>
            </div>
        </form> 
    </div>

</div>
<?php require_once './footer.php'; ?>