<?php

use App\Propiedad;

require '../../includes/app.php';
    
    estaAutenticado();

    //Validar la URL por ID valido.
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {//Si es que es false, u otro codigo raro, inyeccion, etc
        header('Location: /admin');
    }


    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id); 



    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //Arreglo con mensajes de errores
    $errores = [];


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');
        
        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if (!$titulo) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "Debes anadir un titulo.";
        }

        if (!$precio) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "El precio es obligatorio.";
        }

        if (strlen($descripcion) < 50) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres.";
        }

        if (!$habitaciones) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "El numero de habitaciones es obligatorio.";
        }

        if (!$wc) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "El Número de baños es obligatorio.";
        }

        if (!$estacionamiento) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "El Número de lugares de estacionamiento es obligatorio.";
        }

        if (!$vendedorId) {//Si no hay titulo, es decir, esta vacio.
            $errores[] = "Elige un vendedor.";
        }

            //Validar por tamano (1 mb maximo)
            $medida = 1000 * 1000;

            if($imagen['size'] > $medida){
                $errores[] = 'La Imagen es muy pesada';
            }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
    
        //Revisar que el array de errores esté vacío
        if (empty($errores)) {

            //Crear carpeta
            $carpetaImagenes = '../../imagenes';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /*SUBIDA DE ARCHIVOS */

            if ($imagen['name']) {
                //echo "Si hay una nueva imagen";

                //Eliminar la imagen previa, usamos unlink()
                unlink($carpetaImagenes ."/". $propiedad['imagen']);

                //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)).".jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/". $nombreImagen);

            }else{//En caso de que no actualizemos la imagen
                $nombreImagen = $propiedad['imagen'];
            }
            


            //Insertar en la Base de Datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', 
            descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, 
            estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}; ";


            // echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                //echo "Insertado Correctamente";

                //Redireccionar al usuario
                header("Location: /admin?resultado=2");
            }
        }


    }


    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Actualizar Propiedades</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>    
   
        <form class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>

    </main>


<?php 
    incluirTemplate('footer');
?>