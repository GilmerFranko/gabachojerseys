<?php defined('BORDAMEX') || exit;
require Core::view('head', 'core');
?>

<style>
  .status-container {
    max-width: 450px;
    margin: 60px auto;
    padding: 40px 20px;
    background: white;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .icon-wrapper {
    font-size: 80px;
    margin-bottom: 20px;
  }

  .success {
    color: #4caf50;
  }

  .error {
    color: #f44336;
  }

  .status-title {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 10px;
  }

  .status-desc {
    color: #666;
    margin-bottom: 30px;
  }

  .btn-action {
    display: block;
    width: 100%;
    padding: 15px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 10px;
  }
</style>

<div class="status-container">
  <?php if ($paidStatus === 'approved'): ?>
    <div class="icon-wrapper success"><i class="fas fa-check-circle"></i></div>
    <h2 class="status-title">¡Pago Aprobado!</h2>
    <p class="status-desc">Hemos recibido tu pago correctamente. Estamos preparando tu pedido con mucho cuidado.</p>
    <a href="<?= gLink('rastrear', ['order_id' => $pending_order_id]) ?>" class="btn-action" style="background: #1a1a1a; color: white;">Ver pedido</a>
    <a href="https://wa.me/<?= $config['num_phone'] ?>" class="btn-action" style="background: #25d366; color: white;">Contactar por WhatsApp</a>

  <?php else: ?>
    <div class="icon-wrapper error"><i class="fas fa-times-circle"></i></div>
    <h2 class="status-title">Pago Rechazado</h2>
    <p class="status-desc">Hubo un problema procesando tu pago. Por favor contáctanos por WhatsApp para recibir ayuda personalizada.</p>
    <a href="https://wa.me/<?= $config['num_phone'] ?>?text=Hola,%20tengo%20un%20inconveniente%20para%20pagar%20mi%20pedido" class="btn-action" style="background: #25d366; color: white;">Contactar por WhatsApp</a>
  <?php endif; ?>
</div>

<?php require Core::view('footer', 'core'); ?>
