<?php

    function conseguirAsignaturas($db){
        $sql = "SELECT * FROM asignaturas";

		$asignaturas = mysqli_query($db, $sql);

		if($asignaturas && mysqli_num_rows($asignaturas) >= 1){
			return $asignaturas;
		}

        return false;
    }

    function conseguirDocentes($db){
        $sql = "SELECT * FROM docentes WHERE estado <> 'INACTIVO'";

		$docentes = mysqli_query($db, $sql);

		if($docentes && mysqli_num_rows($docentes) >= 1){
			return $docentes;
		}

        return false;
    }

    function conseguirEstudiantes($db){
        // Id del usuario logueado
        $id = $_SESSION['usuario']['id'];

        $sql = "SELECT id, nombre, apellidos, email FROM estudiantes WHERE id <> $id";

		$estudiantes = mysqli_query($db, $sql);

		if($estudiantes && mysqli_num_rows($estudiantes) >= 1){
			return $estudiantes;
		}

        return false;
    }

    function conseguirAsesorias($db){
        // Id del usuario logueado
        $id = $_SESSION['usuario']['id'];

        if ($_SESSION['usuario']['role'] == 'ESTUDIANTE'){
            $sql = "SELECT asesorias.id, title, descripcion, estado, fecha, start, end, modalidad, comentario, reporte FROM asesorias JOIN estudiantes_asesorias ON asesorias.id=estudiantes_asesorias.idasesoria JOIN estudiantes ON estudiantes.id=estudiantes_asesorias.idestudiante WHERE estudiantes.id = $id AND asesorias.estado <> 'CANCELADO';";
        } else if($_SESSION['usuario']['role'] == 'DOCENTE') {
            $sql = "SELECT a.id, doc.nombre, doc.apellidos, asignatura, a.title, a.descripcion, a.start, a.end, a.estado, a.color, a.colorText, a.modalidad, a.comentario, a.reporte FROM asesorias as a JOIN docentes as doc ON doc.id=a.iddocente JOIN asignaturas ON asignaturas.id=a.idasignatura WHERE doc.id = $id AND a.estado <> 'CANCELADO'";
        }

		$asesorias = mysqli_query($db, $sql);

		if($asesorias && mysqli_num_rows($asesorias) >= 1){
			return $asesorias;
		}

        return false;
    }

    function conseguirDocentesEstado($db){
        if ($_SESSION['usuario']['role'] == 'DOCENTE'){
            $id = $_SESSION['usuario']['id'];
            $sql = "SELECT id, cedula, nombre, apellidos, email, estado FROM docentes iddocente WHERE id = $id";
        } else {
            $sql = "SELECT cedula, nombre, apellidos, email, estado, asignatura FROM docentes JOIN asignaturas ON docentes.id=asignaturas.iddocente";
        }

        $docentes = mysqli_query($db, $sql);

        if($docentes && mysqli_num_rows($docentes) >= 1){
			return $docentes;
		}

        return false;
    }

    function conseguirRepositorios($db){
        $id = $_SESSION['usuario']['id'];

        $sql = "SELECT repos.id, title, link, notas, repos.fecha FROM repositorios as repos JOIN asesorias as ases ON repos.idasesoria=ases.id WHERE repos.idCreador = $id";
        $repositorios = mysqli_query($db, $sql);

        if($repositorios && mysqli_num_rows($repositorios) >= 1){
			return $repositorios;
		}

        return false;
    }

?>