<style>
  .envio-card {
    background: #ffffff;
    padding: 24px;
    max-width: 500px;
  }

  .envio-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    align-items: center;
  }

  .envio-icon {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
  }

  /* Colores específicos de la imagen */
  .icon-green {
    color: #166534;
  }

  .icon-blue {
    color: #2563eb;
  }

  .icon-purple {
    color: #7c3aed;
  }

  .icon-gray {
    color: #6b7280;
  }

  .envio-titulo {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
  }

  .envio-sub {
    color: #6b7280;
    font-size: 15px;
    margin-left: 4px;
  }

  .badge-regalo {
    background-color: #f0fdf4;
    color: #166534;
    font-size: 11px;
    padding: 2px 6px;
    margin-left: 8px;
    border: 1px solid #bbf7d0;
    border-radius: 4px;
    font-weight: 600;
    text-transform: uppercase;
    vertical-align: middle;
  }

  .highlight {
    font-weight: 700;
    color: #000;
  }
</style>
<div class="container mt-4">
  <div class="envio-card">
    <!-- Regalo -->
    <div class="envio-item">
      <svg class="envio-icon icon-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" d="M20 7h-4V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H4c-1.1 0-2 .9-2 2v3c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 5h4v2h-4V5zM4 12h16v7H4v-7z" />
      </svg>
      <div class="envio-titulo">Recibe un Llavero Exclusivo gratis <span class="badge-regalo">REGALO</span></div>
    </div>

    <!-- Envío estándar -->
    <div class="envio-item">
      <svg class="envio-icon icon-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" d="M1 9h22M1 15h22M12 3v18M5 12h14" />
      </svg>
      <div class="envio-titulo">Envío estándar a todo México <span class="envio-sub">(12–18 días hábiles)</span></div>
    </div>

    <!-- Carrier -->
    <div class="envio-item">
      <svg class="envio-icon icon-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
      </svg>
      <div class="envio-titulo">Envío por <span class="highlight">J&T, USPS o iMile</span></div>
    </div>

    <!-- Fecha -->
    <div class="envio-item">
      <svg class="envio-icon icon-gray" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <div class="envio-titulo">Fecha de entrega estimada: <span class="highlight">2 jul – 10 jul</span></div>
    </div>

    <!-- Rastreo -->
    <div class="envio-item">
      <svg class="envio-icon icon-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
      </svg>
      <div class="envio-titulo">Tu pedido será <span class="highlight">rastreado</span> en todo momento</div>
    </div>
  </div>
</div>