<?php
// Datos de las reseñas de clientes (usar de DB o fallback)
if (!isset($reviews) || empty($reviews)) {
  $reseñas = [
    [
      'customer_name' => 'Eunice D.',
      'created_at' => '16/6/2026',
      'rating' => 5,
      'comment' => 'Sólo el tiempo de envío ya que decía 2 días y llegó después',
      'details' => 'XL (Envio Express) / Sin Dorsal / Fan',
      'image_url' => 'https://images.unsplash.com/photo-1596464716127-f2a89987a8aa?auto=format&fit=crop&w=100&q=80'
    ],
    [
      'customer_name' => 'Juan Carlos G.',
      'created_at' => '15/6/2026',
      'rating' => 5,
      'comment' => 'Llegó en tiempo establecido. Buena calidad.',
      'details' => 'Fan / Con Dorsal / L',
      'image_url' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=100&q=80'
    ],
    [
      'customer_name' => 'Macaria M.',
      'created_at' => '14/6/2026',
      'rating' => 5,
      'comment' => 'Súper contenta con mis playeras, pronto haré mi tercer pedido!',
      'details' => 'S / Con Dorsal / Fan',
      'image_url' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?auto=format&fit=crop&w=100&q=80'
    ]
  ];
} else {
  $reseñas = $reviews;
}
?>
<div class="container px-0 my-4">
  <div class="reviews-container">
    <div class="stars-header">
      <span class="stars">★★★★★</span>
      <span class="count">812 Reseñas</span>
    </div>

    <div class="reviews-grid">
      <?php foreach ($reseñas as $r): ?>
        <div class="review-card">
          <div class="review-header">
            <span class="user-name"><?= htmlspecialchars($r['customer_name'] ?? '') ?></span>
            <span class="verified">✔ Verificado</span>
          </div>
          <div class="date">
            <?php 
              // Formatear fecha si viene de timestamp de DB
              if (is_numeric($r['created_at'])) {
                echo date('d/m/Y', $r['created_at']);
              } elseif (strtotime($r['created_at']) !== false) {
                echo date('d/m/Y', strtotime($r['created_at']));
              } else {
                echo htmlspecialchars($r['created_at'] ?? '');
              }
            ?>
          </div>
          <div class="stars">
            <?php 
              $rating = intval($r['rating'] ?? 5);
              echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
            ?>
          </div>
          <p class="comment"><?= htmlspecialchars($r['comment'] ?? '') ?></p>
          <?php if (!empty($r['details'])): ?>
            <div class="item-details"><?= htmlspecialchars($r['details']) ?></div>
          <?php endif; ?>
          <?php if (!empty($r['image_url'])): ?>
            <img src="<?= htmlspecialchars($r['image_url']) ?>" alt="Producto" class="product-thumb">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<style>
  .reviews-container {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    max-width: 500px;
    font-family: sans-serif;
  }

  .stars-header {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .stars {
    color: #f59e0b;
    letter-spacing: -2px;
  }

  .reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
  }

  .review-card {
    padding: 15px;
    border: 1px solid #f3f4f6;
    border-radius: 8px;
    font-size: 13px;
  }

  .user-name {
    font-weight: 700;
    display: block;
  }

  .verified {
    font-size: 10px;
    color: #6b7280;
  }

  .date {
    color: #9ca3af;
    font-size: 11px;
    margin: 4px 0;
  }

  .comment {
    margin: 8px 0;
    color: #374151;
    line-height: 1.4;
  }

  .item-details {
    color: #6b7280;
    font-size: 11px;
    margin-bottom: 10px;
  }

  .product-thumb {
    width: 40px;
    height: 40px;
    border-radius: 4px;
    object-fit: cover;
  }
</style>
