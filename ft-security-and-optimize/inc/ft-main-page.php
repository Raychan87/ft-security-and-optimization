<?php
/* -------------------------------------------------
   Daten‑Array – hier kannst du jederzeit weitere
   Plugins bzw. das Theme ergänzen.
   ------------------------------------------------- */
$items = [
    [
        'type'        => 'plugin',
        'slug'        => 'ft-security-and-optimize',
        'name'        => 'FotoTechnik - Security &amp; Optimize',
        'description' => 'Sicherheits‑ und Optimierungs‑Tools für WordPress‑Installationen.',
        'repo'        => 'https://github.com/Raychan87/ft-security-and-optimize',
        'wp'          => 'https://wordpress.org/plugins/ft-security-and-optimize',
        'icon'        => '🔒',
    ],
    [
        'type'        => 'plugin',
        'slug'        => 'ft-meow-lightbox-mapping',
        'name'        => 'FotoTechnik - Meow Lightbox Mapping',
        'description' => 'Ermöglicht das Ändern der Kamera‑ und Objektiv‑Namen im Meow Lightbox‑Plugin.',
        'repo'        => 'https://github.com/Raychan87/ft-meow-lightbox-mapping',
        'wp'          => 'https://wordpress.org/plugins/ft-meow-lightbox-mapping',
        'icon'        => '🖼️',
    ],
    [
        'type'        => 'theme',
        'slug'        => 'fototechnik-blog',
        'name'        => 'Fototechnik‑Blog',
        'description' => 'Ein Theme für Fotografen und Technikblogger.',
        'repo'        => 'https://github.com/Raychan87/fototechnik-blog',
        'wp'          => 'https://wordpress.org/themes/fototechnik-blog',
        'icon'        => '📚',
    ],
];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>FotoTechnik – Übersicht</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* -------------------------------------------------
           Grundvariablen – alles relativ (rem / %) 
           ------------------------------------------------- */
        :root{
            --space-sm: .5rem;      /* 8 px  */
            --space-md: 1rem;       /* 16 px */
            --space-lg: 2rem;       /* 32 px */
            --radius:   .4rem;      /* 6 px  */
            --primary:  #0066cc;
            --secondary:#777;
            --bg-page:  #f5f5f5;
            --bg-card:  #fff;
        }

        /* -------------------------------------------------
           Grundlayout
           ------------------------------------------------- */
        body{
            font-family: -apple-system, BlinkMacSystemFont,
                         "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg-page);
            margin:0; padding:0;
            color:#333;
        }
        .wrapper{
            max-width: 90%;               /* fast volle Breite, aber mit Rand */
            margin: 0 auto;
            padding: var(--space-lg) var(--space-md);
        }
        h1{
            font-size: 2.2rem;
            margin-bottom: var(--space-sm);
        }
        .intro{
            background: var(--bg-card);
            padding: var(--space-md);
            border-radius: var(--radius);
            box-shadow: 0 .125rem .375rem rgba(0,0,0,.07);
            margin-bottom: var(--space-lg);
        }
        .intro a{
            color: var(--primary);
            text-decoration:none;
        }
        .intro a:hover{
            text-decoration:underline;
        }

        /* -------------------------------------------------
           Karten‑Layout – Flexbox, responsive
           ------------------------------------------------- */
        .cards{
            display:flex;
            flex-wrap:wrap;
            gap: var(--space-md);
        }
        .card{
            background: var(--bg-card);
            border: 1px solid #e1e1e1;
            border-radius: var(--radius);
            flex:1 1 calc(33.333% - var(--space-md));
            min-width:260px;               /* verhindert zu enge Karten */
            padding: var(--space-md);
            box-shadow: 0 .0625rem .25rem rgba(0,0,0,.05);
            transition: transform .15s, box-shadow .15s;
            display:flex;
            flex-direction:column;          /* vertikale Anordnung */
        }
        .card:hover{
            transform: translateY(-.25rem);
            box-shadow: 0 .375rem .75rem rgba(0,0,0,.1);
        }
        .card-icon{
            font-size: 2.4rem;
            /* kein margin‑bottom mehr – wir steuern den Abstand über das Title‑Element */
            display:block;                 /* sorgt dafür, dass es eine Box ist */
        }
        .card-title{
            font-size: 1.3rem;
            color:#111;
        }
        .card-desc{
            font-size: .95rem;
            color:#555;
            line-height:1.4;
            margin-top: var(--space-sm);
            margin-bottom: var(--space-md);
        }

        /* -------------------------------------------------
           Buttons – immer voller Text, kein "…"
           ------------------------------------------------- */
        .card-links{
            margin-top:auto;                /* nach unten schieben */
            display:flex;
            justify-content:space-between; /* linker / rechter Rand */
            flex-wrap:wrap;                /* wenn nicht genug Platz → neue Zeile */
            gap:0;
            margin-bottom: var(--space-sm);
        }
        .card-links a{
            flex:0 1 auto;                 /* Button kann wachsen, aber nicht schrumpfen */
            min-width:8rem;                /* Mindestbreite, damit er nicht zu klein wird */
            max-width:100%;                /* nie breiter als die Zeile */
            white-space:nowrap;            /* kein interner Zeilenumbruch */
            text-align:center;
            background: var(--primary);
            color:#fff;
            padding:.35rem .5rem;          /* relative Innenabstände */
            border-radius:var(--radius);
            font-size:.85rem;
            text-decoration:none;
            transition:opacity .15s;
        }
        .card-links a.secondary{
            background: var(--secondary);
        }
        .card-links a:hover{
            opacity:.85;
        }

        /* -------------------------------------------------
           Responsives Verhalten
           ------------------------------------------------- */
        @media (max-width:960px){
            .card{flex:1 1 calc(50% - var(--space-md));}
        }
        @media (max-width:620px){
            .card{flex:1 1 100%;}
        }
        /* Auf sehr schmalen Bildschirmen (Handy) Buttons untereinander */
        @media (max-width:480px){
            .card-links{
                flex-direction:column;
                align-items:stretch;
                gap:var(--space-sm);
            }
            .card-links a{
                width:100%;
                min-width:auto;
                white-space:nowrap;   /* bleibt einzeilig, weil 100 % der Zeile */
            }
        }
    </style>
