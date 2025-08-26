<?php
/**
 * Standard‑Inhalt für die Haupt‑Seite des Menü‑Eintrags „FotoTechnik“.
 * Diese Datei wird von ft_main_page_callback() eingebunden.
 */
?>
<div class="wrap">
    <h1><?php _e( 'FotoTechnik – Plug‑Ins', 'ft-textdomain' ); ?></h1>

    <p><?php _e( 'FotoTechnik – Plug‑Ins sind für das WordPress Theme „FotoTechnik Blog“ entwickelt worden.', 'ft-textdomain' ); ?></p>

    <p>
        <?php
        /* Link zu deinem GitHub‑Repo */
        printf(
            /* translators: %s = URL */
            __( 'Weitere Plug‑Ins von mir sind zu finden unter: <a href="%s" target="_blank">GitHub</a>', 'ft-textdomain' ),
            esc_url( 'https://github.com/Raychan87' )
        );
        ?>
    </p>

    <p><?php _e( 'Besuchen Sie auch meine Webseite:', 'ft-textdomain' ); ?> <a href="https://deine-webseite.de" target="_blank">https://deine-webseite.de</a></p>
</div>
