<?php

if (!defined('ABSPATH')) {
    exit;
}

class WC_EBANX_Safetypay_Gateway extends WC_EBANX_Redirect_Gateway
{

    public function __construct()
    {
        $this->id           = 'ebanx-safetypay';
        $this->method_title = __('EBANX - Safetypay', 'woocommerce-gateway-ebanx');

        $this->title       = __('SafetyPay', 'woocommerce-gateway-ebanx');
        $this->description = __('Paga con SafetyPay.', 'woocommerce-gateway-ebanx');

        parent::__construct();

        $this->enabled = is_array($this->configs->settings['peru_payment_methods']) ? in_array($this->id, $this->configs->settings['peru_payment_methods']) ? 'yes' : false : false;
    }

    public function is_available()
    {
        return parent::is_available() && ($this->getTransactionAddress('country') == WC_EBANX_Gateway_Utils::COUNTRY_PERU);
    }

    /**
     * TODO: ??
     * Admin page.
     */
    /*public function admin_options() {
    include dirname( __FILE__ ) . '/admin/views/notices/html-notice-country-not-supported.php';
    }*/

    public static function thankyou_page($order)
    {
        $order = wc_get_order($order);
        $data  = get_post_meta($order, '_wc_ebanx_transaction_data', true);

        // TODO: how do this?

        wc_get_template(
            'safetypay/payment-instructions.php',
            array(
                'title'       => $this->title,
                'description' => $this->description,
            ),
            'woocommerce/ebanx/',
            WC_EBANX::get_templates_path()
        );
    }

    public function payment_fields()
    {
        if ($description = $this->get_description()) {
            echo wp_kses_post(wpautop(wptexturize($description)));
        }

        $cart_total = $this->get_order_total();

        wc_get_template(
            'safetypay/payment-form.php',
            array(
                'language' => $this->language,
                'title'       => $this->title,
                'description' => $this->description,
            ),
            'woocommerce/ebanx/',
            WC_EBANX::get_templates_path()
        );
    }

    protected function request_data($order)
    {
        if (!isset($_POST['safetypay']) || !in_array($_POST['safetypay'], WC_EBANX_Gateway_Utils::$TYPES_SAFETYPAY_ALLOWED)) {
            throw new Exception('INVALID-SAFETYPAY-TYPE');
        }

        $data = parent::request_data($order);

        $data['payment']['payment_type_code'] = 'safetypay-' . $_POST['safetypay'];

        return $data;
    }
}
