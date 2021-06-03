<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'config/connect.php'; ?>

<?php 

    // Actualizar estado docente

    if(!empty($_POST)) {
        $id = $_POST['id'];
        $estado = $_POST['estado'];

        $sql = "UPDATE docentes SET estado = '$estado' WHERE id = $id";
        mysqli_query($db, $sql);
    }
?>

    <div class="container">
        <h2>Estado Docentes</h2> <hr><br>

        <table id="myTable" class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Docente</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <?php if($_SESSION['usuario']['role'] == 'ESTUDIANTE'): ?>
                        <th>Asignatura</th>
                    <?php endif; ?>
                    <?php if($_SESSION['usuario']['role'] == 'DOCENTE'): ?>
                        <th>Opciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $docentes = conseguirDocentesEstado($db);
                    if($docentes):
                        foreach($docentes as $docente):
                ?>
                    <tr>
                        <td><?php echo $docente['cedula']; ?></td>
                        <td><?php echo $docente['nombre']; ?> <?php echo $docente['apellidos']; ?></td>
                        <td><?php echo $docente['email']; ?></td>
                        <td><?php echo $docente['estado']; ?></td>
                        <?php if($_SESSION['usuario']['role'] == 'ESTUDIANTE'): ?>
                            <td><?php echo $docente['asignatura']; ?></td>
                        <?php endif; ?>
                        <?php if($_SESSION['usuario']['role'] == 'DOCENTE'): ?>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $docente['id']; ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $docente['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Estado</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="estado-docente.php" method="POST" class="form-actualizar">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $docente['id']; ?>">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <select name="estado" class="form-control">
                                                                <option value="DISPONIBLE">DISPONIBLE</option>
                                                                <option value="INACTIVO">INACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php 
                    endforeach;
                    endif;
                ?>
            </tbody>
        </table>

    </div>

<?php require_once 'views/layout/footer.php'; ?>