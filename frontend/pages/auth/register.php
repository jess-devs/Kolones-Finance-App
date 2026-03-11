<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=DM+Sans:wght@400;500&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/frontend/css/auth/auth-main.css" />
  <link rel="stylesheet" href="/frontend/css/main.css" />
  <title>Kolones Finance — Registro</title>
</head>

<body>
  <header class="site-header">
    <nav class="site-nav">
      <div class="about" id="about-right">
        <img src="/frontend/assets/svg/auth/run-sports-runner-svgrepo-com.svg" alt="volver" />

        <a href="/frontend/pages/index.php" class="nav-link">Volver</a>
      </div>
    </nav>
  </header>

  <main class="hero">
    <div class="hero-title-block">
      <h1 class="hero-title">
        <span class="title-line">Crea</span>
        <span class="title-line">tú</span>
        <span class="title-line">cuenta</span>
      </h1>
    </div>

    <div class="auth-form-block">
      <form class="auth-form" data-accion="registro" action="#" method="post">
        <div class="form-group">
          <label class="form-label" for="name">Nombre</label>
          <input
            class="form-input"
            type="text"
            id="name"
            name="name"
            placeholder="Tu nombre"
            autocomplete="name"
            required />
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Correo electrónico</label>
          <input
            class="form-input"
            type="email"
            id="email"
            name="email"
            placeholder="tu@correo.com"
            autocomplete="email"
            required />
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Contraseña</label>
          <input
            class="form-input"
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            autocomplete="new-password"
            required />
        </div>

        <div class="form-group">
          <label class="form-label" for="password-confirm">Confirmar contraseña</label>
          <input
            class="form-input"
            type="password"
            id="password-confirm"
            name="password_confirm"
            placeholder="••••••••"
            autocomplete="new-password"
            required />
        </div>

        <button class="btn-submit" type="submit">Crear cuenta</button>

        <p class="auth-switch">
          ¿Ya tienes cuenta?
          <a href="login.php">Inicia sesión</a>
        </p>
      </form>
    </div>
  </main>

  <script src="/frontend/js/api.js"></script>
  <script src="/frontend/js/auth.js"></script>
</body>

</html>