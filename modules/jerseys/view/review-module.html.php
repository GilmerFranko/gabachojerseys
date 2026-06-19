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

        <!-- Imagen adjuntada por el cliente (Estilo Superior compacto) -->
        <?php if (!empty($r['image_url'])): ?>
          <div class="review-image-wrapper">
            <img src="<?= $config['products_url'] . '/' . htmlspecialchars($r['image_url']) ?>" alt="Foto de cliente" class="review-uploaded-img">
          </div>
        <?php endif; ?>

        <div class="review-body">
          <!-- Nombre del Cliente -->
          <div class="user-name"><?= htmlspecialchars($r['customer_name'] ?? '') ?></div>

          <!-- Fecha de la Reseña -->
          <div class="date">
            <?php
            if (is_numeric($r['created_at']))
            {
              echo date('d/m/Y', $r['created_at']);
            }
            elseif (strtotime($r['created_at']) !== false)
            {
              echo date('d/m/Y', strtotime($r['created_at']));
            }
            else
            {
              echo htmlspecialchars($r['created_at'] ?? '');
            }
            ?>
          </div>

          <!-- Estrellas Rojas (Tamaño optimizado) -->
          <div class="stars-rating">
            <?php
            $rating = intval($r['rating'] ?? 5);
            for ($i = 1; $i <= 5; $i++)
            {
              if ($i <= $rating)
              {
                echo '<span class="star filled">★</span>';
              }
              else
              {
                echo '<span class="star empty">☆</span>';
              }
            }
            ?>
          </div>

          <!-- Comentario -->
          <p class="comment"><?= htmlspecialchars($r['comment'] ?? '') ?></p>
        </div>

        <!-- Detalle del Producto Adquirido (Footer más pequeño) -->
        <?php if (!empty($r['details'])): ?>
          <div class="product-footer">
            <?php if (!empty($r['product_thumb'])): ?>
              <img src="<?= htmlspecialchars($r['product_thumb']) ?>" alt="Miniatura" class="product-thumb">
            <?php endif; ?>
            <div class="product-info-text">
              <?= htmlspecialchars($r['details']) ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>
</div>

<style>
  /* Contenedor general de la sección de opiniones */
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
    /* Rojo característico */
  }

  /* Grilla Adaptable de Tarjetas - Tarjetas más compactas (min 180px en vez de 240px) */
  .reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
  }

  /* Estilo de la Tarjeta */
  .review-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .review-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
  }

  /* Altura Reducida de la Imagen del Cliente */
  .review-image-wrapper {
    width: 100%;
    height: 125px;
    /* Más compacta */
    overflow: hidden;
    background-color: #f3f4f6;
  }

  .review-uploaded-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  /* Cuerpo de la reseña con padding más ajustado */
  .review-body {
    padding: 10px 12px;
    flex-grow: 1;
  }

  .user-name {
    font-size: 13px;
    /* Más pequeño y limpio */
    font-weight: 700;
    color: #111827;
    margin-bottom: 1px;
  }

  .date {
    font-size: 10.5px;
    color: #9ca3af;
    margin-bottom: 4px;
  }

  /* Estrellas Rojas Compactas */
  .stars-rating {
    margin-bottom: 6px;
    font-size: 13px;
    line-height: 1;
  }

  .stars-rating .star {
    margin-right: 1px;
  }

  .stars-rating .star.filled {
    color: #dc2626;
  }

  .stars-rating .star.empty {
    color: #dc2626;
  }

  .comment {
    font-size: 11.5px;
    /* Texto de opinión más legible para tamaños pequeños */
    line-height: 1.4;
    color: #374151;
    margin: 0;
  }

  /* Pie de Tarjeta con Producto Comprado */
  .product-footer {
    border-top: 1px solid #f3f4f6;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #fafafa;
  }

  .product-thumb {
    width: 32px;
    /* Miniatura más pequeña */
    height: 32px;
    border-radius: 4px;
    object-fit: cover;
    flex-shrink: 0;
    border: 1px solid #e5e7eb;
  }

  .product-info-text {
    font-size: 10px;
    font-weight: 500;
    color: #4b5563;
    line-height: 1.25;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>