<main class="contenedor seccion">

    <h1>Administrador de Vendedores</h1>

    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));

        if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php };
    }; ?>
    
    <a href="/vendedores/crear" class="boton-verde">Nuevo(a) vendedor</a>
    <a href="/admin" class="boton-amarillo-inline">Administrar propiedades</a>
    <a href="/blog/admin" class="boton-amarillo-inline">Administrar Blog</a>
            
        <div class="tabla-contenedor">
            <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach( $vendedores as $vendedor ): ?>
                        <tr>
                            <td><?php echo $vendedor->id; ?></td>
                            <td><?php echo $vendedor->nombre  . " " . $vendedor->apellido; ?></td>
                            <td><img src="../imagenes/<?php echo $vendedor->imagen ?>" class="imagen-tabla" alt=""></td>
                            <td><?php echo $vendedor->telefono ?></td>
                            <td>
                                <form method="POST" class="w-100" action="/vendedores/eliminar">

                                    <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                    <input type="hidden" name="tipo" value="vendedor">
                                    <input type="submit" class="boton-rojo-block" value="Eliminar">

                                </form>
                                <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
</main>