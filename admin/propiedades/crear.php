<?php 

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarBD();
    //var_dump($db); nomas para verificar la conexion como sale y es.
    

    //Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';


    //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];
        
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

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
    
        //Revisar que el array de errores esté vacío
        if (empty($errores)) {
            //Insertar en la Base de Datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, 
            vendedorId) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', 
            '$vendedorId')";


            // echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado){
                echo "Insertado Correctamente";
            }
        }


    }

    require '../../includes/funciones.php';

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
   
        <form action="/admin/propiedades/crear.php" class="formulario" method="POST">
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

                <select name="vendedor" id="vendedor">
                    <optgroup label="--Seleccione Vendedor--">
                        <option value="1">Juan</option>
                        <option value="2">Karen</option>
                    </optgroup>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>


<?php 
    incluirTemplate('footer');
?>