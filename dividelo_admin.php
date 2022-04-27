<?php

add_action('admin_menu', 'rt_dividelo_admin_page');

function rt_dividelo_admin_page()
{
    add_submenu_page('woocommerce', 'Configuraciones', 'Divídelo', 'manage_woocommerce', 'rt_dividelo_settings', 'rt_dividelo_submenu_settings_callback');
    add_action('admin_init', 'rt_dividelo_register_settings');
}

function rt_dividelo_register_settings()
{
    register_setting('dividelo_settings_group', 'dividelo_url');
    register_setting('dividelo_settings_group', 'dividelo_user_api');
    register_setting('dividelo_settings_group', 'dividelo_pass_api');
    register_setting('dividelo_settings_group', 'dividelo_url_digital');
    register_setting('dividelo_settings_group', 'dividelo_subscription_key');
    register_setting('dividelo_settings_group', 'dividelo_url_logo');
}

function rt_dividelo_submenu_settings_callback()
{
    wp_enqueue_media();
    wp_enqueue_script('rt-dividelo', plugin_dir_url(__FILE__) . 'js/rt_dividelo.js', array('jquery'), Version_RT_Dividelo, true);
    ?>
    <div class="wrap woocommerce" >
        <div style="background-color:#87b43e;">
        </div>
        <h2><?php _e('Dividelo Settings', 'rt-dividelo-ibk') ?></h2>
        <h2 class="nav-tab-wrapper">
            <a href="?page=rt_dividelo_settings" class="nav-tab  nav-tab-active"><?php _e('Configuration', 'rt-dividelo-ibk') ?></a>
        </h2>
        <form method="post" action="options.php" id="dividelo_formulario">
            <?php settings_fields('dividelo_settings_group'); ?>
            <?php do_settings_sections('dividelo_settings_group'); ?>

            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('Url Api', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_url" id="dividelo_url" style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_url')); ?>"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('ApplicationId / User / ComercioId', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_user_api" id="dividelo_user_api" style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_user_api')); ?>"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('Password Usuario', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_pass_api" id="dividelo_pass_api" style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_pass_api')); ?>"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('Url Digital', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_url_digital" id="dividelo_url_digital" style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_url_digital')); ?>"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('SubscriptionId', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_subscription_key" id="dividelo_subscription_key"
                               style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_subscription_key')); ?>"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label><?php _e('Logo', 'rt-dividelo-ibk') ?></label>
                    </th>
                    <td class="forminp forminp-checkbox">
                        <input type="text" name="dividelo_url_logo" class="dividelo_url_logo" id="dividelo_url_logo" style="width: 500px;"
                               value="<?php echo esc_attr(get_option('dividelo_url_logo')); ?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php submit_button(__('Save Changes', 'rt-dividelo-ibk')); ?>
        </form>
    </div>
    <?php
}