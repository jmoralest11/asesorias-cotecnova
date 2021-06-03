<?php 

    require_once 'includes/redireccion.php'; 

    require_once 'config/connect.php';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM repositorios WHERE id = $id";
        $result = mysqli_query($db, $sql);
    }

    header('Location: repositorios.php');

?>