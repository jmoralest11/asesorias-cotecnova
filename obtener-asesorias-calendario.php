<?php 

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    $id = $_SESSION['usuario']['id'];

    if($_SESSION['usuario']['role'] == 'ESTUDIANTE'){
        $sql = "SELECT a.id as idAsesoria, es.id, doc.nombre, doc.apellidos, es.nombre, es.apellidos, asignatura, a.title, a.descripcion, a.start, a.end, a.estado, a.color, a.colorText, a.modalidad FROM asesorias as a JOIN docentes as doc ON doc.id=a.iddocente JOIN asignaturas ON asignaturas.id=a.idasignatura JOIN estudiantes_asesorias ON estudiantes_asesorias.idasesoria=a.id JOIN estudiantes as es ON es.id=estudiantes_asesorias.idestudiante WHERE es.id = $id AND a.estado <> 'CANCELADO' AND a.estado <> 'DENEGADA'";
    } else if($_SESSION['usuario']['role'] == 'DOCENTE') {
        $sql = "SELECT a.id as idAsesoria, doc.nombre, doc.apellidos, asignatura, a.title, a.descripcion, a.start, a.end, a.estado, a.color, a.colorText, a.modalidad FROM asesorias as a JOIN docentes as doc ON doc.id=a.iddocente JOIN asignaturas ON asignaturas.id=a.idasignatura WHERE doc.id = $id AND a.estado <> 'CANCELADO' AND a.estado <> 'DENEGADA'";
    }

    $result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_array($result)){
        $id = $row['idAsesoria'];
        $title = $row['title'];
        $descripcion = $row['descripcion'];
        $color = $row['color'];
        $colorText = $row['colorText'];
        $modalidad = $row['modalidad'];
        $start = $row['start'];
        $end = $row['end'];
        $asignatura = $row['asignatura'];
        $docente = $row[2] . " " . $row[3];

        $asesorias[] = array('id'=> $id, 'title'=> $title, 'descripcion'=> $descripcion, 'color' => $color, 'colorText' => $colorText, 'modalidad' => $modalidad, 'start'=> $start,'end'=> $end, 'asignatura' => $asignatura, 'docente' => $docente);
    }

    $json_string = json_encode($asesorias);

    echo $json_string;

    //Se declara que esta es una aplicacion que genera un JSON
    header('Content-type: application/json; charset=utf-8"');
    //Se abre el acceso a las conexiones que requieran de esta aplicacion
    header("Access-Control-Allow-Origin: *");

?>