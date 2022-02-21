<?php
    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    //Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //debugear($_POST); //Es un array con los valores

        //Crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);
        //debugear($vendedor); Ya es un objeto

        //Validar que no halla campos vacios
        $errores = $vendedor->validar();

        //Si no hay errores
        if (empty($errores)) {
            $vendedor->guardar();
        }
        
    }

    incluirTemplate('header');
?>

    
    <main class="contenedor seccion">
        <h1>Registrar Vendedor</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>    
   
        <form action="/admin/vendedores/crear.php" class="formulario" method="POST">

            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>

    </main>



<?php
    incluirTemplate('footer');
?>