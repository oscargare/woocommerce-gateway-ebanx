<?php
/**
 * Credit Card - Payment processed.
 *
 * @author  EBANX.com
 * @package WooCommerce_EBANX/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="ebanx-thank-you-page ebanx-thank-you-page--ar ebanx-thank-you-page--cc-ar">
	<?php if ( $instalments_number > 1 ) : ?>
		<p><strong><?php echo esc_html( $customer_name ); ?> tu pago de <?php echo esc_html( $total ); ?>, dividido en <span id="ebanx-instalment-number"><?php echo esc_html( $instalments_number ); ?> meses de <?php echo esc_html( $instalments_amount ); ?>, fue aprobado</strong></p>
	<?php else : ?>
		<p><strong><?php echo $customer_name; ?> tu pago de <?php echo $total; ?>, en una sola exibición, fue aprobado o/</strong></p>
	<?php endif ?>

	<p>Se tienes alguna duda en relación a tu pago, ingresa a la Cuenta EBANX con el email <?php echo $customer_email; ?></p>
	<input type="hidden" id="ebanx-payment-hash" data-doraemon-hash="<?php echo esc_html( $hash ); ?>">
</div>
