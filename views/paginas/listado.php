<div class="contenedor-anuncios">

    <?php foreach( $propiedades as $propiedad): ?>

    <div class="anuncio">

        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">
        
        <div class="contenido-anuncio">
            <a href="/propiedad?id=<?php echo $propiedad->id; ?>">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p class="descripcion"><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo number_format($propiedad->precio, 2, '.', ','); ?></p>
            </a>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

            <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                Ver propiedad
            </a>
        </div><!-- Contenido anuncio -->
    </div><!-- Anuncio -->

    <?php endforeach; ?>

</div><!-- Contenedor anuncios -->