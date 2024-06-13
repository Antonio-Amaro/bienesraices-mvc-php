<main>

    <section class="seccion contenedor">
        <h2>Explora nuestras propiedades</h2>
        <p>
            Descubre un nuevo estándar en el mundo inmobiliario con nuestro enfoque innovador y orientado al cliente. Con una amplia cartera de propiedades cuidadosamente seleccionadas y un servicio excepcional, estamos aquí para convertir tus sueños inmobiliarios en realidad.
        </p>

            <?php
                include 'listado.php';
            ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="/contacto" class="boton-amarillo-inline">Contáctanos</a>
    </section>

    <div class="contenedor seccion">
        <section>
            <h2>Más sobre nosotros</h2>
            <?php include 'iconos.php'; ?>
        </section>
        <hr> 
        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me 
                    ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Antonio Amaro</p>
            </div>
        </section>
        <hr>
    </div>
    
    <div class="contenedor seccion  seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <div class="blog-inicio">
                <?php
                    include 'entradas.php';
                ?>
                <div class="blog-link">
                    <a href="/blog" class="boton-verde">Explorar Blog</a>
                </div>
            </div> 
        </section>
    </div>
    
</main>