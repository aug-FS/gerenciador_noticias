<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/functions/crud-noticias.php");

$noticias = get_noticias();

$msg = false;

if (@$_POST['acao1'] == "deletar") {
    $delet = deletar_noticia_id($_POST['noticia-id']);
    if (isset($_POST['noticia-foto'])) {
        unlink("upload/" . $_POST['noticia-foto']);
    }
    if ($delet == true) {
        $msg = "Noticia deletada com sucesso";
    }
}
if (@$_POST['acao2'] == "gerar") {
    //Noticias com foto

    $xml = new DOMDocument('1.0', "iso-8859-1");
    $xml->formatOutput = true;

    $ft = 0;
    $tam = $noticias['size-noticias'];
    $tam--;
    while ($tam != 0) {

        if ($noticias['noticias'][$tam]["foto"] != "" && $ft != 3) {
            $news = $xml->createElement("noticias");
            $news->setAttribute("criado", $noticias['noticias'][$tam]["data"]);
            $xml->appendChild($news);
            $noticia = $xml->createElement("noticia");
            $noticia->setAttribute("titulo", $noticias['noticias'][$tam]["titulo"]);
            $noticia->setAttribute("texto", $noticias['noticias'][$tam]["corpo"]);
            $noticia->setAttribute("imagem", "upload/" . $noticias['noticias'][$tam]["foto"]);
            $noticia->setAttribute("criado", $noticias['noticias'][$tam]["data"]);
            $news->appendChild($noticia);
            $ft++;
        }
        $tam--;
    }

    $xml->save("noticias_foto.xml");

    //Noticias sem foto

    $xml = new DOMDocument('1.0', "iso-8859-1");
    $xml->formatOutput = true;

    $ft = 0;
    $tam = $noticias['size-noticias'];
    $tam--;
    while ($tam != 0) {

        if ($noticias['noticias'][$tam]["foto"] == "" && $ft != 3) {
            $news = $xml->createElement("noticias");
            $news->setAttribute("criado", $noticias['noticias'][$tam]["data"]);
            $xml->appendChild($news);
            $noticia = $xml->createElement("noticia");
            $noticia->setAttribute("titulo", $noticias['noticias'][$tam]["titulo"]);
            $noticia->setAttribute("texto", $noticias['noticias'][$tam]["corpo"]);
            $noticia->setAttribute("imagem", "upload/" . $noticias['noticias'][$tam]["foto"]);
            $noticia->setAttribute("criado", $noticias['noticias'][$tam]["data"]);
            $news->appendChild($noticia);
            $ft++;
        }
        $tam--;
    }

    $xml->save("noticias_sem_foto.xml");

    $msg = "xml gerado";
}
if (@$_POST['acao3'] == "gerar2") {
    //Noticias com foto
    $ft = 0;
    $tam = $noticias['size-noticias'];
    $tam--;
    $noticia1 = array();
    $i2 = 0;
    while ($tam != 0) {
        if ($noticias['noticias'][$tam]["foto"] != "" && $ft != 3) {
            $noticia1[$i2] = array('noticia', $noticias['noticias'][$tam]);

            $ft++;
            $i2++;
        }
        $tam--;
    }
    $noticias2 = array('noticias', $noticia1);

    $arquivo = 'noticias_foto.json';
    $json = json_encode($noticias2);
    $file = fopen($arquivo, 'w');

    fwrite($file, $json);
    fclose($file);

    //Noticias sem foto
    $ft = 0;
    $tam = $noticias['size-noticias'];
    $tam--;
    $noticia1 = array();
    $i2 = 0;
    while ($tam != 0) {
        if ($noticias['noticias'][$tam]["foto"] == "" && $ft != 3) {
            $noticia1[$i2] = array('noticia', $noticias['noticias'][$tam]);

            $ft++;
            $i2++;
        }
        $tam--;
    }
    $noticias2 = array('noticias', $noticia1);

    $arquivo = 'noticias_sem_foto.json';
    $json = json_encode($noticias2);
    $file = fopen($arquivo, 'w');

    fwrite($file, $json);
    fclose($file);

    $msg = "json gerado";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/sx/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Noticias</title>
</head>

<body>
    <main>
        <div class="wrapper">
            <div id="content" class="" style="width: 100%; min-width: 320px;">
                <div class="pt-4 pl-4 row">
                    <div class="col">
                        <h3>Noticias</h3>
                    </div>
                    <div class="col-right col-sm-4 col-md-3 col-lg-2 pb-2 pt-1">
                        <form class="form" action="" method="post">
                            <input type="hidden" id="acao1" name="acao3" value="gerar2">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Gerar json</button>
                        </form>
                    </div>
                    <div class="col-right col-sm-4 col-md-3 col-lg-2 pb-2 pt-1">
                        <form class="form" action="" method="post">
                            <input type="hidden" id="acao1" name="acao2" value="gerar">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Gerar xml</button>
                        </form>
                    </div>
                    <div class="col-right col-sm-4 col-md-3 col-lg-2 pb-2 pt-1">
                        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="window.location.href='/noticias/noticias-novo'">+ Adicionar</button>
                    </div>
                </div>
                <hr>
                <?php if ($msg != false) echo "<p> $msg </p>"; ?>
                <div id='conteudo-pagina' Class="">
                    <?php
                    $i = 0;
                    while ($i < $noticias['size-noticias']) {
                        $nome = $noticias['noticias'][$i]["foto"];
                        echo "<div class='row pl-4'>";
                        echo "<div class='col-6'>";
                        echo '<h1>' . $noticias['noticias'][$i]["titulo"] . '</h1>' . '<br>';
                        echo "</div>";
                    ?>
                        <div class="col-2">
                            <form class="form" action="/noticias/noticias-editar" method="post">
                                <input type="hidden" id="acao13" name="noticia-id" value="<?= $noticias['noticias'][$i]["id"]; ?>">
                                <input type="hidden" id="acao13" name="noticia-titulo" value="<?= $noticias['noticias'][$i]["titulo"]; ?>">
                                <input type="hidden" id="acao13" name="noticia-corpo" value="<?= $noticias['noticias'][$i]["corpo"]; ?>">
                                <input type="hidden" id="acao13" name="noticia-foto" value="<?= $noticias['noticias'][$i]["foto"]; ?>">
                                <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-editar.png" alt="Submit" width="22px">
                            </form>
                        </div>
                        <div class="col-2">
                            <form class="form" action="" method="post">
                                <input type="hidden" id="acao1" name="acao1" value="deletar">
                                <input type="hidden" id="acao13" name="noticia-foto" value="<?= $noticias['noticias'][$i]["foto"]; ?>">
                                <input type="hidden" id="acao13" name="noticia-id" value="<?= $noticias['noticias'][$i]["id"]; ?>">
                                <input calss='pt-1 mr-1' type="image" src="/sx/common/assets/icon-trash.png" alt="Submit" width="24px">
                            </form>
                        </div>
                        <?php
                        echo "</div>";
                        echo "<div class='row pl-4'>";
                        echo $noticias['noticias'][$i]["corpo"] . '<br>';
                        echo "</div>";
                        if ($nome != "") { ?>
                            <div class='row pl-4'>
                                <img widht="600px" height="600px" src="upload/<?= $nome ?>"><br>
                            </div>
                    <?php }
                        echo "Data de publicacao: " . $noticias['noticias'][$i]["data"] . '<br>';
                        $i++;
                    }

                    ?>

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