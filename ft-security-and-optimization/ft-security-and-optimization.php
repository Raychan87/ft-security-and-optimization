<?php
/**
 * Plugin Name: FotoTechnik
 * Description: Verwaltung von Security‑, Optimierungs‑ und REST‑API‑Einstellungen unter einem eigenen Admin‑Menü.
 * Version:     1.0.0
 * Author:      Dein Name
 * License:     GPL‑2.0+
 * Text Domain: fototechnik
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direktzugriff verhindern.
}

/**
 * -------------------------------------------------------------------------
 * 1. ADMIN MENÜ & SEITEN
 * -------------------------------------------------------------------------
 */
add_action( 'admin_menu', 'fototechnik_register_menu' );
function fototechnik_register_menu() {

    // Hauptmenü
    $menu_slug = 'fototechnik';
    add_menu_page(
        __( 'FotoTechnik', 'fototechnik' ),   // Seiten‑Titel
        __( 'FotoTechnik', 'fototechnik' ),   // Menü‑Titel
        'manage_options',                     // Berechtigung
        $menu_slug,                           // Slug
        'fototechnik_page_security',          // Callback (Standard‑Seite)
        'dashicons-camera',                   // Icon (kann beliebig geändert werden)
        81                                    // Position (nach "Einstellungen")
    );

    // Untermenü: Security
    add_submenu_page(
        $menu_slug,
        __( 'Security', 'fototechnik' ),
        __( 'Security', 'fototechnik' ),
        'manage_options',
        'fototechnik-security',
        'fototechnik_page_security'
    );

    // Untermenü: Optimierung
    add_submenu_page(
        $menu_slug,
        __( 'Optimierung', 'fototechnik' ),
        __( 'Optimierung', 'fototechnik' ),
        'manage_options',
        'fototechnik-optimierung',
        'fototechnik_page_optimierung'
    );

    // Untermenü: Rest API
    add_submenu_page(
        $menu_slug,
        __( 'REST API', 'fototechnik' ),
        __( 'REST API', 'fototechnik' ),
        'manage_options',
        'fototechnik-restapi',
        'fototechnik_page_restapi'
    );
}

/**
 * -------------------------------------------------------------------------
 * 2. SETTINGS & OPTIONEN
 * -------------------------------------------------------------------------
 */
function fototechnik_register_settings() {
    // Security‑Optionen
    register_setting( 'fototechnik_security', 'fototechnik_security_options' );

    // Optimierungs‑Optionen
    register_setting( 'fototechnik_optimierung', 'fototechnik_optimierung_options' );

    // REST‑API‑Optionen
    register_setting( 'fototechnik_restapi', 'fototechnik_restapi_options' );
}
add_action( 'admin_init', 'fototechnik_register_settings' );

/**
 * -------------------------------------------------------------------------
 * 3. ADMIN‑SEITEN
 * -------------------------------------------------------------------------
 */

