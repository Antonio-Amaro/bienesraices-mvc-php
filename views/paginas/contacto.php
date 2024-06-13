<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if($exitoso): ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php elseif($exitoso === false): ?>
        <p class="alerta error"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Ingrese su nombre" name="contacto[nombre]" > <!-- required -->

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" ></textarea> <!-- required -->

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o compra:</label>
            <select id="opciones" name="contacto[tipo]" > <!-- required -->
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto:</label>
            <input type="number" id="presupuesto" name="contacto[precio]" > <!-- required -->

        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            
            <p>¿Cómo desea ser contactado?</p>
            
            <div class="forma-contacto">
                <label for="contactar-telefono">Llamada</label>
                <input value="telefono" type="radio" id="contactar-telefono" name="contacto[contacto]" > <!-- required -->

                <label for="contactar-email">Correo</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]">
            </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>