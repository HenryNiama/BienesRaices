<main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>

        <a href="/public/vendedores/admin" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>    
   
        <form action="/public/vendedores/actualizar" class="formulario" method="POST">

            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>

</main>