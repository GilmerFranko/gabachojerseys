<?php
// Datos de las reseñas de clientes
$reseñas = [
  [
    'nombre' => 'Eunice D.',
    'fecha' => '16/6/2026',
    'calificacion' => 5,
    'comentario' => 'Sólo el tiempo de envío ya que decía 2 días y llegó después',
    'detalles' => 'XL (Envio Express) / Sin Dorsal / Fan',
    'img_producto' => 'https://images.unsplash.com/photo-1596464716127-f2a89987a8aa?auto=format&fit=crop&w=100&q=80'
  ],
  [
    'nombre' => 'Juan Carlos G.',
    'fecha' => '15/6/2026',
    'calificacion' => 5,
    'comentario' => 'Llegó en tiempo establecido. Buena calidad.',
    'detalles' => 'Fan / Con Dorsal / L',
    'img_producto' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=100&q=80'
  ],
  [
    'nombre' => 'Macaria M.',
    'fecha' => '14/6/2026',
    'calificacion' => 5,
    'comentario' => 'Súper contenta con mis playeras, pronto haré mi tercer pedido!',
    'detalles' => 'S / Con Dorsal / Fan',
    'img_producto' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?auto=format&fit=crop&w=100&q=80'
  ]
];
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
            <span class="user-name"><?= $r['nombre'] ?></span>
            <span class="verified">✔ Verificado</span>
          </div>
          <div class="date"><?= $r['fecha'] ?></div>
          <div class="stars">★★★★★</div>
          <p class="comment"><?= $r['comentario'] ?></p>
          <div class="item-details"><?= $r['detalles'] ?></div>
          <img src="<?= $r['img_producto'] ?>" alt="Producto" class="product-thumb">
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
