<main class="contenedor seccion">

    <h1>Administrador de Bienes Raices</h1>

    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));

        if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php };
    }; ?>
    
    <a href="/propiedades/crear" class="boton-verde">Nueva propiedad</a>
    <a href="/vendedores/admin" class="boton-amarillo-inline">Administrar Vendedores</a>
    <a href="/blog/admin" class="boton-amarillo-inline">Administrar Blog</a>
    
    <h2>Propiedades</h2>

    <div class="tabla-contenedor">
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach( $propiedades as $propiedad ): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                        <td>$ <?php echo number_format($propiedad->precio, 2, '.', ','); ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/propiedades/eliminar">

                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">

                            </form>
                            <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</main>