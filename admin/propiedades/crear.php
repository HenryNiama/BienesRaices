<?php 

    require '../../includes/app.php';
        
    use App\Propiedad;
    use App\Vendedor;

    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
 
    $propiedad = new Propiedad;

    //Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();
    //debugear($vendedores);


    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();
    // debugear($errores);


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        /*SUBIDA DE ARCHIVOS */
            
            
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

            //Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {//Si existe la imagen, entonces lo seteamos

                //Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);//Este es el archivo/imagen

                //Guardamos el nombre de la imagen en nuestra base de datos, no el archivo
                $propiedad->setImagen($nombreImagen); 
            }


        //Validar
        $errores = $propiedad->validar();


        if (empty($errores)) {
            
            //Crear la carpeta para subir imagenes
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Ahora, guardamos la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);//Este metodo es de la libreria de Intervention Image

            //Crea en la base de datos
            $propiedad->guardar();

        }

    }


    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>    
   
        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>


<?php 
    incluirTemplate('footer');
?>