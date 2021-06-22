<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'config/connect.php'; ?>

<?php 

    // Actualizar estado asesoria

    if(!empty($_POST)) {
        $id = $_POST['id'];

        if(!empty($_POST['reporte'])){
            $reporte = $_POST['reporte'];

            $sql = "UPDATE asesorias SET reporte = '$reporte' WHERE id = $id";
        } else {
            $estado = $_POST['estado'];
            $comentario = $_POST['comentario'];

            $sql = "UPDATE asesorias SET estado = '$estado', comentario = '$comentario' WHERE id = $id";
        }

        mysqli_query($db, $sql);

        // Insertar en la BD los miembros de la asesoría
        if(isset($_POST['miembros'])){
            foreach($_POST['miembros'] as $miembro){

                // Consulta para comprobar si ya se encuentra relacionado el miembro con la asesoria
                $sql = "SELECT title FROM asesorias JOIN estudiantes_asesorias ON asesorias.id=estudiantes_asesorias.idasesoria JOIN estudiantes ON estudiantes.id=estudiantes_asesorias.idestudiante WHERE estudiantes_asesorias.idestudiante = $miembro AND estudiantes_asesorias.idasesoria = $id"; 
                $result = mysqli_query($db, $sql);

                // Si esta relacionado no hacemos nada
                if($result && mysqli_num_rows($result)){
                    header('Location: estado-asesoria.php');
                } else { // Si no esta relacionado insertamos información en BD
                    $sql = "INSERT INTO estudiantes_asesorias (idestudiante, idasesoria) VALUES ($miembro, $id)";
                    $result = mysqli_query($db, $sql);
                }
            }
        }
    }
?>

    <div class="container">
        <h2>Estado Asesorías</h2> <hr><br>

        <table id="myTable" class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Asesoría</th>
                    <th>Observaciones</th>
                    <th>Modalidad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <?php if($_SESSION['usuario']['role'] == 'ESTUDIANTE'): ?>
                        <th>Comentarios</th>
                        <th>Reporte</th>
                    <?php endif; ?>
                    <?php if($_SESSION['usuario']['role'] == 'DOCENTE'): ?>
                        <th>Opciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $asesorias = conseguirAsesorias($db);
                    if($asesorias):
                        foreach($asesorias as $asesoria):
                            $fecha = date_create($asesoria['start']);
                            $hora_inicio = date_create($asesoria['start']);
                            $hora_fin = date_create($asesoria['end']);
                ?>
                    <tr>
                        <td><?php echo $asesoria['title']; ?></td>
                        <td><?php echo $asesoria['descripcion']; ?></td>
                        <td><?php echo $asesoria['modalidad']; ?></td>
                        <td><?php echo $asesoria['estado']; ?></td>
                        <td><?php echo date_format($fecha, 'Y-m-d'); ?></td>
                        <td><?php echo date_format($hora_inicio, 'H:m'); ?> - <?php echo date_format($hora_fin, 'H:m'); ?></td>
                        <?php if($_SESSION['usuario']['role'] == 'ESTUDIANTE'): ?>
                            <td>
                                <?php if($asesoria['comentario'] != NULL) { ?>
                                    <?php echo $asesoria['comentario']; ?>
                                <?php } else { ?>
                                    No hay comentarios
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($asesoria['reporte'] != NULL) { ?>
                                    <?php echo $asesoria['reporte']; ?>
                                <?php } else { ?>
                                    No hay reportes
                                <?php } ?>
                            </td>
                        <?php endif; ?>
                        <?php if($_SESSION['usuario']['role'] == 'DOCENTE'): ?>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $asesoria['id']; ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?php echo $asesoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Estado</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="estado-asesoria.php" method="POST" class="form-actualizar">
                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $asesoria['id']; ?>">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="#">Cambiar Estado</label>
                                                            <select name="estado" class="form-control">
                                                                <option value="PENDIENTE">PENDIENTE</option>
                                                                <option value="CONFIRMADA">CONFIRMADA</option>
                                                                <option value="DENEGADA">DENEGADA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group col-md-12">
                                                        <div>
                                                            <label for="#">Añadir Miembros</label>
                                                        </div>
                                                        <select name="miembros[]" class="form-control selectpicker" multiple style="width: 450px;">
                                                            <?php 
                                                                $estudiantes = conseguirEstudiantes($db);
                                                                foreach($estudiantes as $estudiante):
                                                            ?>
                                                                <option value="<?php echo $estudiante['id']; ?>"><?php echo $estudiante['email']; ?> - <?php echo $estudiante['nombre']; ?> <?php echo $estudiante['apellidos']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="#">Comentarios</label>
                                                            <textarea name="comentario" class="form-control" cols="30" rows="6"><?php echo $asesoria['comentario']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModale<?php echo $asesoria['id']; ?>">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModale<?php echo $asesoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reportar Asesoría</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="estado-asesoria.php" method="POST" class="form-actualizar">

                                                    <input type="hidden" name="id" class="form-control" value="<?php echo $asesoria['id']; ?>">

                                                    <div class="form-group">
                                                        <textarea name="reporte" class="form-control" rows="15"></textarea>
                                                    </div>
                                                    
                                                    <button type="submit" class="btn btn-success">Reportar</button>
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