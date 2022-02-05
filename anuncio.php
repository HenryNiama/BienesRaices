<?php

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if (!$id) {
        header('Location: /');//Se va la pagina principal, al index.
    }

    require 'includes/app.php';

        //Importar la conexion
        $db = conectarBD();
    
        //Consultar
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
    
        //Obtener los resultados
        $resultado = mysqli_query($db, $query);

            //Si etra un id con un valor que no existe, e.j id=100,
            if ($resultado->num_rows === 0) { //entonces
                header('Location: /'); // se redirige a la pagina index.php principal.
            }

        $propiedad = mysqli_fetch_assoc($resultado);



    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

            <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad" loading="lazy">


        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?> USD</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            
            <p>
                <?php echo $propiedad['descripcion']; ?>
            </p>

        </div>

    </main>


<?php
        //Cerrar la conexion
        mysqli_close($db);

    incluirTemplate('footer');
?>