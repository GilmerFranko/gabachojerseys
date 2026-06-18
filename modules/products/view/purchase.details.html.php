<?php defined('BORDAMEX') || exit;

/**
 *=======================================================* BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Extensión de la vista de detalles de un producto
 *
 */

$jersey1_model_selected = $jersey['jersey1_model' . $jersey1_model];
$jersey2_model_selected = $jersey['jersey2_model' . $jersey2_model];
$jersey1_size_selected = $jersey1_size;
$jersey2_size_selected = $jersey2_size;
?>

<div class="bmx-purchase-card mb-4">
  <div class="product-detail-card">
    <!-- Header Minimalista -->
    <div class="header-section">
      <h1 class="title">Detalles de tu Pedido</h1>
      <p class="subtitle">Confirmación de tus 2 Jerseys</p>
    </div>

    <!-- Contenedor de Jerseys -->
    <div class="jerseys-preview">
      <div class="jersey-item">
        <img src="<?= $config['products_url'] . $jersey1_model_selected ?>" alt="Jersey 1" class="jersey-img">
        <div class="jersey-info">
          <strong>Jersey 1</strong>
          <span>Talla: <?= htmlspecialchars($jersey1_size) ?></span>
        </div>
      </div>
      <div class="jersey-item">
        <img src="<?= $config['products_url'] . $jersey2_model_selected ?>" alt="Jersey 2" class="jersey-img">
        <div class="jersey-info">
          <strong>Jersey 2</strong>
          <span>Talla: <?= htmlspecialchars($jersey2_size) ?></span>
        </div>
      </div>
    </div>

    <!-- Beneficios (Simplificados) -->
    <div class="features-section">
      <div class="feature"><small>✈️ ENVÍO GRATIS</small></div>
      <div class="feature"><small>🛡️ PAGO SEGURO</small></div>
    </div>

    <!-- Pagos -->
    <div class="payment-section">
      <div class="payment-icons">
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Visa_Inc._logo_%282005%E2%80%932014%29.png" alt="Visa">
        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/66/Oxxo_Logo.svg" alt="OXXO">
      </div>
    </div>
  </div>
</div>

<style>
  .product-detail-card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    max-width: 400px;
    margin: 20px auto;
    font-family: sans-serif;
  }

  .header-section {
    text-align: center;
    margin-bottom: 20px;
  }

  .title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #111;
  }

  .subtitle {
    font-size: 0.9rem;
    color: #666;
  }

  .jerseys-preview {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
  }

  .jersey-item {
    flex: 1;
    text-align: center;
  }

  .jersey-img {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 8px;
    border: 1px solid #eee;
  }

  .jersey-info {
    font-size: 0.85rem;
    color: #333;
  }

  .jersey-info strong {
    display: block;
  }

  .features-section {
    display: flex;
    justify-content: space-around;
    padding: 15px 0;
    border-top: 1px solid #f3f4f6;
    border-bottom: 1px solid #f3f4f6;
    margin-bottom: 20px;
  }

  .feature {
    font-weight: 600;
    color: #444;
  }

  .payment-section {
    text-align: center;
  }

  .payment-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
    opacity: 0.6;
  }

  .payment-icons img {
    height: 20px;
    object-fit: contain;
  }
</style>
