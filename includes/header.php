<?php
/**
 * header.php
 * Componente compartido de la cabecera HTML.
 * Contiene doctype, meta tags, título y referencias de recursos.
 * Carga también las hojas de estilo específicas de cada módulo según la vista.
 */
require_once __DIR__ . '/functions.php';

$current_view = $_GET['view'] ?? 'home';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo e(page_title()); ?></title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/modules/areas-responsabilidad.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/modules/colores.css'); ?>" />
  <link rel="icon" href="<?php echo base_url('assets/img/logo-cecyte.png'); ?>" type="image/png">
  <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/logo-cecyte.png'); ?>">
</head>
<body>
  <div class="dashboard" id="dashboardRoot">

    <!-- Overlay móvil (tocar fuera cierra el sidebar) -->
    <div class="mobile-overlay" id="mobileOverlay" aria-hidden="true"></div>

    <?php include __DIR__ . '/sidebar.php'; ?>

    <!-- Columna derecha: topbar + contenido -->
    <div class="content-column">
