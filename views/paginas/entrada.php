<main class="contenedor seccion contenido-centrado">
    <a href="/blog" class="boton-verde">Volver</a>
    <h1><?php echo $entrada->titulo; ?></h1>

    <div class="">
        <img loading="lazy" src="imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen seccion nosotros">
    </div>

    <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fechaPublicacion; ?></span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
        <?php echo nl2br($entrada->contenido); ?>
    </div>
</main>