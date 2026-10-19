
<?php
/**
 * modules/catalogos/estado-bienes.php
 * Módulo: Estado de los Bienes
 */
?>

<section class="module-area module-area-estado-bienes">

   <div class="areas-header">
    <div class="areas-title-wrap">
      <span class="areas-icon" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M20 12l-8 8-9-9V4h7z"></path><circle cx="7.5" cy="7.5" r="1"></circle></svg>
      </span>
      <div class="areas-titles">
        <h2 class="areas-title">Estado de los Bienes</h2>
        
      </div>
    </div>
  </div>

   
<?php
$estado_bienes = [
    ['clave' => '1', 'descripcion' => 'Bueno regular'],
    ['clave' => '2', 'descripcion' => 'Regular'],
    ['clave' => '3', 'descripcion' => 'Malo'],
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
