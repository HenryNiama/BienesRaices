<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la Propiedad" value="<?php echo s($propiedad->precio); ?>"> 

                <label for="imagen">Imágen: </label>
                <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

                <?php if($propiedad->imagen) {?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="" srcset="">
                <?php }?>

                <label for="descripcion">Descripción: </label>
                <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10">
                    <?php echo s($propiedad->descripcion); ?>
                </textarea>
</fieldset>


            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 2" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento: </label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 1" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedorId]" id="vendedor">
                    <option selected value="">-- Seleccione --</option>
                    <?php foreach($vendedores as $vendedor) {?>
                        <option 
                            <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?>
                            value="<?php echo s($vendedor->id); ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> 
                        </option>
                    <?php } ?>    
                </select>
            </fieldset>