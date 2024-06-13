<main class="contenedor seccion contenido-centrado">
        <a href="/propiedades" class="boton-verde">Volver</a>
        <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen seccion nosotros">

        <div class="resumen-propiedad">

            <p class="precio">$<?php echo number_format($propiedad->precio, 2, '.', ','); ?></p>
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
            
            <?php echo nl2br($propiedad->descripcion); ?>

        </div>

        <h3>¿Te interesa?</h3>
        <p>Llena el formulario con tus datos y uno de nuestros asesores se pondrá en contacto contigo</p>
        
        <div class="alinear-centro">
            <a href="/contacto" class="boton-verde">Contacto</a>
        </div>

</main>