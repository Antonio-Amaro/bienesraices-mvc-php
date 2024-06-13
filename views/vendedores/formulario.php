<fieldset>
                
    <legend>Información general</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

    <label for="telefono">Teléfono</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Teléfono vendedor" value="<?php echo s($vendedor->telefono); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

    <?php if( $vendedor->imagen ): ?>
        <img src="../../imagenes/<?php echo $vendedor->imagen; ?>" class="imagen-small" alt="">
    <?php endif; ?>

</fieldset>