<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'config/connect.php'; ?>

<div class="container">
    <h2>Gestionar Asesorías</h2>
    <hr><br>

    <table id="myTable" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>Título</th>
                <th>Observaciones</th>
                <th>Modalidad</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Creación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $asesorias = conseguirAsesorias($db);
            if ($asesorias) :
                foreach ($asesorias as $asesoria) :
                    $fechaCreacion = date_create($asesoria['fecha']);
                    $fecha = date_create($asesoria['start']);
                    $hora_inicio = date_create($asesoria['start']);
                    $hora_fin = date_create($asesoria['end']);
            ?>
                    <tr>
                        <td><?php echo $asesoria['title']; ?></td>
                        <td><?php echo $asesoria['descripcion']; ?></td>
                        <td><?php echo $asesoria['modalidad']; ?></td>
                        <td><?php echo date_format($fecha, 'Y-m-d'); ?></td>
                        <td><?php echo date_format($hora_inicio, 'H:m'); ?> - <?php echo date_format($hora_fin, 'H:m'); ?></td>
                        <td><?php echo date_format($fechaCreacion, 'Y-m-d'); ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $asesoria['id']; ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $asesoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Asesoría</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form action="actualizar-asesoria.php" method="POST" class="form-actualizar">
                                                <input type="hidden" name="id" class="form-control" value="<?php echo $asesoria['id']; ?>">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="#">Título <strong style="color: red;">*</strong></label>
                                                        <input type="text" class="form-control" name="title" placeholder="Nombre Solicitud..." value="<?php echo $asesoria['title']; ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="#">Color Fondo<strong style="color: red;">*</strong></label>
                                                        <input type="color" class="form-control" name="color" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="#">Fecha <strong style="color: red;">*</strong></label>
                                                        <input type="date" class="form-control" name="fecha" value="<?php echo date_format($fecha, 'Y-m-d'); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="#">Hora Inicio <strong style="color: red;">*</strong></label>
                                                        <input type="text" class="form-control clockpicker" name="horaInicio" value="<?php echo date_format($hora_inicio, 'H:m'); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="#">Hora Fin <strong style="color: red;">*</strong></label>
                                                        <input type="text" class="form-control clockpicker" name="horaFin" value="<?php echo date_format($hora_fin, 'H:m'); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#">Modalidad <strong style="color: red;">*</strong></label>
                                                    <select name="modalidad" class="form-control" required>
                                                        <option value="PRESENCIAL">PRESENCIAL</option>
                                                        <option value="VIRTUAL">VIRTUAL</option>
                                                    </select>
                                                </div>
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
                                                <div class="form-group">
                                                    <label for="#">Observaciones <strong style="color: red;">*</strong></label>
                                                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa sus Inquietudes..."><?php echo $asesoria['descripcion']; ?></textarea>
                                                </div>
                                                <hr>
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="borrar-asesoria.php" method="POST" class="d-inline form-eliminar">
                                <input type="hidden" name="id" value="<?php echo $asesoria['id']; ?>">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>

</div>

<?php require_once 'views/layout/footer.php'; ?>