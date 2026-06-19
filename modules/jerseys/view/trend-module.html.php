<?php
$semilla_hora = date('YmdH');

// 1. Sembra el generador con la hora actual para que el número sea único por hora
mt_srand((int)$semilla_hora);
$vendidos_por_hora = mt_rand(201, 820); // Rango de ventas (puedes cambiar el 15 y 38)
$semilla_minuto = date('YmdHi');
mt_srand((int)$semilla_minuto);
// 3. Genera el número online inicial entre 20 y 50
$online_inicial = mt_rand(760, 980);
// Resetea la semilla de PHP para no romper otros elementos aleatorios de tu web
mt_srand();
?>

<style>
  .demand-card {
    background: #ffffff;
    border-radius: 8px;
    padding: 16px;
    max-width: 400px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); */
  }

  .trending-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 14px;
    margin: 4px 0;
    color: #1f2937;
  }

  .dot {
    height: 8px;
    width: 8px;
    border-radius: 50%;
    display: inline-block;
  }

  .pulse {
    background-color: #ef4444;
    animation: pulse-red 2s infinite;
  }

  .status-green {
    background-color: #22c55e;
  }

  @keyframes pulse-red {
    0% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
    }

    70% {
      transform: scale(1);
      box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
    }

    100% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
    }
  }

  .stat-row {
    font-size: 14px;
    color: #374151;
    margin: 4px 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* Icono de camión azul responsivo */
  .shipping-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .shipping-icon-wrapper svg {
    width: 20px;
    height: 20px;
    fill: none;
    stroke: #2563eb;
    /* Color azul característico de tu imagen */
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .shipping-text {
    font-size: 14px;
    color: #64748b;
    /* Color gris para el texto secundario */
    margin: 0;
    line-height: 1.4;
  }

  .shipping-text strong {
    color: #0f172a;
    /* El texto principal va en un color casi negro destacado */
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 12px;
  }

  .shipping-box {
    background: #ffffff;
    display: flex;
    align-items: center;
    gap: 12px;
  }
</style>

<div class="demand-card">
  <div class="trending-header">
    <span class="dot pulse"></span> 🔥 En Tendencia Ahora
  </div>
  <div class="trending-header">
    <span class="dot pulse"></span>
    <!-- <div class="shipping-icon-wrapper"> -->
    <!-- Icono SVG de camión limpio -->
    <!-- <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
        <circle cx="5.5" cy="18.5" r="2.5" />
        <circle cx="18.5" cy="18.5" r="2.5" />
      </svg>
    </div> -->
    🚚 Recibe el día 06 de Julio con DHL

  </div>
  <div class="stat-row">
    <span class="dot status-green"></span>
    <strong id="viewers-count"><?php echo $online_inicial; ?></strong> personas viendo ahora
  </div>

  <div class="stat-row">
    <span class="dot pulse"></span>
    <strong><?php echo $vendidos_por_hora; ?></strong> vendidas en las últimas 24h
  </div>
</div>

<script>
  // Cargamos el valor inicial generado por PHP
  let currentViewers = <?php echo $online_inicial; ?>;

  function updateViewers() {
    // Genera un paso pequeño y natural: -1, 0, o 1
    const change = Math.floor(Math.random() * 3) - 1;
    currentViewers += change;

    // Forzamos estrictamente el rango entre 20 y 50
    if (currentViewers < 760) currentViewers = 760;
    if (currentViewers > 980) currentViewers = 980;

    document.getElementById('viewers-count').innerText = currentViewers;
  }

  // Cambié el intervalo a 3.5 segundos para que la fluctuación se sienta más real y menos frenética
  setInterval(updateViewers, 10000);
</script>