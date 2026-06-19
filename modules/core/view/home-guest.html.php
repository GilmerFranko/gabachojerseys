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

	<?php require Core::view('product-module', 'jerseys'); ?>
	<?php require Core::view('trend-module', 'jerseys'); ?>
	<?php require Core::view('review-module', 'jerseys'); ?>
</section>



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