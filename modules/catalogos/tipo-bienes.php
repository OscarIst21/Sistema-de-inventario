
<?php
/**
 * modules/catalogos/tipos-bienes.php
 * Módulo: Tipos de Bienes
 */

// Datos de ejemplo. Posteriormente se pueden obtener desde MySQL.
$tipos_bienes = [
    ['codigo' => 5206,  'descripcion' => 'EQUIPO DE COMPUTO Y TECNOLOGÍA DE LA INFORMACIÓN'],
    ['codigo' => 5300,  'descripcion' => 'VEHICULOS Y EQUIPO DE TRANSPORTE'],
    ['codigo' => 5301,  'descripcion' => 'VEHICULOS Y EQUIPO TERRESTRE'],
    ['codigo' => 5302,  'descripcion' => 'VEHICULOS Y EQUIPO MARITIMO'],
    ['codigo' => 5303,  'descripcion' => 'VEHICULOS Y EQUIPO DE TRANSPORTE AEREO'],
    ['codigo' => 5304,  'descripcion' => 'EQUIPO AUXILIAR DE TRANSPORTE'],
    ['codigo' => 5400,  'descripcion' => 'EQUIPOS DIVERSOS Y COMPLEMENTOS'],
    ['codigo' => 5401,  'descripcion' => 'EQUIPO INSTRUMENTAL PARA LABORATORIO'],
    ['codigo' => 5402,  'descripcion' => 'HERRAMIENTAS Y REFACCIONES MAYORES'],
    ['codigo' => 5500,  'descripcion' => 'BIENES INMUEBLES'],
    ['codigo' => 5540,  'descripcion' => 'EQUIPO DE DEFENSA Y SEGURIDAD PUBLICA'],
    ['codigo' => 5601,  'descripcion' => 'SISTEMAS DE AIRE ACONDICIONADO, CALEFACCION Y REFRIGERACION'],
    ['codigo' => 15501, 'descripcion' => 'EDIFICIOS Y LOCALES'],
    ['codigo' => 15502, 'descripcion' => 'TERRENOS'],
];

// Ordenar por código ascendente.
usort($tipos_bienes, function ($a, $b) {
    return $a['codigo'] <=> $b['codigo'];
});

// Escapar texto para mostrarlo de forma segura en HTML.
if (!function_exists('e')) {
    function e($valor) {
        return htmlspecialchars(
            (string) $valor,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}
?>

<section class="module-area module-area-tipos-bienes">

    <div class="module-card">
        <div class="module-card-header">
            <span class="module-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 8l-9-5-9 5v8l9 5 9-5z"></path><path d="M3 8l9 5 9-5M12 13v8"></path></svg>
            </span>

            <h2 class="module-name">Tipos de Bienes</h2>
        </div>
    </div>

    <table class="areas-table" aria-label="Tipos de Bienes">
        <thead>
            <tr>
                <th scope="col" class="col-id">CÓDIGO</th>
                <th scope="col" class="col-desc">DESCRIPCIÓN</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($tipos_bienes as $item): ?>
                <tr class="row-odd">
                    <td class="col-id">
                        <?= e($item['codigo']) ?>
                    </td>

                    <td class="col-desc">
                        <?= e($item['descripcion']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="areas-actions">


    </div>

</section>
