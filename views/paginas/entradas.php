<article class="entrada-blog">

    <?php foreach($entradas as $entrada): ?>

        <div class="imagen">
            <img loading="lazy" src="../../imagenes/<?php echo $entrada->imagen; ?>" alt="Texto entrada blog">
        </div>
        <div class="texto-entrada">
            <a href="/entrada?id=<?php echo $entrada->id; ?>">
                <h4><?php echo $entrada->titulo; ?></h4>
                
                <?php if(!isset($inicio)){ ?>
                    <p>Escrito el <span><?php echo $entrada->fechaPublicacion; ?></span> por: <span>Admin</span></p>
                <?php }; ?>

                <?php //if(!isset($inicio)){
                     echo $entrada->contenido;
                //}; ?>
            </a>
        </div>
        

    <?php endforeach; ?>

</article>