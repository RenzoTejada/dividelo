=== Divídelo para WooCommerce ===
Contributors: renzotejada, huakotech, alexistejada
Tags: divídelo, interbank, cuota, peru
Requires at least: 5.2
Tested up to: 7.1.4
Stable tag: 1.3.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Este plugin integra el componente de simulación de cuotas Divídelo de Interbank en páginas de producto y el checkout clásico de WooCommerce. Requiere credenciales y acceso al servicio facilitados por Interbank.

== Description ==

This **Divídelo** plugin adds the installment simulation component for Interbank's exclusive clients.

You will find the same information in the plugin's readme.txt and on our website **https://renzotejada.com**.


= View more plugins =

For additional functionality, check out our companion plugin, such as:

* [Ubigeo Perú](https://wordpress.org/plugins/ubigeo-peru/)
* [Libro de Reclamaciones y Quejas](https://wordpress.org/plugins/libro-de-reclamaciones-y-quejas/)
* [Comprobante de Pago Perú](https://wordpress.org/plugins/comprobante-de-pago-peru/)
* [Tipo Documento Perú](https://wordpress.org/plugins/tipo-documento-peru/)
* [Transferencia Bancaria Perú](https://wordpress.org/plugins/transferencia-bancaria-peru/)
* [Utils para WooCommerce y WordPress](https://wordpress.org/plugins/wp-utils/)
* [Multi Link in Bio](https://wordpress.org/plugins/multi-link-in-bio/)
* [Display Price Free](https://wordpress.org/plugins/display-price-free/)
* [Recojo por otra persona](https://wordpress.org/plugins/recojo-por-otra-persona/)

= View more plugins PREMIUM =

* [Costo de envío de Ubigeo Perú](https://renzotejada.com/plugin/costo-de-envio-de-ubigeo-de-peru-para-woocommerce/)
* [Libro de Reclamaciones y Quejas PRO](https://renzotejada.com/plugin/libro-de-reclamaciones-y-quejas-pro/)
* [WooYape para WooCommerce](https://renzotejada.com/plugin/wooyape-para-woocommerce/)
* [WooLukita para WooCommerce](https://renzotejada.com/plugin/woolukita-para-woocommerce/)
* [WooPlin para WooCommerce](https://renzotejada.com/plugin/wooplin-para-woocommerce/)
* [WooTunki para WooCommerce](https://renzotejada.com/plugin/wootunki-para-woocommerce/)
* [WooBilletera para WooCommerce](https://renzotejada.com/plugin/woobilletera-para-woocommerce/)
* [Comprobante de Pago Perú PRO para WooCommerce](https://renzotejada.com/plugins/comprobante-de-pago-peru-pro-para-woocommerce/)


Visit our [plugins overview page](https://renzotejada.com/categoria-producto/plugins/) for more information.

== Installation ==

Automatic installation
1. Plugin admin panel and add new option.
2. Search in the common dividelo box.
3. Placed in the description of this plugin and select install.
4. Activate the plugin from the WordPress administration panel.

ZIP files Installation manual
1. Download the ZIP file from this screen.
2. Select the add plugin option from the admin panel.
3. Select the heavy load option and select the downloaded file.
4. Confirm Installation and activation plugin from the administration panel.

Manual FTP installation
1. Download the ZIP file from this screen and unzip.
2. Go to your FTP folder on your web server.
3. Copy the directory dividelo into the following address wp-content/plugins/
4. Activate the plugin from the WordPress administration panel.


== Frequently Asked Questions ==

= Where did you get the data for dividelo? =

The information was obtained from the following urls:
  a. https://developers-qa.digital.interbank.pe/#/docs/ui/dividelo/?tab=0


== Upgrade Notice ==

= 1.3.0 =
Actualización del panel y manejo de errores de la API. Revisa tus credenciales y prueba el simulador con el servicio de Interbank antes de usarlo en producción. No se eliminan opciones almacenadas.

== Changelog ==

= 1.3.0 (30/10/2026) =
* Interfaz administrativa renovada con campos adaptables y selección de imagen.
* Conserva las seis claves de configuración existentes.
* Ajusta el acceso a las credenciales y valida las respuestas HTTP y JSON.
* Evita errores al faltar el carrito y reduce la carga del script en páginas no relacionadas.
* Utiliza las APIs modernas de productos y pedidos de WooCommerce cuando corresponde.
* No se declara compatibilidad completa con Checkout Blocks, pendiente de integración específica.
* Compatibilidad objetivo WordPress 7.1.4 y WooCommerce 11.2.1; requiere prueba funcional con la API real.


= 1.2 (14/06/2025) =
Fix: validando versión WC 9.9.3
Fix: validando versión WP 6.8.1
Fix: agregando sonar con git actions

= 1.1 (16/01/2025) =
Fix: ignorando archivos

= 1.0 (16/01/2025) =
Fix: validando versión WC 9.5.2
Fix: validando versión WP 6.7.1

= 0.9 (28/08/2024) =
Fix: validando versión WC 9.2.3
Fix: validando versión WP 6.6.1

= 0.0.8 (06/12/2022) =
Fix: validando versión WC 7.1.0
Fix: validando versión WP 6.1.1

=  0.0.7 (16/05/2022) =
Fix: validando versión WC 6.5.1
Fix: validando versión WP 6.0

= 0.0.6 (27/04/2022) =
Fix: Add componente a checkout.

= 0.0.5 (27/04/2022) =
Fix: Add texto al readme.txt

= 0.0.4 (27/04/2022) =
Fix: seteando la símbolo de monedad correcta.

= 0.0.3 (27/04/2022) =
Fix: agregando media para logo y traducciones.

= 0.0.2 (26/04/2022) =
Fix: cambio de llamado al api.

= 0.0.1 (25/04/2022) =
Inicio