</head>
<body>
<div class="wrapper">

    <h1>FotoTechnik – Übersicht</h1>

    <section class="intro">
        <p>
           Hallo! Die FotoTechnik‑Apps wurden von mir, <strong>Raychan</strong>, entwickelt, um die Benutzerfreundlichkeit meiner Webseite <a href="https://Fototour-und-technik.de" target="_blank">Fototour‑und‑technik.de</a> zu verbessern.<br>
            Da ich Open‑Source sehr schätze, stelle ich meine Apps selbst als Open‑Source‑Projekt allen Interessierten kostenlos zur Verfügung.<br><br>
            Schaut gern auf meinem GitHub‑Profil vorbei: 
            <a href="https://github.com/Raychan87" target="_blank">github.com/Raychan87</a>.<br>
            Ich bin außerdem Hobby‑Fotograf – besucht ebenfalls meine Fotoseite: 
            <a href="https://Fototour-und-technik.de" target="_blank">Fototour‑und‑technik.de</a>.
        </p>
    </section>

    <section class="cards">
        <?php foreach ( $items as $item ) : ?>
            <article class="card <?php echo esc_attr( $item['type'] ); ?>">
                <div class="card-icon"><?php echo $item['icon']; ?></div>
                <h2 class="card-title"><?php echo esc_html( $item['name'] ); ?></h2>
                <p class="card-desc"><?php echo esc_html( $item['description'] ); ?></p>

                <div class="card-links">
                    <a href="<?php echo esc_url( $item['repo'] ); ?>" target="_blank">
                        GitHub Repository
                    </a>
                    <a href="<?php echo esc_url( $item['wp'] ); ?>" target="_blank"
                       class="secondary">
                        <?php echo $item['type'] === 'plugin'
                              ? 'WordPress Plugin‑Seite'
                              : 'WordPress Theme‑Seite'; ?>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

</div>
</body>
</html>