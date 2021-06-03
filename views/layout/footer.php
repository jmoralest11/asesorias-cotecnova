                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </div>
        <!-- /.content-wrapper -->
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-center">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021.</strong> Todos los derechos reservados.
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Moment -->
    <script src="assets/js/moment.min.js"></script>

    <!-- Popper -->
    <script src="assets/js/popper.min.js"></script>

    <!-- Bootstrap Js-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Select Picker -->
    <script src="assets/js/select2.min.js"></script>

    <!-- AdminLTE -->
    <script src="assets/js/adminlte.js"></script>

    <!-- Full Calendar -->
    <script src="assets/js/fullcalendar.min.js"></script>

    <!-- Full Calendar Español -->
    <script src="assets/js/es.js"></script>

    <!-- ClockPicker JS -->
    <script src="assets/js/bootstrap-clockpicker.min.js"></script>

    <!-- DataTable JS -->
    <script src="assets/js/dataTables.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="assets/js/sweetalert2.all.min.js"></script>

    <!-- Script Configuración Full Calendar -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#calendarioWeb').fullCalendar({
                header: {
                    left: 'today, prev, next, MyBtn',
                    center: 'title',
                    right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
                },
                events: 'http://localhost/asesorias/obtener-asesorias-calendario.php',
                eventClick: function(calEvent, jsEvent, view){
                    // Información al HTML
                    $('#tituloAsesoria').html(calEvent.title);
                    $('#descripcionAsesoria').html(calEvent.descripcion);
                    $('#modalidad').html(calEvent.modalidad);
                    $('#asignatura').html(calEvent.asignatura);
                    $('#docente').html(calEvent.docente);
                    $('#horaInicial').html(calEvent.start._i);
                    $('#horaFinal').html(calEvent.end._i);

                    console.log(calEvent);

                    $("#exampleModal").modal('show');
                }    
            });

            // Configuración clockpicker RELOJ
            $('.clockpicker').clockpicker({
                donetext: 'Aceptar'
            });

            // Configuración selectPicker 
            $('.selectpicker').select2();

            // Configuración DataTable
            $('#myTable').DataTable(
                {
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "No se encontro la página, lo siento!",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No valores disponibles",
                        "search": "Buscar",
                        "paginate": {
                            "first":      "Primera",
                            "last":       "Ultima",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total registros)"
                    }
                }
            );

            $('.form-eliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setTimeout(() => {
                                this.submit();
                            }, 1500);
                            Swal.fire(
                                '¡Eliminado!',
                                'Su archivo ha sido eliminado.',
                                'success'
                            )
                        }
                })
            })

            $('.form-actualizar').submit(function(e){
                e.preventDefault();
                setTimeout(() => {
                    this.submit();
                }, 1500);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '¡Se actualizó correctamente!',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
        });
    </script>

</body>
</html>