<style>
  .payment-card {
    display: flex;
    justify-content: space-between;
    background: #ffffff;
    border-radius: 8px;
    padding: 16px 20px;
    max-width: 450px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  .payment-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 600;
    color: #1f2937;
  }

  .payment-logos {
    display: flex;
    align-items: center;
    gap: 1px;
  }

  .payment-logos img {
    height: 12px;
    object-fit: contain;
    opacity: 0.9;
  }

  .shipping-box {
    background: #ffffff;
    padding: 14px 0px;
    display: flex;
    align-items: center;
    gap: 12px;
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
    font-weight: 700;
  }
</style>

<div class="payment-card">
  <div class="payment-header">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12 2C9.24 2 7 4.24 7 7v4H6c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-7c0-1.1-.9-2-2-2h-1V7c0-2.76-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3v4H9V7c0-1.66 1.34-3 3-3z" />
    </svg>
    Pago protegido con:
  </div>

  <div class="payment-logos">
    <!-- Reemplaza las URLs a continuación -->
    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Visa_Inc._logo_%282005%E2%80%932014%29.png" alt="Visa" onerror="this.style.display='none'">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/MasterCard_Logo.svg/1280px-MasterCard_Logo.svg.png" alt="Mastercard" onerror="this.style.display='none'">
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/American_Express_logo_%282018%29.svg" alt="American Express" onerror="this.style.display='none'">
    <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Maestro_logo.png" alt="Maestro" onerror="this.style.display='none'">
  </div>
</div>
<!-- Módulo de Envío Estándar -->
<div class="shipping-box">
  <div class="shipping-icon-wrapper">
    <!-- Icono SVG de camión limpio -->
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
      <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
      <circle cx="5.5" cy="18.5" r="2.5" />
      <circle cx="18.5" cy="18.5" r="2.5" />
    </svg>
  </div>
  <p class="shipping-text">
    <strong>Recibe el día 06 de Julio con DHL</strong>
  </p>
</div>