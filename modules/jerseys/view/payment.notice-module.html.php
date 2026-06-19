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