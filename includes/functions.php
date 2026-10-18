<?php
/**
 * functions.php
 * Funciones PHP reutilizables para el Sistema de Inventario del CECyTE.
 *
 * Fase visual: no hay autenticación, sesiones ni base de datos.
 * Estas funciones son utilitarias y no contienen lógica de negocio.
 */

/**
 * Devuelve una ruta relativa desde la raíz del proyecto para recursos públicos.
 * Permite que la aplicación funcione en cualquier subdirectorio (ej:
 * http://localhost/SistemaInventario/).
 */
function base_url($path = '') {
    // Ruta del proyecto dentro del documento raíz del servidor.
    // Se detecta automáticamente a partir de la ubicación del archivo actual.
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $projectPos = strpos($script, '/SistemaInventario/');
    if ($projectPos !== false) {
        $base = substr($script, 0, $projectPos + strlen('/SistemaInventario'));
    } else {
        // Fallback: nombre del proyecto desde el directorio de trabajo.
        $base = '/SistemaInventario';
    }
    return $base . '/' . ltrim($path, '/');
}

/**
 * Escapa texto seguro para inserción en HTML.
 */
function e($text) {
    if ($text === null) return '';
    return htmlspecialchars((string)$text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Devuelve el título actual de la página. En esta fase es estático.
 */
function page_title() {
    return 'Panel Principal — Sistema de Inventario CECyTE';
}