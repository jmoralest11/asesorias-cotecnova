<?php

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    // Id del usuario logueado
    $id = $_SESSION['usuario']['id'];

    if(isset($_POST)) {

        // Recibir y validar con Mysql campos POST
        $titulo = isset($_POST['title']) ? strtoupper(mysqli_real_escape_string($db, $_POST['title'])) : false;
        $color = isset($_POST['color']) ? strtoupper(mysqli_real_escape_string($db, $_POST['color'])) : false;
        $fecha = isset($_POST['fecha']) ? strtoupper(mysqli_real_escape_string($db, $_POST['fecha'])) : false;
        $horaInicio = isset($_POST['horaInicio']) ? strtoupper(mysqli_real_escape_string($db, $_POST['horaInicio'])) : false;
        $horaFin = isset($_POST['horaFin']) ? strtoupper(mysqli_real_escape_string($db, $_POST['horaFin'])) : false;
        $modalidad = isset($_POST['modalidad']) ? strtoupper(mysqli_real_escape_string($db, $_POST['modalidad'])) : false;
        $asignatura = isset($_POST['asignatura']) ? strtoupper(mysqli_real_escape_string($db, $_POST['asignatura'])) : false;
        $docente = isset($_POST['docente']) ? strtoupper(mysqli_real_escape_string($db, $_POST['docente'])) : false;
        $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;

        // Formatear fechas y horas a formato Full Calendar
        $dateI = date_create($horaInicio);
        $dateInicial = date_format($dateI,"$fecha H:i:s");
        $dateF = date_create($horaFin);
        $dateFinal = date_format($dateF,"$fecha H:i:s");

        // Insertar en BD los datos de la asesoria
        $sql = "INSERT INTO asesorias (iddocente, idasignatura, title, descripcion, color, colorText, start, end, estado, modalidad, comentario, fecha) VALUES ($docente, $asignatura, '$titulo', '$descripcion', '$color', '#FFFFFF' , '$dateInicial', '$dateFinal', 'PENDIENTE', '$modalidad', NULL, NULL, NOW())";
        $result = mysqli_query($db, $sql);

        $sql = "SELECT * FROM asesorias ORDER BY id DESC LIMIT 1";
        $asesoria = mysqli_query($db, $sql);
        $result = mysqli_fetch_assoc($asesoria);

        // Id de la asesoria recién registrada
        $id_asesoria = $result['id'];

        // Insertar en BD la relación entre estudiante y asesoria 
        $sql = "INSERT INTO estudiantes_asesorias (idestudiante, idasesoria) VALUES ($id, $id_asesoria)";
        $result = mysqli_query($db, $sql);

        header('Location: calendario.php');

    }

?>