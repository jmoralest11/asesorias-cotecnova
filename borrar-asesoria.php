<?php 

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE asesorias SET estado = 'CANCELADO' WHERE id = $id";
        $result = mysqli_query($db, $sql);
    }

    header('Location: gestionar-asesorias.php');

?>