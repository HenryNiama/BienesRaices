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

        <a href="/public/propiedades/crear" class="boton boton-verde" style="float: right;">Nueva Propiedad</a>



        <h2>Propiedades</h2>
    
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
                    <td><img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>

                    <td>
                        <form action="/public/propiedades/eliminar" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>  

                        <a href="/public/propiedades/actualizar?id=<?php echo $propiedad->id; ?>"
                            class="boton-amarillo-block">
                            Actualizar
                        </a>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
            </tbody>            
        </table>

</main>
