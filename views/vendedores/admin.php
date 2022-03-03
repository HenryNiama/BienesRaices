<main class="contenedor seccion">

        <h1>Administrador de Bienes Raices</h1>
        
        <?php
            if ($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado));
                if($mensaje){ 
        ?>
                    <p class="alerta exito"> <?php echo s($mensaje); ?> </p>
        <?php 
                }
            }
        ?> 
        
        
        
        <a href="/public/propiedades/admin" class="boton boton-amarillo ">Propiedades</a>
        <a href="/public/vendedores/admin" class="boton boton-amarillo ">Vendedores</a>

        <a href="/public/vendedores/crear" class="boton boton-verde" style="float: right;">Nuevo Vendedor</a>



    <h2>Vendedores</h2>
    
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--4 Mostrar los Resultados-->
            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>

                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>  

                        <a href="/public/vendedores/actualizar?id=<?php echo $vendedor->id; ?>"
                           class="boton-amarillo-block">
                           Actualizar
                        </a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>            
        </table>

        


</main>
