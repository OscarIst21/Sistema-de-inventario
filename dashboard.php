<?php
/* dashboard.php
 * Panel principal administrativo del Sistema de Inventario del CECyTE.
 *
 * IMPORTANTE (desarrollo):
 *   - Este archivo es VISUAL: no valida credenciales, no conecta a MySQL,
 *     no usa sesiones de autenticación ni datos reales.
 *   - La navegación entre módulos se realiza con JavaScript vanilla
 *     (assets/js/dashboard.js); no se crean páginas PHP separadas por módulo.
 *   - Cuando se integre el backend, este archivo se ampliará con la lógica
 *     de autenticación (PHP + sesión) y consultas preparadas a base de datos.
 */
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel Principal — Sistema de Inventario CECyTE</title>
  <link rel="stylesheet" href="assets/css/dashboard.css" />
  <link rel="icon" href="assets/img/logo-cecyte.png" type="image/png">
  <link rel="apple-touch-icon" href="assets/img/logo-cecyte.png">
</head>
<body>
  <div class="dashboard" id="dashboardRoot">

    <!-- ===== Overlay móvil (tocar fuera cierra el sidebar) ===== -->
    <div class="mobile-overlay" id="mobileOverlay" aria-hidden="true"></div>

    <!-- ===== Sidebar ===== -->
    <aside class="sidebar" id="sidebar" role="navigation" aria-label="Menú principal">
      <!-- Header del sidebar -->
      <div class="sidebar-header">
        <div class="sidebar-logo" id="sidebarLogo">
          <!-- Logo institucional: si la imagen no existe, se muestra un placeholder SVG.
               En PHP: file_exists('assets/img/logo-cecyte.png') -->
          <?php if (file_exists(__DIR__ . '/assets/img/logo-cecyte.png')) : ?>
            <img src="assets/img/logo-cecyte.png"
                 alt="Logo CECyTE"
                 class="logo-img"
                 onerror="this.style.display='none'; this.parentElement.querySelector('.logo-placeholder').style.display='flex';">
          <?php endif; ?>
          <div class="logo-placeholder" <?php echo file_exists(__DIR__ . '/assets/img/logo-cecyte.png') ? 'style="display:none;"' : ''; ?> aria-hidden="true">
            <!-- Icono temporal (no es un logotipo institucional falso) -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
              <rect x="2" y="2" width="20" height="20" rx="4" stroke="#00e883" stroke-width="1.5"/>
              <path d="M6 14l5-5 3 3 5-5" stroke="#00e883" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
        <div class="sidebar-title">
          <span class="name">CECyTE</span>
          <span class="subtitle">Sistema de Inventario</span>
        </div>
      </div>

      <!-- Navegación -->
      <nav class="sidebar-nav" role="menubar" aria-label="Navegación del sistema">
        <!-- Botón Inicio -->
        <div class="nav-inicio"
             id="navInicio"
             role="menuitem"
             tabindex="0"
             aria-label="Ir al panel principal">
          <span class="item-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          </span>
          <span class="inicio-label">Inicio</span>
        </div>

        <!-- Categorías y submenús: construidos dinámicamente por dashboard.js
             (Catálogos, Inventario, Consultas, Reportes) -->
      </nav>
    </aside>

    <!-- ===== Columna derecha: topbar + contenido ===== -->
    <div class="content-column">

      <!-- Topbar superior -->
      <header class="topbar">
        <!-- Botón hamburguesa / contraer (izquierda) -->
        <button type="button"
                id="toggleSidebar"
                class="menu-toggle"
                aria-label="Alternar menú lateral"
                aria-controls="sidebar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>

        <!-- Título + breadcrumb (centro/izquierda) -->
        <div class="topbar-titles">
          <h1 class="page-title" id="pageTitle">Panel principal</h1>
          <!-- Breadcrumb: "Inicio / Catálogos / Colores" -->
          <nav class="breadcrumb" id="breadcrumb" aria-label="Ruta de navegación">
            <span class="crumb-item">Inicio</span>
          </nav>
        </div>

        <!-- Notificaciones + perfil (derecha) -->
        <div class="topbar-actions">
          <button type="button" class="icon-btn" id="notificationBtn"
                  aria-label="Notificaciones (pendiente de implementación)" disabled>
            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
              <path d="M13.73 21a2 2 0 01-3.46 0"></path>
            </svg>
          </button>

          <!-- Perfil temporal: sin usuarios reales todavía -->
          <div class="profile" aria-label="Perfil temporal: Administrador">
            <span class="avatar" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 12a4 4 0 100-8 4 4 0 000 8z"></path>
                <path d="M4 20a8 8 0 0116 0"></path>
              </svg>
            </span>
            <span class="profile-name">Administrador</span>
          </div>
        </div>
      </header>

      <!-- Contenido dinámico del área principal -->
      <main class="main-content" id="mainContent" tabindex="-1" aria-label="Contenido del módulo">
        <!-- Renderizado por dashboard.js: panel de inicio o vista de módulo.
             Preparado para albergar en el futuro tablas, formularios,
             filtros y botones alimentados por MySQL. -->
      </main>

      <!-- Footer institucional -->
      <footer class="app-footer" aria-label="Pie de página institucional">
        <small>© 2026 CECyTEBCS — Departamento de Informática. Sistema de Inventario de Bienes.</small>
      </footer>

    </div>
  </div>

  <script src="assets/js/dashboard.js" defer></script>
</body>
</html>
