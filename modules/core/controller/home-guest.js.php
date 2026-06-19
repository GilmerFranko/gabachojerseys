<script>
  // Funciones globales para abrir y cerrar la imagen ampliada
  function openLightbox(src) {
    const lightbox = document.getElementById("customLightbox");
    const lightboxImg = document.getElementById("lightboxImg");

    lightboxImg.src = src;
    lightbox.classList.add("active");
    document.body.style.overflow = "hidden"; // Previene el scroll del fondo
  }

  function closeLightbox() {
    const lightbox = document.getElementById("customLightbox");
    lightbox.classList.remove("active");
    document.body.style.overflow = ""; // Devuelve el scroll del fondo
  }

  // Cerrar también al presionar la tecla Escape
  document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") {
      closeLightbox();
    }
  });
</script>