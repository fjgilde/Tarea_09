<?php
/**
 * Obtiene noticias desde una API externa.
 *
 * @param string $apiKey Clave de la API.
 * @return array Datos de las noticias en formato JSON.
 */
function obtenerNoticias($apiKey) {
    $url = "https://newsapi.org/v2/top-headlines?country=us&apiKey=" . $apiKey;
    $response = file_get_contents($url);
    return json_decode($response, true);
}

$apiKey = "66b6aedd71ee43da989175f1ddd17a2a";

$noticias = obtenerNoticias($apiKey);

if (isset($noticias['articles']) && !empty($noticias['articles'])) {
    $articulos = $noticias['articles'];
} else {
    $articulos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Hoy</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background: #333;
            color: white;
            padding: 1.5rem 1rem;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        header h1 {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            overflow-wrap: break-word;
            padding: 0 1rem;
        }
        nav {
            background: #444;
            color: white;
            padding: 0.8rem 1rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.3rem 0.5rem;
            white-space: nowrap;
        }
        main {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            padding: 1rem;
            gap: 2rem;
        }
        section {
            flex: 2;
            min-width: 300px;
        }
        aside {
            flex: 1;
            min-width: 250px;
            background: #f4f4f4;
        }
        article {
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 1.5rem 1rem;
            margin-top: auto;
            width: 100%;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 1rem 0;
        }
        video {
            width: 100%;
            height: auto;
            max-width: 640px;
            margin: 1rem 0;
        }

        @media (max-width: 768px) {
            main {
                flex-direction: column;
                padding: 0.5rem;
                gap: 1rem;
            }
            
            section, aside {
                flex: 1 1 100%;
            }
            
            header {
                padding: 1rem 0.5rem;
            }
            
            nav {
                padding: 0.5rem;
                gap: 0.5rem;
            }
            
            footer {
                padding: 1rem 0.5rem;
            }
            
            article {
                padding: 0.8rem;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 480px) {
            nav a {
                font-size: 0.9rem;
                padding: 0.2rem 0.3rem;
            }
            
            h2 {
                font-size: 1.2rem;
            }
            
            p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Noticias Hoy</h1>
    </header>
    <nav>
        <a href="#">Inicio</a>
        <a href="#">Noticias</a>
        <a href="registro.html">Registrarse</a>
    </nav>
    <main>
        <section>
            <?php if (!empty($articulos)): ?>
                <?php foreach ($articulos as $articulo): ?>
                    <article>
                        <h2><?php echo htmlspecialchars($articulo['title']); ?></h2>
                        <?php if (!empty($articulo['urlToImage'])): ?>
                            <img src="<?php echo htmlspecialchars($articulo['urlToImage']); ?>" alt="Imagen de noticia">
                        <?php endif; ?>
                        <p><?php echo htmlspecialchars($articulo['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($articulo['url']); ?>" target="_blank">Leer más</a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron noticias.</p>
            <?php endif; ?>
        </section>
        <aside>
            <h2>Más información</h2>
            <p>Consulta nuestras noticias destacadas y suscríbete para recibir más información.</p>
        </aside>
    </main>
    <footer>
        <p>&copy; 2025 Noticias Hoy - Todos los derechos reservados</p>
    </footer>
</body>
</html>