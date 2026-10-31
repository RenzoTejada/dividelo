<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/** Obtain an authentication token without leaking errors or credentials to visitors. */
function rt_dividelo_get_token() {
    $url  = get_option( 'dividelo_url', '' );
    $user = get_option( 'dividelo_user_api', '' );
    $pass = get_option( 'dividelo_pass_api', '' );
    if ( ! $url || ! $user || ! $pass || 'https' !== wp_parse_url( $url, PHP_URL_SCHEME ) ) { return ''; }
    $response = wp_remote_post( $url, array(
        'timeout' => 8,
        'redirection' => 0,
        'headers' => array( 'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ), 'Content-Type' => 'application/x-www-form-urlencoded' ),
        'body' => 'grant_type=client_credentials&scope=token%3Aapplication',
    ) );
    if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) { return ''; }
    $body = json_decode( wp_remote_retrieve_body( $response ), true );
    return is_array( $body ) && ! empty( $body['access_token'] ) && is_string( $body['access_token'] ) ? $body['access_token'] : '';
}
function rt_dividelo_render_cta( $amount, $model = '' ) {
    $key = get_option( 'dividelo_subscription_key', '' );
    if ( ! is_numeric( $amount ) || (float) $amount <= 0 || ! $key ) { return ''; }
    $token = rt_dividelo_get_token();
    if ( ! $token ) { return ''; }
    $attrs = array(
        'jwt' => $token,
        'subscription-key' => $key,
        'amount' => wc_format_decimal( $amount ),
        'logo-url' => get_option( 'dividelo_url_logo', '' ),
        'currency' => get_woocommerce_currency(),
    );
    if ( $model ) { $attrs['use-model'] = $model; }
    $html = '<split-payment-cta';
    foreach ( $attrs as $name => $value ) { $html .= ' ' . $name . '="' . esc_attr( $value ) . '"'; }
    return $html . '></split-payment-cta>';
}
function rt_dividelo_price_html( $html, $product ) {
    if ( ! is_product() || ! $product instanceof WC_Product || (int) $product->get_id() !== (int) get_queried_object_id() ) { return $html; }
    return $html . rt_dividelo_render_cta( $product->get_price() );
}
add_filter( 'woocommerce_get_price_html', 'rt_dividelo_price_html', 20, 2 );
add_action( 'wp_enqueue_scripts', function () {
    $src = get_option( 'dividelo_url_digital', '' );
    if ( ! $src || 'https' !== wp_parse_url( $src, PHP_URL_SCHEME ) ) { return; }
    if ( is_product() || ( function_exists( 'is_checkout' ) && is_checkout() ) || ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'order-pay' ) ) ) {
        wp_enqueue_script( 'rt-dividelo-digital', esc_url_raw( $src ), array(), Version_RT_Dividelo, true );
        add_filter( 'script_loader_tag', 'rt_dividelo_module_script', 10, 3 );
    }
} );
function rt_dividelo_module_script( $tag, $handle, $src ) {
    return 'rt-dividelo-digital' === $handle ? '<script type="module" id="split-payment" src="' . esc_url( $src ) . '"></script>' : $tag;
}
add_action( 'woocommerce_review_order_before_submit', function () {
    if ( WC()->cart ) { echo rt_dividelo_render_cta( WC()->cart->get_total( 'edit' ), 'B' ); } // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
} );
add_action( 'after_woocommerce_pay', function ( $order_id = 0 ) {
    $order = $order_id ? wc_get_order( $order_id ) : false;
    if ( $order ) { echo rt_dividelo_render_cta( $order->get_total(), 'B' ); } // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}, 10, 1 );
