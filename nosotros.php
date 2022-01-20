<?php include 'includes/templates/header.php';  ?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">

            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Anos de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iure non adipisci a praesentium nihil veritatis cum, nostrum voluptate necessitatibus aspernatur officia ratione molestiae cupiditate temporibus saepe error fugit ullam excepturi.
                </p>

            </div>

        </div>

    </main>


    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">

            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum dolor sunt culpa esse doloremque! Praesentium quidem dolorum ipsa accusamus beatae minus sequi ut, in earum debitis, cupiditate incidunt saepe voluptatem.                    
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum dolor sunt culpa esse doloremque! Praesentium quidem dolorum ipsa accusamus beatae minus sequi ut, in earum debitis, cupiditate incidunt saepe voluptatem.                    
                </p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum dolor sunt culpa esse doloremque! Praesentium quidem dolorum ipsa accusamus beatae minus sequi ut, in earum debitis, cupiditate incidunt saepe voluptatem.                    
                </p>
            </div>

        </div>
    </section>


<?php 
    include 'includes/templates/footer.php';  
?>