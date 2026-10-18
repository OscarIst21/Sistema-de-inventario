<?php
require_once __DIR__ . '/functions.php';
?>

<aside class="sidebar" id="sidebar" role="navigation" aria-label="Menú principal">
  <div class="sidebar-header">
    <div class="sidebar-logo" id="sidebarLogo">
      <?php if (file_exists(__DIR__ . '/../assets/img/logo-cecyte.png')) : ?>
        <img src="<?php echo base_url('assets/img/logo-cecyte.png'); ?>"
             alt="Logo CECyTE"
             class="logo-img"
             onerror="this.style.display='none'; this.parentElement.querySelector('.logo-placeholder').style.display='flex';">
      <?php endif; ?>
      <div class="logo-placeholder" <?php echo file_exists(__DIR__ . '/../assets/img/logo-cecyte.png') ? 'style="display:none;"' : ''; ?> aria-hidden="true">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
          <rect x="2" y="2" width="20" height="20" rx="4" stroke="#00e883" stroke-width="1.5"/>
          <path d="M6 14l5-5 3 3 5-5" stroke="#00e883" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>
    <div class="sidebar-title">
      <span class="name">CECYTEBCS</span>
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

  </nav>
</aside>