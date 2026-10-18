<?php

// Datos iniciales oficiales (sin claves inventadas, orden conservado)
$areas_data = [
    ['clave' => '12', 'description' => 'CECYT 11',  'localidad' => 'LA PAZ, EL CENTENARIO',        'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 09',  'localidad' => 'COMONDÚ, BENITO JUÁREZ',      'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 10',  'localidad' => 'COMONDÚ, ADOLFO LÓPEZ MATEOS', 'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 11',  'localidad' => 'COMONDÚ, SAN ISIDRO',          'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'CECYTE 04', 'localidad' => 'LOS CABOS, SAN JOSÉ DEL CABO', 'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'CECYTE 05', 'localidad' => 'LOS CABOS, CABO SAN LUCAS',    'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 12',  'localidad' => 'LA PAZ, LAS POCITAS',          'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 13',  'localidad' => 'LA PAZ, COL. VILLAS DE GPE.',  'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'CECYTE 07', 'localidad' => 'LOS CABOS, SAN JOSÉ DEL CABO', 'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'CECYTE 08', 'localidad' => 'LA PAZ, LA PAZ BCS.',          'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 14',  'localidad' => '',                             'nivel' => ''],
    ['clave' => '',   'description' => 'CECYT 10',  'localidad' => 'LA PAZ, E. MELITÓN ALBÁÑEZ',   'nivel' => 'PLANTELES'],
    ['clave' => '',   'description' => 'EMSAD 16',  'localidad' => 'COMONDÚ, CIUDAD CONSTITUCIÓN', 'nivel' => 'PLANTELES']
];
?>
<section class="module-area module-area-areas" aria-label="Módulo Áreas de Responsabilidad">
  <div class="areas-header">
    <div class="areas-title-wrap">
      <span class="areas-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 21h16M5 21V8l7-5 7 5v13"/><path d="M9 21v-4h6v4"/><path d="M9 12h1.5v3H9zM13.5 12h1.5v3h-1.5z"/>
        </svg>
      </span>
      <div class="areas-titles">
        <h2 class="areas-title">Áreas de Responsabilidad</h2>
        
      </div>
    </div>
  </div>

  <div class="areas-table-wrap">
    <table class="areas-table" aria-label="Áreas de Responsabilidad">
      <thead>
        <tr>
          <th scope="col" class="col-clave">CLAVE</th>
          <th scope="col" class="col-desc">DESCRIPCIÓN</th>
          <th scope="col" class="col-localidad">LOCALIDAD</th>
          <th scope="col" class="col-nivel">NIVEL</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($areas_data as $idx => $row): ?>
          <tr class="<?php echo ($idx % 2 === 0) ? 'row-even' : 'row-odd'; ?>">
            <td class="col-clave"><?php echo $row['clave'] !== '' ? e($row['clave']) : '&nbsp;'; ?></td>
            <td class="col-desc"><?php echo $row['description'] !== '' ? e($row['description']) : '&nbsp;'; ?></td>
            <td class="col-localidad"><?php echo $row['localidad'] !== '' ? e($row['localidad']) : '&nbsp;'; ?></td>
            <td class="col-nivel"><?php echo $row['nivel'] !== '' ? e($row['nivel']) : '&nbsp;'; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="areas-actions">
    <button type="button" class="btn btn-print" id="areasPrintBtn" aria-label="Imprimir áreas de responsabilidad">
      <span class="btn-print-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v5"/><path d="M5 11h14a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2z"/><path d="M9 15h6"/>
        </svg>
      </span>
      <span class="btn-print-text">Imprimir</span>
    </button>
  </div>
</section>
