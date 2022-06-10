<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-noticias.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");

//adicionar noticia

$msg = false;


if (isset($_FILES['arquivo'])) {
    $extensao = strrchr($_FILES['arquivo']['name'], '.');
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "upload/";

    $titulo = $_POST['titulo'];
    $corpo = $_POST['corpo'];

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

    if($extensao!= ""){
        $sql_code = " INSERT INTO `noticias` (`Id`, `titulo` , `corpo` , `foto` , `data` ) VALUES (null, '$titulo','$corpo','$novo_nome',NOW());";
    }else{
        $sql_code = " INSERT INTO `noticias` (`Id`, `titulo` , `corpo` , `foto` , `data` ) VALUES (null, '$titulo','$corpo','',NOW());";
    }
    $mysqli = openDatabaseConnection();
    if ($mysqli->query($sql_code)) {
        $msg = "Noticia adicionada com sucesso!";
    } else {
        $msg = "falha ao adicionar noticia.";
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
                        <h3>Adicionar noticia</h3>
                    </div>
                </div>
                <hr>
                <?php if ($msg != false) echo "<p> $msg </p>"; ?>
                <div id='conteudo-pagina' Class="">
                    <form class="form" action="noticias-novo.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="" name="" value="1">
                        <div class="form-group pt-4">
                            <label for="titulo"><b>Titulo</b></label>
                            <input id="titulo" type="text" name="titulo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="corpo"><b>Corpo</b></label>
                            <input id="corpo" type="text" name="corpo" class="form-control">
                        </div>
                        <div class="form-group pt-2 pb-3">
                            Foto:<input type="file" name="arquivo">
                        </div>
                        <button class="btn btn-sm btn-primary btn-block" type="submit">Salvar</button>
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