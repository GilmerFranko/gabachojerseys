<?php
$carousels = loadClass('jerseys/carousels')->getAllCarousels();
if (is_array($carousels) && count($carousels) > 0)
{
  $carousel_images = [];
  foreach ($carousels as $carousel)
  {
    $carousel_images[] = $carousel['image_name'];
  }
?>

  <!-- Importación de estilos CSS de Swiper.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /* --- Estructura y Contenedores con CSS Puro --- */
    .carousel-container {
      max-width: 480px;
      width: 100%;
      margin: 0 auto;
      overflow: hidden;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .myImageSwiper {
      border-radius: 8px;
      overflow: hidden;
      position: relative;
    }

    /* --- Estilos de las Diapositivas (Slides) --- */
    .carousel-slide {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .carousel-image {
      width: 300px;
      object-fit: cover;
      user-select: none;
      pointer-events: auto;
      /* Cambiado a auto para habilitar clics/toques */
      cursor: pointer;
      /* Cambia el cursor a mano para indicar que es interactivo */
      display: block;
      transition: opacity 0.2s ease;
    }

    .carousel-image:hover {
      opacity: 0.95;
    }

    /* --- Estado de Respaldo (Sin Imágenes) --- */
    .carousel-empty {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f1f5f9;
      height: 256px;
      width: 100%;
    }

    .carousel-empty-text {
      color: #94a3b8;
      font-weight: 500;
      font-size: 14px;
      margin: 0;
    }

    /* --- Personalización de Swiper (Botones y Paginación) --- */
    .swiper-button-next,
    .swiper-button-prev {
      color: #1e40af !important;
      background: rgba(255, 255, 255, 0.9);
      width: 40px !important;
      height: 40px !important;
      border-radius: 50%;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      transition: background-color 0.2s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      background: rgba(255, 255, 255, 1);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 16px !important;
      font-weight: bold;
    }

    .swiper-pagination-bullet-active {
      background: #2563eb !important;
      width: 24px !important;
      border-radius: 4px !important;
      transition: all 0.3s ease;
    }

    /* --- ESTILOS DEL LIGHTBOX (IMAGEN AMPLIADA) --- */
    .lightbox-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.85);
      backdrop-filter: blur(6px);
      /* Efecto difuminado moderno de fondo */
      -webkit-backdrop-filter: blur(6px);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }

    .lightbox-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }

    .lightbox-image {
      max-width: 90%;
      max-height: 85vh;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
      transform: scale(0.9);
      transition: transform 0.3s ease;
    }

    .lightbox-overlay.active .lightbox-image {
      transform: scale(1);
    }

    .lightbox-close {
      position: absolute;
      top: 20px;
      right: 20px;
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: #ffffff;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      font-size: 24px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }

    .lightbox-close:hover {
      background: rgba(255, 255, 255, 0.3);
    }
  </style>

  <!-- Contenedor del Carrusel -->
  <div class="carousel-container">

    <div class="swiper myImageSwiper">
      <!-- Contenedor de las diapositivas (Slides) -->
      <div class="swiper-wrapper">
        <?php if (!empty($carousel_images)): ?>
          <?php foreach ($carousel_images as $image_url): ?>
            <div class="swiper-slide carousel-slide">
              <img
                src="<?= $config['carousel_url'] . htmlspecialchars($image_url); ?>"
                alt="Imagen de carrusel"
                class="carousel-image"
                onclick="openLightbox(this.src)"
                onerror="this.src='https://placehold.co/800x600?text=Error+al+cargar+imagen'" />
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Vista de respaldo si la variable PHP está vacía -->
          <div class="swiper-slide carousel-empty">
            <p class="carousel-empty-text">No hay imágenes disponibles</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Paginación (Puntitos) -->
      <div class="swiper-pagination"></div>

      <!-- Flechas de navegación -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>

  </div>

  <!-- Estructura del modal Lightbox -->
  <div id="customLightbox" class="lightbox-overlay" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="event.stopPropagation(); closeLightbox();">&times;</button>
    <img id="lightboxImg" class="lightbox-image" src="" alt="Imagen ampliada" onclick="event.stopPropagation();" />
  </div>

  <!-- Carga del archivo JavaScript de Swiper.js -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Inicialización de Swiper y Lógica del Lightbox -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const swiper = new Swiper(".myImageSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        grabCursor: true,

        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },

        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },

        effect: "slide",
        speed: 600
      });
    });

    // Funciones globales para abrir y cerrar la imagen ampliada
    function openLightbox(src) {
      const lightbox = document.getElementById('customLightbox');
      const lightboxImg = document.getElementById('lightboxImg');

      lightboxImg.src = src;
      lightbox.classList.add('active');
      document.body.style.overflow = 'hidden'; // Previene el scroll del fondo
    }

    function closeLightbox() {
      const lightbox = document.getElementById('customLightbox');
      lightbox.classList.remove('active');
      document.body.style.overflow = ''; // Devuelve el scroll del fondo
    }

    // Cerrar también al presionar la tecla Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeLightbox();
      }
    });
  </script>
<?php } ?>