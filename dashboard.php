<?php
/**
 * dashboard.php
 * Panel principal administrativo del Sistema de Inventario del CECyTE.
 *
 * Punto de entrada principal después del login.
 * Gestiona la carga de módulos mediante el parámetro 'view'.
 */
define('SISTEMA_INVENTARIO', true);

require_once __DIR__ . '/includes/functions.php';

// Lista blanca de módulos permitidos para evitar inclusiones arbitrarias.
$allowed_views = [
    'home'                    => null,
    // Catálogos
    'areas-responsabilidad'   => 'modules/catalogos/areas-responsabilidad.php',
    'colores'                 => 'modules/catalogos/colores.php',
    'estado-bienes'           => 'modules/catalogos/estado-bienes.php',
    'tipo-bajas'              => 'modules/catalogos/tipo-bajas.php',
    'tipo-bienes'             => 'modules/catalogos/tipo-bienes.php',
    'tipo-registros'          => 'modules/catalogos/tipo-registros.php',
    // Inventario
    'inventario-bienes'       => 'modules/inventario/inventario-bienes.php',
    'baja-lotes'              => 'modules/inventario/baja-lotes.php',
    'actualiza-resguardos'    => 'modules/inventario/actualiza-resguardos.php',
    // Consultas
    'historico-bienes'        => 'modules/consultas/historico-bienes.php',
    // Reportes
    'activos-por-area'        => 'modules/reportes/bienes-activos-area.php',
    'activos-por-niveles'     => 'modules/reportes/bienes-activos-niveles.php',
    'bienes-baja'             => 'modules/reportes/bienes-baja.php',
    'resguardos-especificos'  => 'modules/reportes/resguardos-especificos.php'
];

$view = $_GET['view'] ?? 'home';

// Validar que la vista exista en la lista blanca.
if (!array_key_exists($view, $allowed_views)) {
    $view = 'home';
}

$module_path = $allowed_views[$view];

// Incluir cabecera (incluye sidebar)
include __DIR__ . '/includes/header.php';
?>

<!-- Topbar superior -->
<header class="topbar">
  <!-- Botón hamburguesa / contraer (izquierda) -->
  <button type="button" id="toggleSidebar" class="menu-toggle" aria-label="Alternar menú lateral" aria-controls="sidebar">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <line x1="3" y1="6" x2="21" y2="6"></line>
      <line x1="3" y1="12" x2="21" y2="12"></line>
      <line x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
  </button>

  <!-- Título + breadcrumb (centro/izquierda) -->
  <div class="topbar-titles">
    <h1 class="page-title" id="pageTitle">Panel principal</h1>
    <nav class="breadcrumb" id="breadcrumb" aria-label="Ruta de navegación">
      <span class="crumb-item">Inicio</span>
    </nav>
  </div>

  <!-- Notificaciones + perfil (derecha) -->
  <div class="topbar-actions">
    <button type="button" class="icon-btn" id="notificationBtn" aria-label="Notificaciones" disabled>
      <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
        <path d="M13.73 21a2 2 0 01-3.46 0"></path>
      </svg>
    </button>

    <div class="profile" aria-label="Perfil temporal: Administrador">
      <span class="avatar" aria-hidden="true">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 12a4 4 0 100-8 4 4 0 000 8z"></path>
          <path d="M4 20a8 8 0 0116 0"></path>
        </svg>
      </span>
      <span class="profile-name">Administrador</span>
    </div>
  </div>
</header>

<?php
// Incluir el contenido dinámico del módulo o el home
if ($view === 'home' || !$module_path) {
    ?>
    <main class="main-content" id="mainContent" tabindex="-1">
      <section class="welcome-section">
        <h2>Bienvenido al Sistema de Inventario</h2>
        <p class="welcome-text">Panel administrativo del CECyTE para la gestión de bienes e inventario. Seleccione una categoría del menú lateral o use las tarjetas de acceso rápido para explorar los módulos.</p>
      </section>

      <section class="cards" aria-label="Accesos rápidos a módulos">
        <!-- Catálogos -->
        <button type="button" class="quick-card" data-cat="catalogos" data-quick-view="areas-responsabilidad">
          <span class="card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 12h6"/></svg>
          </span>
          <h3 class="card-title">Catálogos</h3>
          <p class="card-desc">Administración de áreas, colores, tipos de bienes y estados.</p>
          <span class="card-action">Abrir Catálogos <span class="arrow"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></span></span>
        </button>

        <!-- Inventario -->
        <button type="button" class="quick-card" data-cat="inventario" data-quick-view="inventario-bienes">
          <span class="card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v16"/></svg>
          </span>
          <h3 class="card-title">Inventario</h3>
          <p class="card-desc">Control de bienes, resguardos y registro de bajas por lotes.</p>
          <span class="card-action">Abrir Inventario <span class="arrow"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></span></span>
        </button>

        <!-- Consultas -->
        <button type="button" class="quick-card" data-cat="consultas" data-quick-view="historico-bienes">
          <span class="card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
          </span>
          <h3 class="card-title">Consultas</h3>
          <p class="card-desc">Búsqueda rápida y revisión del histórico de bienes.</p>
          <span class="card-action">Abrir Consultas <span class="arrow"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></span></span>
        </button>

        <!-- Reportes -->
        <button type="button" class="quick-card" data-cat="reportes" data-quick-view="activos-por-area">
          <span class="card-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M7 15l4-5 3 3 5-6"/></svg>
          </span>
          <h3 class="card-title">Reportes</h3>
          <p class="card-desc">Generación de reportes por áreas, niveles y resguardos.</p>
          <span class="card-action">Abrir Reportes <span class="arrow"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></span></span>
        </button>
      </section>
    </main>
    <?php
} else {
    // Cargar el módulo solicitado
    echo '<main class="main-content" id="mainContent" tabindex="-1">';
    if (file_exists(__DIR__ . '/' . $module_path)) {
        include __DIR__ . '/' . $module_path;
    } else {
        echo '<p>Error: El módulo no se encuentra disponible.</p>';
    }
    echo '</main>';
}

// Cargar el footer (cierra etiquetas y carga JS)
include __DIR__ . '/includes/footer.php';
?>
