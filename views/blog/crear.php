<main class="contenedor seccion">
    <h1>Crear Entrada</h1>

    <a href="/blog/admin" class="boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/blog/crear" enctype="multipart/form-data">
        
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Crear Entrada" class="boton-verde">
    </form>
</main>