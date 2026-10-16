<?php
/**
 * Plugin Name: Física 5.º Científico — Dinámica y 2.ª Ley de Newton
 * Plugin URI: https://github.com/leo/plugin_segundaley
 * Description: Entorno interactivo y riguroso de aprendizaje desatendido para 5.º año de Bachillerato (Plan 94 / 2.° EMS, Uruguay). Trata notación vectorial estricta, DCL, fuerzas de rozamiento estático y cinético, plano inclinado, cuerpos vinculados con poleas y acople cinemático, con un taller de problemas.
 * Version: 2.3.0
 * Author: Departamento de Física - Bachillerato Diversificado
 * Text Domain: plugin-segundaley
 */

if (!defined('ABSPATH')) exit;

if (!defined('PSD_VERSION')) define('PSD_VERSION', '2.3.0');
if (!defined('PSD_URL')) define('PSD_URL', plugin_dir_url(__FILE__));
if (!defined('PSD_PATH')) define('PSD_PATH', plugin_dir_path(__FILE__));

/**
 * Versión de un asset propio: usa la fecha de modificación del archivo para que el navegador
 * no sirva una copia en caché después de cada cambio.
 */
if (!function_exists('psd_asset_version')) {
    function psd_asset_version($relPath) {
        $file = PSD_PATH . $relPath;
        return file_exists($file) ? PSD_VERSION . '.' . filemtime($file) : PSD_VERSION;
    }
}

/**
 * Carga de scripts y estilos del plugin
 */
if (!function_exists('psd_enqueue_assets')) {
    function psd_enqueue_assets() {
        // KaTeX para renderizado matemático formal con flechas vectoriales (\vec{F}, \Sigma\vec{F})
        wp_enqueue_style(
            'katex-css',
            'https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css',
            [],
            '0.16.11'
        );
        wp_enqueue_script(
            'katex-js',
            'https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js',
            [],
            '0.16.11',
            true
        );
        wp_enqueue_script(
            'katex-auto-render',
            'https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js',
            ['katex-js'],
            '0.16.11',
            true
        );

        // Estilos propios y motor interactivo
        wp_enqueue_style(
            'psd-style',
            PSD_URL . 'assets/css/dinamica.css',
            ['katex-css'],
            psd_asset_version('assets/css/dinamica.css')
        );
        wp_enqueue_script(
            'psd-app',
            PSD_URL . 'assets/js/dinamica.js',
            ['katex-auto-render'],
            psd_asset_version('assets/js/dinamica.js'),
            true
        );

        wp_localize_script('psd-app', 'psdData', [
            'pluginUrl' => PSD_URL,
            'version'   => PSD_VERSION
        ]);
    }
    add_action('wp_enqueue_scripts', 'psd_enqueue_assets');
}

/**
 * Shortcode principal y compatibilidad con [dinamica_newton]
 */
if (!function_exists('psd_render_app')) {
    function psd_render_app($atts = []) {
        ob_start();
        include PSD_PATH . 'templates/app.php';
        return ob_get_clean();
    }
    add_shortcode('dinamica_newton', 'psd_render_app');
    add_shortcode('segunda_ley', 'psd_render_app');
}
