<?php 
    require 'includes/app.php';

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp"> 
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto"> 
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu email" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Tu Telefono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" cols="30" rows="5"></textarea>

            </fieldset>


            <fieldset>
                <legend>Informacion de la propiedada</legend>

                <label for="opciones">Vende o compra: </label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>


                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Presupuesto" id="presupuesto">

            </fieldset>


            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora</p>

                <label for="fecha">Fecha</label>
                <input type="date" value="fecha" id="fecha">

                <label for="hora">Hora</label>
                <input type="time"  id="hora" min="09:00" max="10:00">

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">

        </form>

    </main>


<?php 
    incluirTemplate('footer');
?>