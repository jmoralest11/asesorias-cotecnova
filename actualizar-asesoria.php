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

        // Insertar en la BD los miembros de la asesoría
        if(isset($_POST['miembros'])){
            foreach($_POST['miembros'] as $miembro){

                // Consulta para comprobar si ya se encuentra relacionado el miembro con la asesoria
                $sql = "SELECT title FROM asesorias JOIN estudiantes_asesorias ON asesorias.id=estudiantes_asesorias.idasesoria JOIN estudiantes ON estudiantes.id=estudiantes_asesorias.idestudiante WHERE estudiantes.id = $miembro";
                $result = mysqli_query($db, $sql);
                
                // Si esta relacionado no hacemos nada
                if($result && mysqli_num_rows($result)){
                    header('Location: gestionar-asesorias.php');
                } else { // Si no esta relacionado insertamos información en BD
                    $sql = "INSERT INTO estudiantes_asesorias (idestudiante, idasesoria) VALUES ($miembro, $id)";
                    $result = mysqli_query($db, $sql);
                }
            }
        }

        header('Location: gestionar-asesorias.php');
    }
?>