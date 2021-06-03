<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'views/layout/header.php'; ?>

    <div class="container">
        <h2>Mi Calendario   <i class="fa fa-calendar" aria-hidden="true"></i></h2> <hr> <br>
        <div class="row">
            <div class="col"></div>
            <div class="col-10"><div id="calendarioWeb"></div></div>
            <div class="col"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloAsesoria"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="#">Asignatura</label>
                        <p id="asignatura"></p>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="#">Docente</label>
                        <p id="docente"></p>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="#">Fecha - Hora Inicial</label>
                            <p id="horaInicial"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="#">Fecha - Hora Final</label>
                            <p id="horaFinal"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="#">Modalidad</label>
                        <p id="modalidad"></p>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="#">Observaciones</label>
                        <p id="descripcionAsesoria"></p>
                    </div>
                    <input type="hidden" id="txtId" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'views/layout/footer.php'; ?>
