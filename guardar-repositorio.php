<?php

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    if(isset($_POST)) {

        // Recibir y validar con Mysql campos POST
        $idasesoria = isset($_POST['idasesoria']) ? $_POST['idasesoria'] : false;
        $link = isset($_POST['link']) ? mysqli_real_escape_string($db, $_POST['link']) : false;
        $notas = isset($_POST['notas']) ? mysqli_real_escape_string($db, $_POST['notas']) : false;
        $idCreador = isset($_POST['idCreador']) ? $_POST['idCreador'] : false;

        // Insertar en BD los datos de la asesoria
        $sql = "INSERT INTO repositorios (idasesoria, link, notas, idCreador, fecha) VALUES ($idasesoria, '$link', '$notas', $idCreador, NOW())";
        $result = mysqli_query($db, $sql);

        header('Location: repositorios.php');
    }

?>