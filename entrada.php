<?php 
    require 'includes/app.php';

    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>


        <p class="informacion-meta">Escrito el: <span>20/10/2021 </span>por: <span>Admin</span></p>

        
        <div class="resumen-propiedad">

            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas libero quam illo! Sunt ea consequuntur numquam, ratione fuga temporibus. Nulla impedit doloremque harum libero aut sint. Error officia eveniet cupiditate.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, sit illo placeat laboriosam at voluptatum reprehenderit dolorum id totam temporibus eum animi voluptatem deleniti inventore, repellat iure natus architecto dicta.
            </p>
        </div>

    </main>


<?php 
    incluirTemplate('footer');
?>