<?php require_once 'views/auth/header.php' ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="iniciar_sesion.php" method="POST">
    <img class="mb-4" src="assets/img/cotecnova-logo.jpg" alt="" width="200">
    <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>

    <div class="form-floating">
      <input type="number" class="form-control" id="floatingInput" name="identificacion" placeholder="name@example.com" required>
      <label for="floatingInput">Número Identificación</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password" required>
      <label for="floatingPassword">Contraseña</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="radio" name="tipo" value="ESTUDIANTE" checked> Estudiante
        <input type="radio" name="tipo" value="DOCENTE" style="margin-left: 30px;"> Docente
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit">Ingresar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main> 

<?php require_once 'views/auth/footer.php'; ?>