/* ---------- 3.1 Security ---------- */
function fototechnik_page_security() {
    // Aktuelle Optionen holen
    $opts = get_option( 'fototechnik_security_options', [] );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'FotoTechnik – Security', 'fototechnik' ); ?></h1>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'fototechnik_security' );
                do_settings_sections( 'fototechnik_security' );
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e( 'WordPress‑Version ausblenden', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_security_options[hide_generator]" value="1"
                            <?php checked( ! empty( $opts['hide_generator'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'XML‑RPC deaktivieren', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_security_options[disable_xmlrpc]" value="1"
                            <?php checked( ! empty( $opts['disable_xmlrpc'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'DNS‑Prefetch entfernen', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_security_options[remove_dns_prefetch]" value="1"
                            <?php checked( ! empty( $opts['remove_dns_prefetch'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'RSD‑Link entfernen', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_security_options[remove_rsd]" value="1"
                            <?php checked( ! empty( $opts['remove_rsd'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Heartbeat‑Script deaktivieren', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_security_options[disable_heartbeat]" value="1"
                            <?php checked( ! empty( $opts['disable_heartbeat'] ) ); ?> />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/* ---------- 3.2 Optimierung ---------- */
function fototechnik_page_optimierung() {
    $opts = get_option( 'fototechnik_optimierung_options', [] );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'FotoTechnik – Optimierung', 'fototechnik' ); ?></h1>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'fototechnik_optimierung' );
                do_settings_sections( 'fototechnik_optimierung' );
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e( 'Emojis komplett entfernen', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_optimierung_options[disable_emojis]" value="1"
                            <?php checked( ! empty( $opts['disable_emojis'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Embeds deaktivieren', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_optimierung_options[disable_embeds]" value="1"
                            <?php checked( ! empty( $opts['disable_embeds'] ) ); ?> />
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/* ---------- 3.3 Rest API ---------- */
function fototechnik_page_restapi() {
    $opts = get_option( 'fototechnik_restapi_options', [] );
    $whitelist = isset( $opts['whitelist'] ) ? $opts['whitelist'] : '';
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'FotoTechnik – REST API', 'fototechnik' ); ?></h1>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'fototechnik_restapi' );
                do_settings_sections( 'fototechnik_restapi' );
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e( 'REST API aktivieren', 'fototechnik' ); ?></th>
                    <td>
                        <input type="checkbox" name="fototechnik_restapi_options[enable_rest]" value="1"
                            <?php checked( ! empty( $opts['enable_rest'] ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'IP‑Whitelist (kommagetrennt)', 'fototechnik' ); ?></th>
                    <td>
                        <input type="text" name="fototechnik_restapi_options[whitelist]" class="regular-text"
                               value="<?php echo esc_attr( $whitelist ); ?>" placeholder="z. B. 123.45.67.89, 255.255.255.255, ::1" />
                        <p class="description">
                            <?php esc_html_e( 'Nur die hier genannten IP‑Adressen dürfen die REST‑API nutzen.', 'fototechnik' ); ?>
                        </p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * -------------------------------------------------------------------------
 * 4. FUNKTIONEN – werden nur ausgeführt, wenn die jeweilige Option aktiv ist
 * -------------------------------------------------------------------------
 */

/* ---------- 4.1 Security ---------- */
add_action( 'init', 'fototechnik_apply_security_settings' );
function fototechnik_apply_security_settings() {
    $opts = get_option( 'fototechnik_security_options', [] );

    // WordPress‑Version ausblenden
    if ( ! empty( $opts['hide_generator'] ) ) {
        add_filter( 'the_generator', '__return_null' );
    }

    // XML‑RPC deaktivieren
    if ( ! empty( $opts['disable_xmlrpc'] ) ) {
        add_filter( 'xmlrpc_enabled', '__return_false' );
    }

    // DNS‑Prefetch entfernen
    if ( ! empty( $opts['remove_dns_prefetch'] ) ) {
        remove_action( 'wp_head', 'wp_resource_hints', 2 );
    }

    // RSD‑Link entfernen
    if ( ! empty( $opts['remove_rsd'] ) ) {
        remove_action( 'wp_head', 'rsd_link' );
    }

    // Heartbeat‑Script deaktivieren
    if ( ! empty( $opts['disable_heartbeat'] ) ) {
        add_action( 'init', function () {
            wp_deregister_script( 'heartbeat' );
        } );
    }
}

/* ---------- 4.2 Optimierung ---------- */
add_action( 'init', 'fototechnik_apply_optimierung_settings' );
function fototechnik_apply_optimierung_settings() {
    $opts = get_option( 'fototechnik_optimierung_options', [] );

    // Emojis komplett entfernen
    if ( ! empty( $opts['disable_emojis'] ) ) {
        // Front‑End
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        // Admin‑Bereich
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

        // TinyMCE‑Plugin entfernen
        add_filter( 'tiny_mce_plugins', 'fototechnik_disable_emojis_tinymce' );
    }

    // Embeds deaktivieren
    if ( ! empty( $opts['disable_embeds'] ) ) {
        add_filter( 'tiny_mce_plugins', 'fototechnik_disable_embeds_tiny_mce_plugin' );
        add_filter( 'rewrite_rules_array', 'fototechnik_disable_embeds_rewrites' );
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    }
}

/* Emoji‑Filter */
function fototechnik_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, [ 'wpemoji' ] );
    }
    return [];
}

/* Embeds‑Filter */
function fototechnik_disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, [ 'wpembed' ] );
}
function fototechnik_disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}

/* ---------- 4.3 REST API ---------- */
add_action( 'rest_api_init', 'fototechnik_rest_api_control' );
function fototechnik_rest_api_control() {
    $opts = get_option( 'fototechnik_restapi_options', [] );

    // REST API komplett deaktivieren, wenn nicht aktiv
    if ( empty( $opts['enable_rest'] ) ) {
        // Keine weitere Prüfung – API ist deaktiviert
        wp_die( __( 'REST API is disabled.', 'fototechnik' ), '', [ 'response' => 403 ] );
    }

    // IP‑Whitelist prüfen (nur wenn ein Eintrag vorhanden ist)
    $whitelist_raw = isset( $opts['whitelist'] ) ? $opts['whitelist'] : '';
    $whitelist = array_map( 'trim', explode( ',', $whitelist_raw ) );

    // Immer die lokalen Adressen zulassen (falls nicht explizit angegeben)
    $whitelist = array_merge( $whitelist, [ '127.0.0.1', '::1' ] );
    $whitelist = array_unique( $whitelist );

    $remote_ip = $_SERVER['REMOTE_ADDR'] ?? '';

    if ( ! in_array( $remote_ip, $whitelist, true ) ) {
        wp_die( __( 'REST API is disabled for your IP address.', 'fototechnik' ), '', [ 'response' => 403 ] );
    }
}

/**
 * -------------------------------------------------------------------------
 * 5. OPTIONAL: Styling / Skripte für das Admin‑Interface
 * -------------------------------------------------------------------------
 */
add_action( 'admin_enqueue_scripts', 'fototechnik_admin_assets' );
function fototechnik_admin_assets( $hook ) {
    // Nur auf den eigenen Seiten laden
    if ( strpos( $hook, 'fototechnik' ) === false ) {
        return;
    }

    wp_enqueue_style(
        'fototechnik-admin',
        plugin_dir_url( __FILE__ ) . 'css/admin.css',
        [],
        '1.0.0'
    );
}

/* Wenn du kein separates CSS‑File nutzen willst, kannst du das Styling auch inline in den
   jeweiligen Admin‑Seiten ausgeben – hier reicht das aber für ein einfaches Layout. */