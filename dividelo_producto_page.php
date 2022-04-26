<?php

function rt_dividelo_price_html($price_html, $product)
{
    global $woocommerce_loop;

    if (is_product() && !$woocommerce_loop['name'] == 'related') {
        $precio = $product->get_price();
        if ($precio > 0) {
            $url = esc_attr(get_option('dividelo_url'));
            $user = esc_attr(get_option('dividelo_user_api'));
            $pass = esc_attr(get_option('dividelo_pass_api'));
            $base64 = base64_encode($user . ':' . $pass);

            $response = wp_remote_post($url, array(
                    'headers' => array(
                        'Authorization' => 'Basic ' . $base64,
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ),
                    'body' => 'grant_type=client_credentials&scope=token%3Aapplication',
                )
            );

            if (is_wp_error($response)) {
                $error_message = $response->get_error_message();
                return $error_message;
            } else {
                $token = (array)json_decode($response['body']);

                $simbolo = get_woocommerce_currency_symbol();
                switch ($simbolo) {
                    case 'S/.':
                        $currency = 'PEN';
                        break;
                    default:
                        $currency = 'USD';
                        break;
                }
                $price_html = $price_html . '<br><br>
                <split-payment-cta
                  jwt="' . $token['access_token'] . '"
                  subscription-key="' . esc_attr(get_option('dividelo_subscription_key')) . '"
                  amount="' . $precio . '"
                  logo-url="' . esc_attr(get_option('dividelo_url_logo')) . '"
                  currency="' . $currency . '"> 
                </split-payment-cta>
            ';

            }
        }


    }
    return $price_html;
}

add_filter('woocommerce_get_price_html', 'rt_dividelo_price_html', 10, 2);

function rt_dividelo_js_dividelo()
{
    wp_print_script_tag(
        array(
            'id' => 'split-payment',
            'src' => esc_attr(get_option('dividelo_url_digital')),
            'type' => 'module'
        )
    );

}

add_action('wp_enqueue_scripts', 'rt_dividelo_js_dividelo');
