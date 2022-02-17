<?php

require '../includes/app.php';
    
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    //Implementar un método para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // debugear($vendedores);


    //2) Escribir el Query
    $query = "SELECT * FROM propiedades";
    
    //3) Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);


    //*********************ELIMINAR UNA CELDA*********************************************** */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $propiedad = Propiedad::find($id);
            //debugear($propiedad);
            $propiedad->eliminar();
        }
    }

    //********************************************************************* */



    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";
    // exit;

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;
    
    

    //Incluye un template
    incluirTemplate('header');
?>


    <main class="contenedor seccion">

        <h1>Administrador de Bienes Raices</h1>
            <?php if (intval($resultado) === 1): ?>
                <p class="alerta exito">Anuncio Creado Correctamente.</p>          
            <?php elseif(intval($resultado) === 2): ?>    
                <p class="alerta exito">Anuncio Actualizado Correctamente.</p>
            <?php elseif(intval($resultado) === 3): ?>    
                <p class="alerta exito">Anuncio Eliminado Correctamente.</p>
            <?php endif; ?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--4 Mostrar los Resultados-->
            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>

                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>  

                        <a href="/admin/propiedades/actualizar.php?
                            id=<?php echo $propiedad->id; ?>"
                            class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>            
        </table>
    
    </main>
    
    
<?php 

    //5) Cerrar la conexion
        mysqli_close($db);


    incluirTemplate('footer');
?>