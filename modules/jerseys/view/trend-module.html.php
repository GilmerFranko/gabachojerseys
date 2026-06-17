<style>
  .faq-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    border: 1px solid #e5e7eb;
    max-width: 500px;
    font-family: sans-serif;
  }

  .faq-item {
    border-bottom: 1px solid #f3f4f6;
  }

  .faq-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 0;
    cursor: pointer;
    background: none;
    border: none;
    text-align: left;
  }

  .faq-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    font-weight: 600;
    color: #111827;
  }

  .faq-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
    color: #4b5563;
    font-size: 14px;
    line-height: 1.6;
    padding-bottom: 0;
  }

  .faq-content.open {
    max-height: 200px;
    padding-bottom: 16px;
  }

  .faq-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
  }

  .chevron {
    width: 16px;
    height: 16px;
    transition: transform 0.3s;
  }

  .open .chevron {
    transform: rotate(180deg);
  }

  /* Colores */
  .text-orange {
    color: #f59e0b;
  }

  .text-blue {
    color: #2563eb;
  }

  .text-green {
    color: #166534;
  }

  .text-purple {
    color: #7c3aed;
  }
</style>
<div class="container mt-4">
  <div class="faq-card">
    <!-- Pregunta 1 -->
    <div class="faq-item">
      <button class="faq-header" onclick="toggleFaq(this)">
        <span class="faq-title">
          <svg class="faq-icon text-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          ¿El envío es gratis en todo México?
        </span>
        <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="faq-content">
        Sí, envío <strong>GRATIS</strong>. Entregas en 12–18 días hábiles con seguimiento por correo y WhatsApp.
      </div>
    </div>

    <!-- Pregunta 2 -->
    <div class="faq-item">
      <button class="faq-header" onclick="toggleFaq(this)">
        <span class="faq-title">
          <svg class="faq-icon text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
          ¿Es seguro comprar aquí?
        </span>
        <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="faq-content">
        Sí, +10,000 clientes en México. Pagos seguros y pedido con seguimiento en todo momento.
      </div>
    </div>

    <!-- Pregunta 3 -->
    <div class="faq-item">
      <button class="faq-header" onclick="toggleFaq(this)">
        <span class="faq-title">
          <svg class="faq-icon text-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M7 11V7a5 5 0 0110 0v4M7 11h10M7 11v6a2 2 0 002 2h6a2 2 0 002-2v-6" />
          </svg>
          Fan vs Player
        </span>
        <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="faq-content">
        <strong>Fan:</strong> Ajuste cómodo, tela más resistente, ideal para uso diario.<br>
        <strong>Player:</strong> Ajuste atlético, tecnología ligera con microperforaciones.
      </div>
    </div>

    <!-- Pregunta 4 -->
    <div class="faq-item">
      <button class="faq-header" onclick="toggleFaq(this)">
        <span class="faq-title">
          <svg class="faq-icon text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          Cambios
        </span>
        <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div class="faq-content">
        ¡Espera con tranquilidad! Si tu pedido llega defectuoso, puedes solicitar una nueva gratis.
      </div>
    </div>
  </div>
</div>

<script>
  function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const isOpening = !content.classList.contains('open');

    // Cierra los otros
    document.querySelectorAll('.faq-content').forEach(c => c.classList.remove('open'));

    if (isOpening) {
      content.classList.add('open');
    }
  }
</script>
