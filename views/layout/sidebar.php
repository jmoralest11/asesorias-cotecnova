<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/img/admin-logo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['usuario']['nombre'] ?> <?php echo $_SESSION['usuario']['apellidos'] ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="calendario.php" class="nav-link">
                        <i class="nav-icon fa fa-calendar" aria-hidden="true"></i>
                        <p>Asesorías</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="estado-asesoria.php" class="nav-link">
                        <i class="nav-icon fa fa-cogs" aria-hidden="true"></i>
                        <p>Consultar Estado Asesoría</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="estado-docente.php" class="nav-link">
                        <i class="nav-icon fa fa-graduation-cap" aria-hidden="true"></i>
                        <?php if ($_SESSION['usuario']['role'] == 'ESTUDIANTE') : ?>
                            <p>Consultar Docentes <span class="alert-success"><strong>¡Hoy!</strong></span></p>
                        <?php endif; ?>
                        <?php if ($_SESSION['usuario']['role'] == 'DOCENTE') : ?>
                            <p>Mi Estado <span class="alert-success"><strong>¡Hoy!</strong></span></p>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            <?php if ($_SESSION['usuario']['role'] == 'ESTUDIANTE') : ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="solicitar-asesoria.php" class="nav-link">
                            <i class="nav-icon fa fa-check" aria-hidden="true"></i>
                            <p>Solicitar Asesoría <span class="alert-success"><strong>¡Hoy!</strong></span></p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="gestionar-asesorias.php" class="nav-link">
                            <i class="nav-icon fa fa-pencil-square-o" aria-hidden="true"></i>
                            <p>Gestionar Asesorías</span></p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="repositorios.php" class="nav-link">
                        <i class="nav-icon fa fa-laptop" aria-hidden="true"></i>
                        <p>Repositorios Virtuales</span></p>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </nav>
    </div>
</aside>