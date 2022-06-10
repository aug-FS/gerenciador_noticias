<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/sx/common/database/db-config.php");
//CRUD DE NOTICIAS

function get_noticias()
{
    $sql = "
        SELECT * FROM `noticias`;
        ";
    $con = openDatabaseConnection();
    $query = mysqli_query($con, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        $noticias[$i] = array(
            "id" => $row['Id'],
            "titulo" => $row['titulo'],
            "corpo" => $row['corpo'],
            "foto" => $row['foto'],
            "data" => $row['data']

        );
        $i++;
    }
    if (mysqli_num_rows($query)) {
        //existem avaliacoes cadastrados
        return array(
            "resposta" => true,
            "resposta_message" => "lista de noticias.",
            "noticias" => $noticias,
            "size-noticias" => sizeof($noticias),
        );
    } else {
        //não existem avaliacoes
        return array(
            "resposta" => false,
            "resposta_message" => "não existem noticias cadastradas.",
        );
    }
}
function editar_noticia($id, $foto, $corpo, $titulo)
{
    if ($foto != "") {
        $sql = "
         UPDATE `noticias` SET 
         `foto` = '$foto' , `corpo` = '$corpo' ,`titulo` = '$titulo' 
         WHERE `Id` = $id;
         ";
    } else {
        $sql = "
        UPDATE `noticias` SET 
        `corpo` = '$corpo' ,`titulo` = '$titulo' 
        WHERE `Id` = $id;
        ";
    }
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        return true;
    } else {
        return false;
    }
}
function deletar_noticia_id($id)
{
    $sql = "
        DELETE FROM `noticias` WHERE `Id` = $id;
        ";
    $con = openDatabaseConnection();
    if (mysqli_query($con, $sql) === true) {
        return true;
    } else {
        return false;
    }
}
