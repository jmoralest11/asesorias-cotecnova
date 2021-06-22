<?php

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    if(isset($_POST)) {
        // Recibir y validar con Mysql campos POST
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $titulo = isset($_POST['title']) ? strtoupper(mysqli_real_escape_string($db, $_POST['title'])) : false;
        $color = isset($_POST['color']) ? strtoupper(mysqli_real_escape_string($db, $_POST['color'])) : false;
        $fecha = isset($_POST['fecha']) ? strtoupper(mysqli_real_escape_string($db, $_POST['fecha'])) : false;
        $horaInicio = isset($_POST['horaInicio']) ? strtoupper(mysqli_real_escape_string($db, $_POST['horaInicio'])) : false;
        $horaFin = isset($_POST['horaFin']) ? strtoupper(mysqli_real_escape_string($db, $_POST['horaFin'])) : false;
        $modalidad = isset($_POST['modalidad']) ? strtoupper(mysqli_real_escape_string($db, $_POST['modalidad'])) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;

        // Formatear fechas y horas a formato Full Calendar
        $dateI = date_create($horaInicio);
        $dateInicial = date_format($dateI,"$fecha H:i:s");
        $dateF = date_create($horaFin);
        $dateFinal = date_format($dateF,"$fecha H:i:s");

        // Actualizar en BD los datos de la asesoria
        $sql = "UPDATE asesorias SET title = '$titulo', color = '$color', start = '$dateInicial', end = '$dateFinal', modalidad = '$modalidad', descripcion = '$descripcion' WHERE id = $id";
        $result = mysqli_query($db, $sql);

        header('Location: gestionar-asesorias.php');
    }
?>