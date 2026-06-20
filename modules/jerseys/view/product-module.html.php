<div class="container px-0 my-4">
  <div class="product-selection-card">
    <form id="purchaseForm" action="<?= gLink('jerseys/process.purchase') ?>" method="GET">
      <input type="hidden" name="jersey_id" value="<?= $jersey['id'] ?>">
      <div class="jersey-section">
        <h2 class="section-title">Selecciona Jersey 1</h2>
        <div class="gallery">
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 1)">
            <img id="jersey1-img1" src="<?= $config['products_url'] . $jersey['jersey1_model1'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 2)">
            <img id="jersey1-img2" src="<?= $config['products_url'] . $jersey['jersey1_model2'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 3)">
            <img id="jersey1-img3" src="<?= $config['products_url'] . $jersey['jersey1_model3'] ?>" class="image-option">
          </div>
        </div>

        <label class="size-label">Selecciona tu talla Jersey 1:</label>
        <div class="size-grid">
          <?php foreach ($jersey1_sizes as $size) : ?>
            <button type="button" class="size-btn" onclick="selectSize(this, 'jersey1', '<?= $size ?>')"><?= $size ?></button>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="jersey1_size" id="jersey1_size" value="">
        <input type="hidden" name="jersey1_model" id="jersey1_model" value="">
      </div>

      <div class="jersey-section">
        <h2 class="section-title">Selecciona Jersey 2</h2>
        <div class="gallery">
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 1)">
            <img id="jersey2-img1" src="<?= $config['products_url'] . $jersey['jersey2_model1'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 2)">
            <img id="jersey2-img2" src="<?= $config['products_url'] . $jersey['jersey2_model2'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 3)">
            <img id="jersey2-img3" src="<?= $config['products_url'] . $jersey['jersey2_model3'] ?>" class="image-option">
          </div>
        </div>

        <label class="size-label">Selecciona tu talla Jersey 2:</label>
        <div class="size-grid">
          <?php foreach ($jersey2_sizes as $size) : ?>
            <button type="button" class="size-btn" onclick="selectSize(this, 'jersey2', '<?= $size ?>')"><?= $size ?></button>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="jersey2_size" id="jersey2_size" value="">
        <input type="hidden" name="jersey2_model" id="jersey2_model" value="">
      </div>

      <hr>

      <button type="submit" class="submit-btn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="white"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
          <path d="M256 144C256 108.7 284.7 80 320 80C355.3 80 384 108.7 384 144L384 192L256 192L256 144zM208 192L144 192C117.5 192 96 213.5 96 240L96 448C96 501 139 544 192 544L448 544C501 544 544 501 544 448L544 240C544 213.5 522.5 192 496 192L432 192L432 144C432 82.1 381.9 32 320 32C258.1 32 208 82.1 208 144L208 192zM232 240C245.3 240 256 250.7 256 264C256 277.3 245.3 288 232 288C218.7 288 208 277.3 208 264C208 250.7 218.7 240 232 240zM384 264C384 250.7 394.7 240 408 240C421.3 240 432 250.7 432 264C432 277.3 421.3 288 408 288C394.7 288 384 277.3 384 264z" />
        </svg>
        Realizar Compra</button>
    </form>
    <?php require Core::view('payment.notice-module', 'jerseys') ?>
    <div class="container my-3">
      <div class="promo-banner">
        <a href="https://wa.me/<?= $config['num_phone'] ?>?text=Hola,%20quiero%20comprar%20mayoreo" target="_blank">
          <img src="<?= $config['images_url'] . '/' . 'compra-mayoreo.jpeg' ?>" alt="compra-mayoreo" class="banner-image">
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  .product-selection-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    /* border: 1px solid #e5e7eb; */
    max-width: 500px;
    font-family: sans-serif;
  }

  .jersey-section {
    margin-bottom: 24px;
  }

  .section-title {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
  }

  .size-label {
    font-size: 13px;
    font-weight: 600;
    color: #6b7280;
    display: block;
    margin-bottom: 10px;
  }

  .gallery {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
  }

  .image-option {
    width: 95px;
    height: 95px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    transition: 0.2s;
  }

  .image-option.active {
    border-color: #111;
  }

  .size-grid {
    display: flex;
    gap: 6px;
  }

  .size-btn {
    flex: 1;
    padding: 8px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    background: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
  }

  .size-btn.active {
    background: #111;
    color: white;
    border-color: #111;
  }

  hr {
    border: 0;
    border-top: 1px solid #f3f4f6;
    margin: 24px 0;
  }

  .submit-btn {
    width: 100%;
    padding: 10px 0;
    font-size: 25px;
    background: #196d6a;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 20px;
  }

  .submit-btn:hover {
    background: #177f7b;
  }

  .submit-btn svg {
    width: 48px;
    /* height: 1.1em; */
    vertical-align: middle;
    flex-shrink: 0;
  }
</style>

<script>
  // Validación al enviar el formulario
  document.getElementById('purchaseForm').addEventListener('submit', function(e) {
    const fields = [{
        id: 'jersey1_size',
        name: 'Talla Jersey 1'
      },
      {
        id: 'jersey1_model',
        name: 'Modelo Jersey 1'
      },
      {
        id: 'jersey2_size',
        name: 'Talla Jersey 2'
      },
      {
        id: 'jersey2_model',
        name: 'Modelo Jersey 2'
      }
    ];

    for (let field of fields) {
      if (!document.getElementById(field.id).value) {
        alert('Por favor, selecciona ' + field.name + ' antes de continuar.');
        e.preventDefault(); // Detiene el envío
        return false; // Detiene la ejecución del bucle
      }
    }
  });

  function selectImage(jersey, index) {
    // Busca la sección contenedora usando el pseudoclase :has
    const section = document.querySelector(`.jersey-section:has(#${jersey}_model)`);
    section.querySelectorAll('.image-option').forEach(img => img.classList.remove('active'));
    document.getElementById(`${jersey}-img${index}`).classList.add('active');
    document.getElementById(`${jersey}_model`).value = index;
  }

  function selectSize(btn, jersey, size) {
    const parent = btn.parentElement;
    parent.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(`${jersey}_size`).value = size;
  }
</script>