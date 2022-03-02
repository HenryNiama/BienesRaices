<main class="contenedor seccion">
        <h1>Crear</h1>

        <!--Comprobacion de Errores: -->
        <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php endforeach; ?>   

        <a href="/public/propiedades/admin" class="boton boton-verde">Volver</a>
        
        <!--Formulario: -->
        <form action="" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

</main>