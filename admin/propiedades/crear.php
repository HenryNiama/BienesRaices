<?php 

    require '../../includes/app.php';
        
    use App\Propiedad;

    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();


    //Base de datos
    $db = conectarBD();
    //var_dump($db); nomas para verificar la conexion como sale y es.
    
    
    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();
    // debugear($errores);


    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Crea una nueva instancia
        $propiedad = new Propiedad($_POST);

        /*SUBIDA DE ARCHIVOS */
            
            
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)).(".jpg");

            //Setear la imagen
            if ($_FILES['imagen']['tmp_name']) {//Si existe la imagen, entonces lo seteamos

                //Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);//Este es el archivo/imagen

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

            //Guarda en la base de datos
            $resultado = $propiedad->guardar();

            //Mensaje de exito:
            if($resultado){
                //Redireccionar al usuario
                header("Location: /admin?resultado=1");
            }
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?>"> 

                <label for="imagen">Imágen</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" name="descripcion" cols="30" rows="10">
                    <?php echo $descripcion; ?>
                </textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento: </label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 1" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId" id="vendedor">
                        <option value="">--Seleccione--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : '';?> value="<?php echo $vendedor['id']; ?>">
                             <?php echo $vendedor['nombre'] . " " . $vendedor['apellido'];?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>


<?php 
    incluirTemplate('footer');
?>