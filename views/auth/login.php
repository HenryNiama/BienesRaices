<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="heading-login">Iniciar Sesión</h1>

        <?php foreach($errores as $error):?>
            <div data-cy="alerta-login" class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form data-cy="formulario-login" action="/public/login" class="formulario" method="POST" novalidate>
            <fieldset>
                <legend>Email y Password</legend>

                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Tu email" id="email" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu password" id="password" required>
            </fieldset>

            <input type="submit" value="Sign In" class="boton boton-verde">
        </form>
</main>