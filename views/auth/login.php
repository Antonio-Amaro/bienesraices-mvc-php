<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Correo electrónico" required>

            <label for="password">Teléfono</label>
            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-verde">

    </form>
</main>