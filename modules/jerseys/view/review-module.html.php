  <?php
  // Datos de las reseñas de clientes (usar de DB o fallback)
  if (empty($reviews)) $reviews = []
  ?>
  <div class="reviews-section-container">
    <div class="stars-header">
      <span class="stars">★★★★★</span>
      <span class="count"><?= count($reviews) ?> Reseñas de Clientes</span>
    </div>

    <div class="reviews-grid">
      <?php foreach ($reviews as $r): ?>
        <div class="review-card">

          <!-- Imagen adjuntada por el cliente (Recortada uniformemente) -->
          <?php if (!empty($r['image_url'])): ?>
            <div class="review-image-wrapper">
              <img
                src="<?= $config['products_url'] . '/' . htmlspecialchars($r['image_url']) ?>" alt="Foto de cliente"
                onclick="openLightbox(this.src)"
                class="review-uploaded-img">
            </div>
          <?php endif; ?>

          <div class="review-body">
            <div class="user-name"><?= htmlspecialchars($r['customer_name'] ?? '') ?></div>
            <div class="stars-rating">
              <?php
              $rating = intval($r['rating'] ?? 5);
              for ($i = 1; $i <= 5; $i++)
              {
                echo '<span class="star ' . ($i <= $rating ? 'filled' : 'empty') . '">★</span>';
              }
              ?>
            </div>

            <p class="comment"><?= htmlspecialchars($r['comment'] ?? '') ?></p>
          </div>

          <?php if (!empty($r['details'])): ?>
            <div class="product-footer">
              <?php if (!empty($r['product_thumb'])): ?>
                <img src="<?= htmlspecialchars($r['product_thumb']) ?>" alt="Miniatura" class="product-thumb">
              <?php endif; ?>
              <div class="product-info-text"><?= htmlspecialchars($r['details']) ?></div>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <style>
    .reviews-section-container {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      padding: 16px;
    }

    .stars-header {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 16px;
      color: #111827;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .stars-header .stars {
      color: #dc2626;
    }

    /* Mínimo 2 columnas garantizadas */
    .reviews-grid {
      display: grid;
      /* Ajuste para 2 columnas en móvil y más en pantallas grandes */
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 16px;
    }

    /* Asegura 2 columnas incluso en pantallas estrechas */
    @media (max-width: 600px) {
      .reviews-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    .review-card {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    /* Imagen uniforme: altura fija y recorte */
    .review-image-wrapper {
      width: 100%;
      height: 150px;
      overflow: hidden;
      background-color: #f3f4f6;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .review-uploaded-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Esto fuerza el recorte manteniendo la proporción */
    }

    .review-body {
      padding: 12px;
      flex-grow: 1;
    }

    .user-name {
      font-size: 13px;
      font-weight: 700;
      color: #111827;
    }

    .date {
      font-size: 10.5px;
      color: #9ca3af;
      margin-bottom: 6px;
    }

    .stars-rating {
      margin-bottom: 8px;
      font-size: 13px;
      color: #dc2626;
    }

    .comment {
      font-size: 11.5px;
      line-height: 1.4;
      color: #374151;
      margin: 0;
    }

    .product-footer {
      border-top: 1px solid #f3f4f6;
      padding: 8px 12px;
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: #fafafa;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    .product-thumb {
      width: 32px;
      height: 32px;
      border-radius: 4px;
      object-fit: cover;
      /* Mantiene miniatura cuadrada */
      flex-shrink: 0;
    }

    .product-info-text {
      font-size: 10px;
      color: #4b5563;
    }
  </style>