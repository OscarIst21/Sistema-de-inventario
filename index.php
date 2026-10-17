<?php
// index.php
// Pantalla de login (visual). No implementa autenticación.
// Coloca los assets en assets/css, assets/js, assets/img según la estructura indicada.
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Sistema de Inventario — CECyTE</title>
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="icon" href="assets/img/logo-cecyte.png" type="image/png">
  <link rel="apple-touch-icon" href="assets/img/logo-cecyte.png">
</head>
<body>
  <main class="page-root">
    <!-- Decoración (elementos visuales discretos) -->
    <div class="decor decor--circle decor--c1" aria-hidden="true"></div>
    <div class="decor decor--circle decor--c2" aria-hidden="true"></div>
    <div class="decor decor--shape decor--s1" aria-hidden="true"></div>

    <section class="login-wrap" aria-labelledby="loginTitle">
      <div class="login-card" role="region" aria-label="Formulario de inicio de sesión">
        <header class="card-header">
          <div class="logo-area" aria-hidden="false">
            <!-- Intentamos cargar el logo institucional (PNG solicitado originalmente).
                 Se recomienda agregar assets/img/logo-cecyte.png o logo-cecyte.svg.
                 Si no existe, el <img> falla y se muestra el fallback (icono SVG). -->
            <img
              src="assets/img/logo-cecyte.png"
              alt="Logo CECyTE"
              class="cecyte-logo"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="logo-fallback" style="display:none;" aria-hidden="true">
              <!-- Icono institucional genérico (SVG) como placeholder -->
              <svg width="56" height="56" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                <rect x="1.5" y="1.5" width="21" height="21" rx="4" fill="#0B6A2A" />
                <path d="M6 15.5L10 10.5L14 15.5" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="17.5" cy="6.5" r="1.6" fill="#fff"/>
              </svg>
            </div>
          </div>

          <div class="brand-text">
            <h1 id="loginTitle" class="brand-title">Sistema de Inventario</h1>
            <p class="brand-subtitle">Gestión administrativa de bienes</p>
          </div>
        </header>

        <div class="card-body">
          <h2 class="welcome-title">Bienvenido</h2>
          <p class="welcome-desc">Ingresa tus credenciales para continuar</p>

          <!--
            NAVEGACIÓN DE DESARROLLO (temporal):
            Al hacer clic en "Iniciar sesame" redirige directamente a dashboard.php
            sin verificar credenciales. Esta navegación es exclusivamente para
            desarrollo y será sustituida por una autenticación real cuando se
            conecte el backend con PHP y MySQL.
          -->
          <form id="loginForm" class="login-form" action="dashboard.php" method="get" novalidate>
            <!-- Usuario -->
            <div class="input-group">
              <label for="username" class="visually-hidden">Usuario</label>
              <div class="input-with-icon">
                <span class="input-icon" aria-hidden="true">
                  <!-- Usuario SVG icon -->
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" focusable="false" aria-hidden="true">
                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke="#4B5849" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 20a8 8 0 0 1 16 0" stroke="#4B5849" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
                <input id="username" name="username" type="text"
                       placeholder="Ingresa tu usuario"
                       autocomplete="username"
                       required
                       aria-required="true"
                       class="form-input" />
              </div>
            </div>

            <!-- Contraseña -->
            <div class="input-group">
              <label for="password" class="visually-hidden">Contraseña</label>
              <div class="input-with-icon">
                <span class="input-icon" aria-hidden="true">
                  <!-- Candado SVG -->
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" focusable="false" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="10" rx="2.2" stroke="#4B5849" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="#4B5849" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>

                <input id="password" name="password" type="password"
                       placeholder="Ingresa tu contraseña"
                       autocomplete="current-password"
                       required
                       aria-required="true"
                       class="form-input" />

                <button type="button" id="togglePassword" class="toggle-password" aria-label="Mostrar contraseña" aria-pressed="false">
                  <!-- Ojo SVG (cambia vía JS) -->
                  <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" focusable="false" aria-hidden="true">
                    <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" stroke="#2B6B2E" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="2.4" fill="#2B6B2E"/>
                  </svg>
                </button>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary" id="loginBtn">Iniciar sesión</button>
            </div>
          </form>
        </div>

        <footer class="card-footer" aria-hidden="true">
          <small class="muted">CECyTEBCS — Departamento de Informática</small>
        </footer>
      </div>
    </section>
  </main>

  <script src="assets/js/login.js" defer></script>
</body>
</html>
