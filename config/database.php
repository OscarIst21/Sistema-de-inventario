<?php
/**
 * database.php
 * Configuración de la conexión a la base de datos MySQL.
 *
 * FASE VISUAL: este archivo es un reservorio para la futura conexión.
 * No se intenta conectar aquí. Las credenciales deben definirse
 * cuando se active el backend real.
 *
 * Para usarlo, define las constantes o lee variables de entorno:
 *   DB_HOST, DB_USER, DB_PASS, DB_NAME
 */

// Prevenir uso directo.
if (!defined('SISTEMA_INVENTARIO')) {
    die('Acceso no autorizado.');
}

/**
 * Devuelve un array con los parámetros de conexión a la base de datos.
 * Las credenciales se leen de variables de entorno o de constantes definidas
 * por el entorno de despliegue; no se hardcodean valores por defecto.
 */
function db_config() {
    return [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'user' => getenv('DB_USER') ?: 'root',
        'pass' => getenv('DB_PASS') ?: '',
        'name' => getenv('DB_NAME') ?: 'sistema_inventario',
        'charset' => 'utf8mb4',
    ];
}

/**
 * Crea y devuelve una conexión PDO a MySQL.
 * Lanza una excepción si la conexión falla.
 *
 * Uso futuro:
 *   $pdo = db_connect();
 */
function db_connect() {
    $cfg = db_config();
    $dsn = 'mysql:host=' . $cfg['host'] . ';dbname=' . $cfg['name'] . ';charset=' . $cfg['charset'];
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
    } catch (PDOException $e) {
        // En producción, registrar el error y mostrar un mensaje genérico.
        throw new RuntimeException('Error de conexión a la base de datos.');
    }
}