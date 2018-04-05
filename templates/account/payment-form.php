<?php
/**
 * EBANX Account - Payment Form.
 *
 * @author  EBANX
 * @package WooCommerce_EBANX/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="ebanx-account" class="ebanx-payment-container ebanx-language-br">
	<?php require WC_EBANX::get_templates_path() . 'compliance-fields-br.php'; ?>
</div>
