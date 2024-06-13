<main class="contenedor seccion">
        
    <h1>Administrador del Blog</h1>

    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));

        if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php };
    }; ?>

    <a href="/blog/crear" class="boton-verde">Nueva entrada</a>
    <a href="/admin" class="boton-amarillo-inline">Administrar Propiedades</a>
    <a href="/vendedores/admin" class="boton-amarillo-inline">Administrar Vendedores</a>
    
    <div class="tabla-contenedor">
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach( $entradas as $entrada ): ?>
                <tr>
                    <td><?php echo $entrada->id; ?></td>
                    <td><?php echo $entrada->titulo; ?></td>
                    <td><?php echo $entrada->fechaPublicacion; ?></td>
                    <td><img src="../../imagenes/<?php echo $entrada->imagen ?>" class="imagen-tabla" alt=""></td>
                    <td>
                        <form method="POST" class="w-100" action="/blog/eliminar">

                            <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">

                        </form>
                        <a href="/blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    </div>
</main>