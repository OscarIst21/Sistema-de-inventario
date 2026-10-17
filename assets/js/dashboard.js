/**
 * dashboard.js
 * Navegación y comportamiento del panel administrativo (100% visual).
 *
 * ============================================================
 * MODO DESARROLLO:
 *   - No hay autenticación, ni sesiones, ni base de datos.
 *   - Las vistas de cada módulo se renderizan dinámicamente
 *     aquí (SPA sencilla con JavaScript vanilla) sin recargar.
 *   - Estructura pensada para que, al conectar MySQL, cada
 *     opción pueda enlazarse a un endpoint real (fetch/AJAX)
 *     reutilizando el registro MODULE VIEWS de este archivo.
 * ============================================================
 */
document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  /* ============================================================
   * 1. Referencias al DOM
   * ============================================================ */
  const sidebar       = document.getElementById('sidebar');
  const overlay       = document.getElementById('mobileOverlay');
  const btnToggle     = document.getElementById('toggleSidebar');
  const navInicio     = document.getElementById('navInicio');
  const sidebarNav    = sidebar.querySelector('.sidebar-nav');
  const mainContent   = document.getElementById('mainContent');
  const pageTitle     = document.getElementById('pageTitle');
  const breadcrumbEl  = document.getElementById('breadcrumb');

  const MOBILE_BP = 860; // debe coincidir con el media query del CSS

  function isMobile() {
    return window.innerWidth <= MOBILE_BP;
  }

  /* ============================================================
   * 2. Iconos SVG (línea, estilo coherente con el login)
   * ============================================================ */
  function svg(paths, size) {
    size = size || 18;
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' + size + '" height="' + size +
      '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" ' +
      'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' +
      paths + '</svg>';
  }

  const ICON = {
    // Categorías
    catalogos:  svg('<path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 12h6"/>'),
    inventario: svg('<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v16"/>'),
    consultas:  svg('<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>'),
    reportes:   svg('<path d="M3 3v18h18"/><path d="M7 15l4-5 3 3 5-6"/>'),
    // Opciones
    area:       svg('<path d="M3 21h18M5 21V7l7-4 7 4v14"/><path d="M9 21v-4h6v4"/>', 15),
    color:      svg('<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/>', 15),
    tag:        svg('<path d="M20 12l-8 8-9-9V4h7z"/><circle cx="7.5" cy="7.5" r="1"/>', 15),
    x:          svg('<circle cx="12" cy="12" r="9"/><path d="M15 9l-6 6M9 9l6 6"/>', 15),
    box:        svg('<path d="M21 8l-9-5-9 5v8l9 5 9-5z"/><path d="M3 8l9 5 9-5M12 13v8"/>', 15),
    registro:   svg('<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>', 15),
    check:      svg('<path d="M9 11l3 3 8-8"/><path d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h9"/>', 15),
    refresh:    svg('<path d="M21 12a9 9 0 1 1-2.6-6.4"/><path d="M21 3v6h-6"/>', 15),
    historial:  svg('<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>', 15),
    chart1:     svg('<rect x="3" y="12" width="4" height="8"/><rect x="10" y="7" width="4" height="13"/><rect x="17" y="3" width="4" height="17"/>', 15),
    chart2:     svg('<path d="M12 3v18M5 8l7-5 7 5M5 16l7 5 7-5"/>', 15),
    chart3:     svg('<path d="M3 3v18h18"/><path d="M7 10l4 4 3-3 5 6"/>', 15),
    shield:     svg('<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/>', 15),
    // Interfaz
    chevron:    svg('<path d="M6 9l6 6 6-6"/>', 14),
    arrowRight: svg('<path d="M9 18l6-6-6-6"/>', 13),
    inbox:      svg('<path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.5 5h13L22 12v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-6z"/>', 30),
    hammer:     svg('<path d="M14 7l3-3 4 4-3 3-4-4z"/><path d="M13 8L4 17l3 3 9-9"/><path d="M8 12l-5 5 4 4 5-5"/>', 15)
  };

  /* ============================================================
   * 3. Registro del menú y de los módulos
   *
   * Para conectar el backend en el futuro: basta con añadir a
   * cada módulo una propiedad `endpoint` (ruta PHP que devuelva
   * JSON) y sustituir renderModuleView() por la carga real.
   * ============================================================ */
  const MENU = [
    {
      id: 'catalogos',
      name: 'Catálogos',
      icon: ICON.catalogos,
      items: [
        { id: 'areas-responsabilidad', name: 'Áreas de Responsabilidad', icon: ICON.area },
        { id: 'colores',               name: 'Colores',                  icon: ICON.color },
        { id: 'estado-bienes',         name: 'Estado de los Bienes',     icon: ICON.tag },
        { id: 'tipo-bajas',            name: 'Tipo de Bajas',            icon: ICON.x },
        { id: 'tipo-bienes',           name: 'Tipo de Bienes',           icon: ICON.box },
        { id: 'tipo-registros',        name: 'Tipo de Registros',        icon: ICON.registro }
      ]
    },
    {
      id: 'inventario',
      name: 'Inventario',
      icon: ICON.inventario,
      items: [
        { id: 'inventario-bienes',  name: 'Inventario de Bienes',  icon: ICON.check },
        { id: 'baja-lotes',         name: 'Baja por Lotes',        icon: ICON.x },
        { id: 'actualiza-resguardos', name: 'Actualiza Resguardos', icon: ICON.refresh }
      ]
    },
    {
      id: 'consultas',
      name: 'Consultas',
      icon: ICON.consultas,
      items: [
        { id: 'historico-bienes', name: 'Histórico de Bienes', icon: ICON.historial }
      ]
    },
    {
      id: 'reportes',
      name: 'Reportes',
      icon: ICON.reportes,
      items: [
        { id: 'activos-por-area',    name: 'Bienes Activos por Área',     icon: ICON.chart1 },
        { id: 'activos-por-niveles', name: 'Bienes Activos por Niveles',  icon: ICON.chart2 },
        { id: 'bienes-baja',         name: 'Bienes Dados de Baja',        icon: ICON.chart3 },
        { id: 'resguardos-especificos', name: 'Resguardos Específicos',   icon: ICON.shield }
      ]
    }
  ];

  /** Búsquedas rápidas por id */
  function findCategory(catId) {
    return MENU.find(function (c) { return c.id === catId; }) || null;
  }
  function findItem(catId, itemId) {
    const cat = findCategory(catId);
    if (!cat) return null;
    return cat.items.find(function (i) { return i.id === itemId; }) || null;
  }

  /* ============================================================
   * 4. Estado de la interfaz
   * ============================================================ */
  const state = {
    view: 'home',          // 'home' | 'module'
    catId: null,
    itemId: null,
    expandedCats: new Set() // categorías abiertas
  };

  /* ============================================================
   * 5. Construcción del menú lateral
   * ============================================================ */
  function buildSidebarMenu() {
    MENU.forEach(function (cat) {
      const catDiv = document.createElement('div');
      catDiv.className = 'menu-category';
      catDiv.setAttribute('data-cat', cat.id);

      /* --- Botón de categoría --- */
      const header = document.createElement('button');
      header.type = 'button';
      header.className = 'category-header';
      header.setAttribute('aria-expanded', 'false');
      header.setAttribute('aria-controls', 'items-' + cat.id);
      header.innerHTML =
        '<span class="cat-icon">' + cat.icon + '</span>' +
        '<span class="cat-label">' + cat.name + '</span>' +
        '<span class="chevron">' + ICON.chevron + '</span>';

      header.addEventListener('click', function () {
        // En modo colapsado, el primer clic expande el menú completo
        if (!isMobile() && sidebar.classList.contains('collapsed')) {
          setCollapsed(false);
        }

        /* Permitir solamente una categoría desplegada a la vez */
        const categoriaActual = header.closest('.menu-category');
        const estabaAbierta = header.getAttribute('aria-expanded') === 'true';

        // Cerrar todas las categorías
        document.querySelectorAll('.menu-category').forEach((categoria) => {
          const otroHeader = categoria.querySelector('.category-header');
          const opciones = categoria.querySelector('.category-items');

          if (otroHeader) {
            otroHeader.setAttribute('aria-expanded', 'false');
          }

          if (opciones) {
            opciones.classList.remove('open');
          }

          categoria.classList.remove('active-cat');
        });

        // Abrir únicamente la seleccionada, si estaba cerrada
        if (!estabaAbierta) {
          const opcionesActuales = categoriaActual.querySelector('.category-items');

          header.setAttribute('aria-expanded', 'true');

          if (opcionesActuales) {
            opcionesActuales.classList.add('open');
          }

          categoriaActual.classList.add('active-cat');
        }
      });

      catDiv.appendChild(header);

      /* --- Lista de opciones --- */
      const list = document.createElement('div');
      list.className = 'category-items';
      list.id = 'items-' + cat.id;
      list.setAttribute('role', 'menu');

      cat.items.forEach(function (item) {
        const el = document.createElement('button');
        el.type = 'button';
        el.className = 'nav-item';
        el.setAttribute('role', 'menuitem');
        el.setAttribute('data-item', item.id);
        el.innerHTML =
          '<span class="item-icon">' + item.icon + '</span>' +
          '<span>' + item.name + '</span>';

        el.addEventListener('click', function () {
          selectItem(cat.id, item.id);
          if (isMobile()) closeMobileDrawer();
        });
        list.appendChild(el);
      });

      catDiv.appendChild(list);
      sidebarNav.appendChild(catDiv);
    });
  }

  /** Abre/cierra una categoría con animación (max-height en CSS) */
  function toggleCategory(catId, forceOpen) {
    const catDiv = sidebarNav.querySelector('.menu-category[data-cat="' + catId + '"]');
    if (!catDiv) return;

    const header = catDiv.querySelector('.category-header');
    const list   = catDiv.querySelector('.category-items');
    const isOpen = state.expandedCats.has(catId);
    const open   = forceOpen !== undefined ? forceOpen : !isOpen;

    if (open) {
      state.expandedCats.add(catId);
      list.classList.add('open');
      header.setAttribute('aria-expanded', 'true');
    } else {
      state.expandedCats.delete(catId);
      list.classList.remove('open');
      header.setAttribute('aria-expanded', 'false');
    }
  }

  /* ============================================================
   * 6. Navegación: Inicio y selección de módulos
   * ============================================================ */
  function goHome() {
    state.view = 'home';
    state.catId = null;
    state.itemId = null;

    clearSelection();
    navInicio.classList.add('active');

    pageTitle.textContent = 'Panel principal';
    renderBreadcrumb(null, null, null);
    renderHome();
  }

  function selectItem(catId, itemId) {
    const cat = findCategory(catId);
    const item = cat && cat.items.find(function (i) { return i.id === itemId; });
    if (!cat || !item) return;

    state.view = 'module';
    state.catId = catId;
    state.itemId = itemId;

    /* Resaltados en el sidebar */
    clearSelection();
    toggleCategory(catId, true); // asegurar visible

    const catDiv = sidebarNav.querySelector('.menu-category[data-cat="' + catId + '"]');
    catDiv.classList.add('active-cat');
    const itemEl = catDiv.querySelector('.nav-item[data-item="' + itemId + '"]');
    if (itemEl) itemEl.classList.add('active');

    pageTitle.textContent = item.name;
    renderBreadcrumb(cat.name, item.name, catId);
    renderModuleView(cat, item);
    mainContent.scrollIntoView({ block: 'start' });
  }

  function clearSelection() {
    navInicio.classList.remove('active');
    sidebarNav.querySelectorAll('.nav-item.active').forEach(function (el) {
      el.classList.remove('active');
    });
    sidebarNav.querySelectorAll('.menu-category.active-cat').forEach(function (el) {
      el.classList.remove('active-cat');
    });
  }

  /* ============================================================
   * 7. Renderizado de vistas (sin recargar la página)
   * ============================================================ */

  /** Breadcrumb: "Inicio / {Categoría} / {Módulo}" */
  function renderBreadcrumb(catName, itemName, catIdForExpand) {
    breadcrumbEl.innerHTML = '';

    const inicio = document.createElement('button');
    inicio.type = 'button';
    inicio.className = 'crumb-link';
    inicio.textContent = 'Inicio';
    inicio.addEventListener('click', goHome);
    breadcrumbEl.appendChild(inicio);

    if (catName) {
      breadcrumbEl.appendChild(sep());
      const catCrumb = document.createElement('button');
      catCrumb.type = 'button';
      catCrumb.className = 'crumb-link';
      catCrumb.textContent = catName;
      catCrumb.addEventListener('click', function () {
        // Vuelve al módulo actual de la categoría o abre el primero
        const cat = findCategory(catIdForExpand);
        if (cat && cat.items.length) selectItem(cat.id, state.itemId || cat.items[0].id);
      });
      breadcrumbEl.appendChild(catCrumb);
    }

    if (itemName) {
      breadcrumbEl.appendChild(sep());
      const current = document.createElement('span');
      current.className = 'crumb-current';
      current.setAttribute('aria-current', 'page');
      current.textContent = itemName;
      breadcrumbEl.appendChild(current);
    }
  }

  function sep() {
    const s = document.createElement('span');
    s.className = 'crumb-sep';
    s.setAttribute('aria-hidden', 'true');
    s.innerHTML = ICON.arrowRight;
    return s;
  }

  /** Pantalla inicial: bienvenida + 4 tarjetas de acceso rápido */
  function renderHome() {
    mainContent.innerHTML = '';

    const welcome = document.createElement('section');
    welcome.className = 'welcome-section';
    welcome.innerHTML =
      '<h2>Bienvenido al Sistema de Inventario</h2>' +
      '<p class="welcome-text">Panel administrativo del CECyTE para la gestión de ' +
      'bienes e inventario. Seleccione una categoría del menú lateral o use las ' +
      'tarjetas de acceso rápido para explorar los módulos.</p>';
    mainContent.appendChild(welcome);

    const cards = document.createElement('section');
    cards.className = 'cards';
    cards.setAttribute('aria-label', 'Accesos rápidos a módulos');

    MENU.forEach(function (cat) {
      const first = cat.items[0];
      const card = document.createElement('button');
      card.type = 'button';
      card.className = 'quick-card';
      card.setAttribute('data-quick-cat', cat.id);
      card.innerHTML =
        '<span class="card-icon">' + cat.icon + '</span>' +
        '<h3 class="card-title">' + cat.name + '</h3>' +
        '<p class="card-desc">Explora las opciones disponibles en este módulo.</p>' +
        '<span class="card-action">' +
          (first ? 'Abrir ' + first.name : 'Abrir módulo') +
          '<span class="arrow">' + ICON.arrowRight + '</span>' +
        '</span>';

      // La tarjeta abre la categoría y su primera opción (más práctico)
      card.addEventListener('click', function () {
        if (first) selectItem(cat.id, first.id);
      });

      cards.appendChild(card);
    });

    mainContent.appendChild(cards);
  }

  /** Vista genérica de módulo: contenedor vacío, preparado para desarrollarse */
  function renderModuleView(cat, item) {
    mainContent.innerHTML = '';

    const area = document.createElement('section');
    area.className = 'module-area';
    area.setAttribute('aria-label', 'Módulo ' + item.name);

    area.innerHTML =
      '<div class="module-card">' +
        '<div class="module-card-header">' +
          '<span class="module-icon">' + item.icon + '</span>' +
          '<h2 class="module-name">' + item.name + '</h2>' +
        '</div>' +
        '<div class="module-card-body">' +
          '<span class="placeholder-icon">' + ICON.inbox + '</span>' +
          '<p class="placeholder-title">Módulo preparado para su desarrollo</p>' +
          '<p class="placeholder-text">' +
            'Aquí se mostrarán próximamente las tablas, formularios, filtros ' +
            'y acciones del módulo <strong>' + item.name + '</strong>, ' +
            'dentro de la categoría <strong>' + cat.name + '</strong>.' +
          '</p>' +
          '<div class="placeholder-structure" aria-hidden="true">' +
            'Zona de contenido reservada: <code>#module-' + item.id + '</code>' +
          '</div>' +
        '</div>' +
      '</div>';

    mainContent.appendChild(area);
  }

  /* ============================================================
   * 8. Sidebar contraído /expandido y drawer móvil
   * ============================================================ */
  function setCollapsed(collapsed) {
    if (isMobile()) return; // en móvil no aplica el modo iconos
    sidebar.classList.toggle('collapsed', collapsed);
    btnToggle.setAttribute('aria-expanded', String(!collapsed));
  }

  function openMobileDrawer() {
    sidebar.classList.add('mobile-open');
    overlay.classList.add('visible');
    overlay.setAttribute('aria-hidden', 'false');
  }

  function closeMobileDrawer() {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('visible');
    overlay.setAttribute('aria-hidden', 'true');
  }

  btnToggle.addEventListener('click', function () {
    if (isMobile()) {
      sidebar.classList.contains('mobile-open') ? closeMobileDrawer() : openMobileDrawer();
    } else {
      setCollapsed(!sidebar.classList.contains('collapsed'));
    }
  });

  // Tocar fuera del menú (móvil) o presionar Escape: cerrar
  overlay.addEventListener('click', closeMobileDrawer);
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && sidebar.classList.contains('mobile-open')) {
      closeMobileDrawer();
    }
  });

  // Si la ventana crece, quitar estados de móvil para evitar inconsistencias
  window.addEventListener('resize', function () {
    if (!isMobile()) closeMobileDrawer();
  });

  /* ============================================================
   * 9. Inicio
   * ============================================================ */
  navInicio.addEventListener('click', function () {
    goHome();
    if (isMobile()) closeMobileDrawer();
  });

  buildSidebarMenu();
  goHome();      // vista inicial: Panel principal con tarjetas
  toggleCategory('catalogos'); // una categoría abierta como ejemplo de uso
});
