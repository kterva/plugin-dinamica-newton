<?php
/**
 * Plugin Name: Local Development Helper
 * Description: Optimiza las peticiones de red en entornos Docker locales forzando IPv4 y extendiendo timeouts.
 */

// Forzar IPv4 en cURL para evitar fallos/timeouts por IPv6 en Docker hacia wordpress.org
add_action('http_api_curl', function($handle) {
    curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
});

// Aumentar el timeout de peticiones HTTP en desarrollo local
add_filter('http_request_timeout', function($timeout) {
    return 15;
});
add_filter('http_request_args', function($r) {
    $r['timeout'] = 15;
    return $r;
});
