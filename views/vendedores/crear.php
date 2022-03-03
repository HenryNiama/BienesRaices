<main class="contenedor seccion">
        <h1>Registrar Vendedor</h1>

        <a href="/public/vendedores/admin" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>    
   
        <form action="/public/vendedores/crear" class="formulario" method="POST">
            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>

    </main>