<?php
/**
 * modules/catalogos/tipo-bajas.php
 * Módulo: Tipo de Bajas
 */
?>
<section class="module-area module-area-estado-bienes">

   <div class="areas-header">
    <div class="areas-title-wrap">
      <span class="areas-icon" aria-hidden="true">
         <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
     </span>
      <div class="areas-titles">
        <h2 class="areas-title">Tipo de Bajas</h2>
        
      </div>
    </div>
  </div>

 
<?php
$estado_bienes = [
    ['clave' => '1', 'descripcion' => 'DONACION'],
    ['clave' => '2', 'descripcion' => 'ROBO'],
    ['clave' => '3', 'descripcion' => 'SINIESTRADO'],
    ['clave' => '4', 'descripcion' => 'INCOSTEABLE'],
    ['clave' => '5', 'descripcion' => 'TRANSFERENCIA'],
    ['clave' => '6', 'descripcion' => 'FALTANTES'],
    ['clave' => '7', 'descripcion' => 'ALMACEN'],
    ['clave' => '8', 'descripcion' => 'VENTA'],
    ['clave' => '9', 'descripcion' => 'DUPLICADO'],
    ['clave' => '10', 'descripcion' => 'MAL ESTADO'],
    ['clave' => '11', 'descripcion' => 'POR CAMBIO DE CUENTA'],
    ];

if (!function_exists('e')) {
    function e($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}
?>

<table class="areas-table" aria-label="Estado de los Bienes">
    <thead>
        <tr>
            <th scope="col" class="col-clave">CLAVE</th>
            <th scope="col" class="col-desc">DESCRIPCIÓN</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($estado_bienes as $row): ?>
            <tr class="row-odd">
                <td class="col-clave">
                    <?= e($row['clave']) ?>
                </td>
                <td class="col-desc">
                    <?= e($row['descripcion']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <div class="areas-actions">
        <button
            type="button"
            class="btn btn-print"
            id="estadoPrintBtn"
            aria-label="Imprimir estado de bienes"
        >
            <span class="btn-print-icon">
                <svg width="18" height="18" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v5"/>
                    <path d="M5 11h14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2z"/>
                    <path d="M9 15h6"/>
                </svg>
            </span>

            <span class="btn-print-text">Imprimir</span>
        </button>
    </div>

</section>
