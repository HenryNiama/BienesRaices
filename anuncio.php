<?php include 'includes/templates/header.php';  ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas libero quam illo! Sunt ea consequuntur numquam, ratione fuga temporibus. Nulla impedit doloremque harum libero aut sint. Error officia eveniet cupiditate.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, sit illo placeat laboriosam at voluptatum reprehenderit dolorum id totam temporibus eum animi voluptatem deleniti inventore, repellat iure natus architecto dicta.
            </p>
        </div>

    </main>


<?php 
    include 'includes/templates/footer.php';  
?>