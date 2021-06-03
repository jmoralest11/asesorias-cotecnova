<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'config/connect.php'; ?>

    <div class="container p-3">

        <h2>Solicitud Asesoría</h2> <hr> <br>

        <form id="myForm" action="guardar-asesoria.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="#">Título <strong style="color: red;">*</strong></label>
                    <input type="text" class="form-control" name="title" placeholder="Nombre Solicitud..." required>
                </div>
                <div class="form-group col-md-6">
                    <label for="#">Color Fondo<strong style="color: red;">*</strong></label>
                    <input type="color" class="form-control" name="color" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="#">Fecha <strong style="color: red;">*</strong></label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="#">Hora Inicio <strong style="color: red;">*</strong></label>
                    <div class="col input-group clockpicker">
                        <input type="text" class="form-control" value="00:00" name="horaInicio" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="#">Hora Fin <strong style="color: red;">*</strong></label>
                    <div class="input-group clockpicker">
                        <input type="text" class="form-control" value="00:00" name="horaFin" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="#">Añadir Miembros <strong style="color: red;">*</strong></label>
                <select name="miembros[]" class="form-control selectpicker" multiple>
                    <?php 
                        $estudiantes = conseguirEstudiantes($db);
                        foreach($estudiantes as $estudiante):
                    ?>
                        <option value="<?php echo $estudiante['id']; ?>"><?php echo $estudiante['email']; ?> - <?php echo $estudiante['nombre']; ?> <?php echo $estudiante['apellidos']; ?></option>
                    <?php 
                        endforeach; 
                    ?>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="#">Modalidad <strong style="color: red;">*</strong></label>
                    <select name="modalidad" class="form-control" required>
                        <option value="PRESENCIAL">PRESENCIAL</option>
                        <option value="VIRTUAL">VIRTUAL</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="#">Asignatura <strong style="color: red;">*</strong></label>
                    <select name="asignatura" class="form-control selectpicker" required>
                        <?php 
                            $asignaturas = conseguirAsignaturas($db);
                            foreach($asignaturas as $asignatura):
                        ?>
                            <option value="<?php echo $asignatura['id']; ?>"><?php echo $asignatura['asignatura']; ?></option>
                        <?php 
                            endforeach; 
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="#">Docente <strong style="color: red;">*</strong></label>
                    <select name="docente" class="form-control selectpicker" required>
                        <?php 
                            $docentes = conseguirDocentes($db);
                            foreach($docentes as $docente):
                        ?>
                            <option value="<?php echo $docente['id']; ?>"><?php echo $docente['nombre']; ?> <?php echo $docente['apellidos']; ?></option>
                        <?php 
                            endforeach; 
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="#">Observaciones</label>
                <textarea name="descripcion" class="form-control" rows="5" placeholder="Describa sus Inquietudes..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Solicitar</button>
        </form>
    </div>

<?php require_once 'views/layout/footer.php'; ?>