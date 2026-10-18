<?php
/**
 * modules/catalogos/colores.php
 * Módulo: Colores
 */

// Datos iniciales de Colores
$colores_data = [
    ['clave' => '178', 'description' => 'COCOA/BEIGE'],
    ['clave' => '179', 'description' => 'AZUL/BEIGE'],
    ['clave' => '180', 'description' => 'PERA'],
    ['clave' => '181', 'description' => 'PLATA/AZUL'],
    ['clave' => '182', 'description' => 'GRIS MINER'],
    ['clave' => '183', 'description' => 'NEGRO/GRIS'],
    ['clave' => '184', 'description' => 'BLANCO PLATINADO MET'],
    ['clave' => '185', 'description' => 'CAOBA CON NEGRO'],
    ['clave' => '186', 'description' => 'CAOBA PINO'],
    ['clave' => '187', 'description' => 'VERDE/GRIS/BLANCO'],
    ['clave' => '188', 'description' => 'GRIS TORMENTA'],
    ['clave' => '189', 'description' => 'CAFE OBSCURO'],
    ['clave' => '190', 'description' => 'METAL Y MADERA'],
    ['clave' => '191', 'description' => 'TAMARINDO'],
    ['clave' => 'UNK', 'description' => '']
];
?>
<section class="module-area module-area-colores" aria-label="Módulo Colores">
  <div class="areas-header">
    <div class="areas-title-wrap">
      <span class="areas-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/>
        </svg>
      </span>
      <div class="areas-titles">
        <h2 class="areas-title">Colores</h2>
        
      </div>
    </div>
  </div>

  <div class="areas-table-wrap">
    <table class="areas-table" aria-label="Catálogo de Colores">
      <thead>
        <tr>
          <th scope="col" class="col-clave">CLAVE</th>
          <th scope="col" class="col-desc">DESCRIPCIÓN</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($colores_data as $idx => $row): ?>
          <tr class="<?php echo ($idx % 2 === 0) ? 'row-even' : 'row-odd'; ?>">
            <td class="col-clave"><?php echo e($row['clave']); ?></td>
            <td class="col-desc"><?php echo e($row['description']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="areas-actions">
    <button type="button" class="btn btn-print" id="coloresPrintBtn" aria-label="Imprimir catálogo de colores">
      <span class="btn-print-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v5"/><path d="M5 11h14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2z"/><path d="M9 15h6"/>
        </svg>
      </span>
      <span class="btn-print-text">Imprimir</span>
    </button>
  </div>
</section>
