<?php
if (!(isset($_SESSION['logado']) && $_SESSION['logado']===1)){
    header('location:admin');
}
//        include './fckeditor/fckeditor.php';
//        
//        $FCKEditor = new FCKeditor('editor');
//        
//        $FCKEditor->BasePath='fckeditor/';
//        
//        $FCKEditor->Height=500;

if(isset($_POST['editor1'])){
    $stmt = $con->prepare('update site set conteudo = :conteudo where id = :id');
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->bindValue(':conteudo', $_POST['editor1']);
    $stmt->execute();
}

$stmt = $con->prepare('select * from site where id = :id');
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $Dados = $stmt->fetchall(PDO::FETCH_NAMED);
    foreach ($Dados as $ViewDados)
        ;

//                $FCKEditor->Value = $ViewDados['conteudo'];
//                $FCKEditor->Create();
    $conteudo = $ViewDados['conteudo'];
    $pagina=$ViewDados['uri'];
} else {
    $conteudo = "Não foi retornado nenhum dado";
    $pagina="Nenhuma pagina encontrada";
}
?>
<form method="post">
    <p>
        <?php echo 'Pagina: '.$pagina; ?><br />
        <input name="id" value="<?php echo $_GET['id']; ?>" STYLE="display: none"></input>
        <textarea id="editor1" name="editor1" style="height: 500px"><?php echo $conteudo; ?></textarea>
        <script type="text/javascript" >
            CKEDITOR.replace('editor1');
        </script>
    </p>
    <p>
        <input type="submit" />
    </p>
</form>

<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>

<script type="text/javascript">
    window.onload = function ()
    {
        CKEDITOR.replace('editor1');
    };
</script>