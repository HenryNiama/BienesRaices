<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

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
    $errores = Propiedad::getErrores();


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // debugear($_POST);

        //Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);
        //debugear($propiedad);

        //Validacion
        $errores = $propiedad->validar();
        
        //Subida de Archivos

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)).(".jpg");

            if ($_FILES['propiedad']['tmp_name']['imagen']) {//Si existe la imagen, entonces lo seteamos

                //Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);//Este es el archivo/imagen

                //Guardamos el nombre de la imagen en nuestra base de datos, no el archivo
                $propiedad->setImagen($nombreImagen); 
            }




        //Revisar que el array de errores esté vacío
        if (empty($errores)) {


            exit;

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