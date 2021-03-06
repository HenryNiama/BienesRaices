<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    
    //Si esta autenticado:
    $auth = $_SESSION['login'] ?? false; //da un true o false

    if (!isset($inicio)) {
        $inicio = false;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/public">
                    <img src="/public/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/public/build/img/dark-mode.svg" alt="">
                    <nav data-cy="navegacion-header" class="navegacion">
                        <a href="/public/nosotros">Nosotros</a>
                        <a href="/public/propiedades">Propiedades</a>
                        <a href="/public/blog">Blog</a>
                        <a href="/public/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/public/logout">Sign Out</a>
                        <?php else: ?>
                            <a href="/public/login">Sign In</a>
                        <?php endif; ?>                         
                    </nav>
                </div>
            </div><!--Barra-->

            <?php
                if ($inicio) {
                    echo "<h1 data-cy='heading-sitio'>Venta de casas y departamentos Exclusivos de Lujo</h1>";
                }
            ?>

        </div>
    </header>


    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy="navegacion-footer" class="navegacion">
                <a href="/public/nosotros">Nosotros</a>
                <a href="/public/propiedades">Propiedades</a>
                <a href="/public/blog">Blog</a>
                <a href="/public/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>


    <script src="/public/build/js/bundle.min.js"></script>
    
</body>
</html>