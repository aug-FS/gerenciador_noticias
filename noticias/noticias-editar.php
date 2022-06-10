<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-noticias.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");

//editar noticia

$msg = false;


if (isset($_POST['acao1'])) {

    $extensao = strrchr($_FILES['arquivo']['name'], '.');
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "upload/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

    if ($extensao == "") {
        $novo_nome = "";
    } else {
        if ($_POST['noticia-foto']!= "") {
            unlink("upload/" . $_POST['noticia-foto']);
        }
    }

    $edit = editar_noticia($_POST['noticia-id'], $novo_nome, $_POST['noticia-corpo'], $_POST['noticia-titulo']);


    if ($edit == true) {
        $msg = "Noticia editada com sucesso";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Noticias</title>
    <link rel="icon" href="/sx/common/assets/favicon.png">
</head>

<body>
    <main>
        <div class="wrapper">
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <div class="pt-4 pl-4 row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='/noticias/noticias'">
                            <- </button>
                    </div>
                    <div class="col">
                        <h3>Editar noticia</h3>
                    </div>
                </div>
                <hr>
                <?php if ($msg != false) echo "<p> $msg </p>"; ?>
                <div id='conteudo-pagina' Class="">
                    <form class="form" action="noticias-editar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="acao13" name="acao1" value="editar">
                        <input type="hidden" id="acao13" name="noticia-id" value="<?= $_POST['noticia-id']; ?>">
                        <input type="hidden" id="acao13" name="noticia-foto" value="<?= $_POST['noticia-foto']; ?>">
                        <div class="form-group pt-4">
                            <label for="titulo"><b>Titulo</b></label>
                            <input id="titulo" type="text" name="noticia-titulo" class="form-control" value="<?= $_POST['noticia-titulo'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="corpo"><b>Corpo</b></label>
                            <input id="corpo" type="text" name="noticia-corpo" class="form-control" value="<?= $_POST['noticia-corpo'] ?>">
                        </div>
                        <div class="form-group pt-2 pb-3">
                            <?php if ($_POST['noticia-foto'] != "") { ?>
                                <img widht="600px" height="600px" src="upload/<?= $_POST['noticia-foto'] ?>"><br>
                            <?php } ?>
                            Foto:<input type="file" name="arquivo">
                        </div>
                        <button class="btn btn-sm btn-primary btn-block" type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
    <script src="/sx/bootstrap/4.4.1/js/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/sx/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>