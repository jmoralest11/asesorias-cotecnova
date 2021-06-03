<?php

    require_once 'config/connect.php';

	// Verificar que existe el name tipo
	$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : false;

    if(isset($_POST)) {

        // Recoger datos del formulario
        $identificacion = $_POST['identificacion'];
		$password = $_POST['pass'];

        // Consulta para comprobar las credenciales del usuario
		if($tipo == 'ESTUDIANTE') {
			$sql = "SELECT * FROM estudiantes WHERE cedula=$identificacion LIMIT 1";
		} else if($tipo == 'DOCENTE') {
			$sql = "SELECT * FROM docentes WHERE cedula=$identificacion LIMIT 1";
		}
		
		$login = mysqli_query($db, $sql);

        if($login && mysqli_num_rows($login) == 1){
			$usuario = mysqli_fetch_assoc($login);

			// Comprobar contraseña
			if($password == $usuario['cedula']) {
                // Utilizar un sesión para guardar los datos del usuario logueado
				$_SESSION['usuario'] = $usuario;

				if($tipo == 'ESTUDIANTE') {
					$_SESSION['usuario']['role'] = 'ESTUDIANTE';
				} else if($tipo == 'DOCENTE') {
					$_SESSION['usuario']['role'] = 'DOCENTE';
				}
				
                // Redirigir al calendario.php
	            header('Location: calendario.php');
            } else {
				// Si algo falla enviar una sesión con el fallo
				$_SESSION['error_login'] = "Login incorrecto!!";
                header('Location: index.php');
			}
		}else{
			$_SESSION['error_login'] = "Login incorrecto!!";
            header('Location: index.php');
		}

    }

?>