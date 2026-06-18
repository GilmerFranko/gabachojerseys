<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Plantilla de correo para la confirmación de un nuevo pedido
 *
 */
$script_name = Core::config('script_name');
$year = date('Y');
$base_url = Core::config('base_url');

// Parámetros esperados en $params:
// $params['order'] -> Datos del pedido (id, customer_name, customer_whatsapp, total_amount, shipping_address, shipping_city, shipping_state, shipping_method, estimated_delivery)
// $params['items'] -> Items del pedido (contiene jersey1_model, jersey1_size, jersey2_model, jersey2_size, jersey1_img_url, jersey2_img_url)

$order = $params['order'];
$item = $params['items'][0] ?? [];

$orderId = $order['id'] ?? '---';
$customerName = htmlspecialchars($order['customer_name'] ?? 'Cliente');
$totalAmount = number_format($order['total_amount'] ?? 0, 2);
$shippingMethod = htmlspecialchars($order['shipping_method'] ?? 'N/A');
$shippingAddress = htmlspecialchars($order['shipping_address'] ?? '');
$shippingCity = htmlspecialchars($order['shipping_city'] ?? '');
$shippingState = htmlspecialchars($order['shipping_state'] ?? '');
$estimatedDelivery = htmlspecialchars($order['estimated_delivery'] ?? '');

$jersey1_size = htmlspecialchars($item['jersey1_size'] ?? 'N/A');
$jersey2_size = htmlspecialchars($item['jersey2_size'] ?? 'N/A');

$jersey1_img = !empty($item['jersey1_img_url']) ? $item['jersey1_img_url'] : $base_url . '/static/images/logo/logo2/product.jpg';
$jersey2_img = !empty($item['jersey2_img_url']) ? $item['jersey2_img_url'] : $base_url . '/static/images/logo/logo2/product.jpg';

$trackingLink = gLink('rastrear', ['order_id' => $orderId]);
$whatsappLink = 'https://wa.me/' . preg_replace('/[^0-9]/', '', Core::config('num_phone')) . '?text=' . urlencode("Hola, acabo de realizar mi pedido #" . $orderId . " y me gustaría confirmar mi pago.");

$subject = 'Confirmación de Pedido #' . $orderId . ' - ' . $script_name;

$content = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="es">
    <title>Confirmaci&oacute;n de Pedido #{$orderId}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .header {
            background-color: #161616;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #ceffb6;
            font-weight: 600;
        }
        .body-content {
            padding: 30px 25px;
        }
        .welcome-text {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .order-summary-box {
            background-color: #f9f9f9;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .order-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .order-row:last-child {
            margin-bottom: 0;
            padding-top: 10px;
            border-top: 1px dashed #e5e7eb;
        }
        .label {
            color: #666666;
            font-weight: 500;
        }
        .value {
            font-weight: 700;
            color: #111111;
        }
        .total-price {
            font-size: 18px;
            color: #1ea800;
        }
        .jerseys-section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            border-bottom: 2px solid #f4f7f6;
            padding-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .jersey-grid {
            display: flex;
            gap: 15px;
        }
        .jersey-card {
            flex: 1;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            background: #ffffff;
        }
        .jersey-img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 8px;
        }
        .jersey-title {
            font-size: 13px;
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
        }
        .jersey-meta {
            font-size: 12px;
            color: #666666;
        }
        .shipping-box {
            background-color: #f4f7f6;
            border-radius: 12px;
            padding: 15px;
            font-size: 13px;
            margin-bottom: 25px;
        }
        .shipping-box p {
            margin: 0 0 5px 0;
        }
        .shipping-box p:last-child {
            margin-bottom: 0;
        }
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #1ea800;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(30, 168, 0, 0.25);
            transition: all 0.3s ease;
        }
        .btn-whatsapp {
            background-color: #25d366;
            box-shadow: 0 4px 10px rgba(37, 211, 102, 0.25);
            margin-left: 10px;
        }
        .footer {
            background-color: #f4f7f6;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .footer a {
            color: #1ea800;
            text-decoration: none;
            font-weight: 600;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>&iexcl;Gracias por tu Pedido!</h1>
            <p>PEDIDO #{$orderId}</p>
        </div>
        <div class="body-content">
            <div class="welcome-text">Hola, {$customerName}:</div>
            <p>Tu pedido ha sido registrado con &eacute;xito y ya se encuentra en nuestro sistema. A continuaci&oacute;n te compartimos los detalles de tu compra:</p>
            
            <div class="order-summary-box">
                <div class="order-row">
                    <span class="label">Pedido:</span>
                    <span class="value">#{$orderId}</span>
                </div>
                <div class="order-row">
                    <span class="label">M&eacute;todo de Env&iacute;o:</span>
                    <span class="value">{$shippingMethod}</span>
                </div>
                <div class="order-row">
                    <span class="label">Fecha Est. de Entrega:</span>
                    <span class="value">{$estimatedDelivery}</span>
                </div>
                <div class="order-row">
                    <span class="label">Total de la Orden:</span>
                    <span class="value total-price">\${$totalAmount}</span>
                </div>
            </div>

            <div class="jerseys-section">
                <div class="section-title">Tus Jerseys Seleccionados</div>
                <div class="jersey-grid">
                    <div class="jersey-card">
                        <img src="{$jersey1_img}" alt="Jersey 1" class="jersey-img">
                        <span class="jersey-title">Jersey 1</span>
                        <span class="jersey-meta">Talla: {$jersey1_size}</span>
                    </div>
                    <div class="jersey-card">
                        <img src="{$jersey2_img}" alt="Jersey 2" class="jersey-img">
                        <span class="jersey-title">Jersey 2</span>
                        <span class="jersey-meta">Talla: {$jersey2_size}</span>
                    </div>
                </div>
            </div>

            <div class="section-title">Direcci&oacute;n de Env&iacute;o</div>
            <div class="shipping-box">
                <p><strong>{$customerName}</strong></p>
                <p>{$shippingAddress}</p>
                <p>{$shippingCity}, {$shippingState}</p>
            </div>

            <div class="btn-container">
                <a href="{$trackingLink}" class="btn">Rastrear Pedido</a>
                <a href="{$whatsappLink}" class="btn btn-whatsapp">Confirmar en WhatsApp</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {$year} {$script_name} - Todos los derechos reservados.</p>
            <p><a href="{$base_url}">Visitar nuestro sitio</a></p>
        </div>
    </div>
</body>
</html>
HTML;
