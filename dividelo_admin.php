<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'admin_menu', function () {
    add_submenu_page( 'woocommerce', 'Divídelo · Ajustes', 'Divídelo', 'manage_woocommerce', 'rt_dividelo_settings', 'rt_dividelo_submenu_settings_callback' );
} );
add_action( 'admin_init', function () {
    foreach ( array( 'dividelo_url', 'dividelo_user_api', 'dividelo_pass_api', 'dividelo_url_digital', 'dividelo_subscription_key', 'dividelo_url_logo' ) as $key ) {
        register_setting( 'dividelo_settings_group', $key, array( 'sanitize_callback' => in_array( $key, array( 'dividelo_url', 'dividelo_url_digital', 'dividelo_url_logo' ), true ) ? 'esc_url_raw' : 'sanitize_text_field' ) );
    }
} );
function rt_dividelo_submenu_settings_callback() {
    if ( ! current_user_can( 'manage_woocommerce' ) ) { return; }
    wp_enqueue_media();
    wp_enqueue_script( 'rt-dividelo', plugin_dir_url( __FILE__ ) . 'js/rt_dividelo.js', array( 'jquery' ), Version_RT_Dividelo, true );
    $fields = array(
        'dividelo_url' => array( 'URL de la API', 'Endpoint HTTPS de autenticación proporcionado por Interbank.', 'url' ),
        'dividelo_user_api' => array( 'Application ID / Comercio ID', 'Identificador asignado al comercio.', 'text' ),
        'dividelo_pass_api' => array( 'Contraseña de la API', 'Se conserva guardada; deja este campo en blanco para no modificarla.', 'password' ),
        'dividelo_url_digital' => array( 'URL del componente digital', 'Dirección HTTPS del script oficial de Divídelo.', 'url' ),
        'dividelo_subscription_key' => array( 'Subscription Key', 'Clave de suscripción proporcionada por el proveedor.', 'text' ),
        'dividelo_url_logo' => array( 'Imagen / logotipo del simulador', 'Selecciona una imagen desde la biblioteca de medios o pega su URL.', 'url' ),
    );
    ?>
    <div class="wrap rt-dividelo-wrap">
      <style>
      .rt-dividelo-wrap{max-width:1050px}.rt-dv-header,.rt-dv-card{background:#fff;border:1px solid #dcdcde;border-radius:12px;padding:24px;margin-top:18px;box-shadow:0 1px 2px #00000006}
      .rt-dv-header{border-top:4px solid #56b15d;display:flex;justify-content:space-between;align-items:center;gap:18px}.rt-dv-header h1{font-size:25px;margin:0 0 7px}.rt-dv-header p{margin:0;color:#57606a}.rt-dv-brand{font-weight:600;color:#235c2d}.rt-dv-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}.rt-dv-field{margin:0 0 19px}.rt-dv-field label{display:block;font-weight:600;margin-bottom:7px}.rt-dv-field input{width:100%;max-width:100%;min-height:39px}.rt-dv-field .description{margin:5px 0 0;color:#626b75;font-size:12px}.rt-dv-card h2{margin:0 0 18px}.rt-dv-note{background:#f0f6f0;border-left:3px solid #56b15d;padding:12px 15px;margin:16px 0}.rt-dv-image{display:flex;gap:8px}.rt-dv-image input{flex:1}.rt-dv-image .button{white-space:nowrap}.rt-dv-actions{margin:20px 0}.rt-dv-link{display:inline-block;margin-left:12px}@media(max-width:782px){.rt-dv-grid{grid-template-columns:1fr}.rt-dv-header{display:block}.rt-dv-brand{margin-top:10px}.rt-dv-image{flex-wrap:wrap}}
      </style>
      <div class="rt-dv-header"><div><h1>Divídelo para WooCommerce</h1><p>Configura el simulador de cuotas de Interbank para tu tienda.</p></div><div class="rt-dv-brand">Renzo Tejada · Web Developer<br><small>Versión <?php echo esc_html( Version_RT_Dividelo ); ?></small></div></div>
      <div class="rt-dv-card"><h2>Configuración de la integración</h2><p class="rt-dv-note">Utiliza exclusivamente las credenciales y URLs facilitadas por Interbank. El simulador requiere conectividad con su API y componente oficial.</p>
      <form method="post" action="options.php">
      <?php settings_fields( 'dividelo_settings_group' ); ?>
      <div class="rt-dv-grid">
      <?php foreach ( $fields as $key => $field ) : ?>
      <div class="rt-dv-field"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label>
      <div class="<?php echo 'dividelo_url_logo' === $key ? 'rt-dv-image' : ''; ?>">
      <input id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" type="<?php echo esc_attr( $field[2] ); ?>" value="<?php echo 'dividelo_pass_api' === $key ? '' : esc_attr( get_option( $key, '' ) ); ?>" <?php echo 'dividelo_url_logo' === $key ? 'class="dividelo_url_logo"' : ''; ?> autocomplete="off" />
      <?php if ( 'dividelo_url_logo' === $key ) : ?><button type="button" class="button rt-dividelo-pick-logo">Elegir imagen</button><?php endif; ?>
      </div><p class="description"><?php echo esc_html( $field[1] ); ?></p></div>
      <?php endforeach; ?>
      </div><?php submit_button( 'Guardar cambios' ); ?>
      </form></div>
      <div class="rt-dv-card"><h2>Ayuda y soporte</h2><p>Verifica la configuración primero en una tienda de pruebas. El importe de las cuotas es calculado por el componente del proveedor.</p><a class="button" href="<?php echo esc_url( 'https://renzotejada.com/contacto/' ); ?>" target="_blank" rel="noopener noreferrer">Contacto y soporte</a></div>
    </div>
    <?php
}
// Mantener la contraseña anterior si se deja vacía.
add_filter( 'pre_update_option_dividelo_pass_api', function ( $value, $old_value ) { return '' === $value ? $old_value : $value; }, 10, 2 );
