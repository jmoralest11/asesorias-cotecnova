<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'config/connect.php'; ?>

<div class="container">
    <h2 class="d-inline mr-2">Mis Repositorios</h2>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Repositorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body text-left">
                    <form action="guardar-repositorio.php" method="POST">
                        <div class="form-group">
                            <label for="#">Asesoría <strong style="color: red;">*</strong></label>
                            <select name="idasesoria" class="form-control">
                                <?php
                                $asesorias = conseguirAsesorias($db);
                                foreach ($asesorias as $asesoria) :
                                    $fecha = date_create($asesoria['start']);
                                    if ($asesoria['modalidad'] == 'VIRTUAL') :
                                ?>
                                        <option value="<?php echo $asesoria['id'] ?>"><?php echo $asesoria['title'] ?> - <?php echo date_format($fecha, 'Y-m-d'); ?></option>
                                <?php endif;
                                endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="#">Link Sesión <strong style="color: red;">*</strong></label>
                            <textarea class="form-control" name="link" rows="2" placeholder="Ingresa Link Sesión..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="#">Notas Sesión</label>
                            <textarea class="form-control" name="notas" rows="4" placeholder="Ingresa Notas Sesión..."></textarea>
                        </div>
                        <input type="hidden" name="idCreador" value="<?php echo $_SESSION['usuario']['id']; ?>">
                        <hr>
                        <button type="submit" class="btn btn-success">Crear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>
    <hr> <br>

    <table id="myTable" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>Asesoría</th>
                <th>Link</th>
                <th>Notas</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $repositorios = conseguirRepositorios($db);
            if ($repositorios) :
                foreach ($repositorios as $repositorio) :
                    $fecha = date_create($repositorio['fecha']);
            ?>
                    <tr>
                        <td><?php echo $repositorio['title']; ?></td>
                        <td><a target="_blank" href="<?php echo $repositorio['link']; ?>"><?php echo $repositorio['link']; ?></a></td>
                        <td><?php echo $repositorio['notas']; ?></td>
                        <td><?php echo date_format($fecha, 'Y-m-d') ?></td>
                        <td>
                            <form action="borrar-repositorio.php" method="POST" class="d-inline form-eliminar">
                                <input type="hidden" name="id" value="<?php echo $repositorio['id']; ?>">
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