<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los creditos
 *
 *
 */
// HEADER
require Core::view('head', 'core');
// MENU
require Core::view('menu', 'core');
?>

<section class="first-section content" id="main">

	<!-- Main Promo Banner -->
	<div class="container my-3">
		<div class="promo-banner">
			<img src="<?= $config['products_url'] . '/' . $sectionHero['image_section'] ?>" alt="banner-image" class="banner-image">
			<?php if ($session->is_admod == 1) : ?>
				<a href="<?= gLink('admin/edit.section-hero') ?>" class="banner-edit">Editar</a>
			<?php endif; ?>
		</div>
	</div>

	<?php //require Core::view('product.details', 'products'); 
	?>
	<?php require Core::view('carousel-module', 'jerseys'); ?>

	<!-- Contenedor moderno para la descripción del producto -->
	<div class="container my-4">
		<div class="product-description-card">
			<div class="description-header">
				<h5 class="description-title">Descripción</h5>
			</div>
			<div class="description-body">
				<?= $jersey['description'] ?>
			</div>
		</div>
	</div>

	<?php require Core::view('product-module', 'jerseys'); ?>
	<?php require Core::view('trend-module', 'jerseys'); ?>
	<?php require Core::view('review-module', 'jerseys'); ?>
</section>

<style>
	/* Contenedor principal de la descripción */
	.product-description-card {
		padding: 24px;
		margin: 20px 0;
	}

	/* Cabecera del bloque de descripción */
	.description-header {
		padding-bottom: 12px;
		margin-bottom: 18px;
	}

	/* Título de la descripción */
	.description-title {
		font-size: 1.35rem;
		color: #1e293b;
		/* Gris oscuro elegante */
		font-weight: 700;
		margin: 0;
	}

	/* Cuerpo del contenido (Soporta HTML dinámico) */
	.description-body {
		font-size: 1rem;
		color: #475569;
		/* Color de lectura suave */
		font-weight: 400;
	}

	/* Estilos heredados para posibles etiquetas dentro de la descripción dinámica */
	.description-body p {
		margin-bottom: 15px;
	}

	.description-body p:last-child {
		margin-bottom: 0;
	}

	.description-body strong {
		color: #0f172a;
		font-weight: 600;
	}

	/* Por si la descripción incluye listas */
	.description-body ul,
	.description-body ol {
		padding-left: 20px;
		margin-bottom: 15px;
	}

	.description-body li {
		margin-bottom: 6px;
	}
</style>

<!-- Script actualizado para validar tallas antes de enviar el formulario -->
<script>
	$(document).ready(function() {
		// Variables para guardar las tallas seleccionadas
		let selectedSize1 = null;
		let selectedSize2 = null;

		// Crear inputs ocultos para las tallas
		const inputSize1 = $('<input>', {
			type: 'hidden',
			name: 'size_sweater_1',
			id: 'size_sweater_1'
		});

		const inputSize2 = $('<input>', {
			type: 'hidden',
			name: 'size_sweater_2',
			id: 'size_sweater_2'
		});

		// Agregar los inputs al formulario
		$('#purchaseForm').append(inputSize1, inputSize2);
	});
</script>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>