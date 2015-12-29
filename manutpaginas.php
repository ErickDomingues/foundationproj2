<?php
if (!(isset($_SESSION['logado']) && $_SESSION['logado']===1)){
    header('location:admin');
}

        $stmt = $con->prepare('select * from site ');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $Dados = $stmt->fetchall(PDO::FETCH_NAMED);
            foreach ($Dados as $ViewDados) {
                echo "<a href='edicaopaginas?id={$ViewDados['id']}'>Pagina:{$ViewDados['uri']}</a><br>";
            }
        }