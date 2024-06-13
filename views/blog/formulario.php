<fieldset>
                
    <legend>Nueva entrada del Blog</legend>

    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="entrada[titulo]" placeholder="Título entrada" value="<?php echo s($entrada->titulo); ?>">

    <label for="contenido">Contenido</label>
    <textarea id="contenido" name="entrada[contenido]" placeholder="Contenido entrada"><?php echo s($entrada->contenido); ?></textarea>

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="entrada[imagen]"><?php echo s($entrada->imagen); ?>

    <?php if( $entrada->imagen ): ?>
        <img src="../../imagenes/<?php echo $entrada->imagen; ?>" class="imagen-small" alt="">
    <?php endif; ?>


</fieldset>

<fieldset>

<legend>Autor</legend>

    <label for="usuario">Usuario</label>
    <select name="entrada[usuarioId]" id="usuario">
        <option value="">-- Seleccione un usuario --</option>
        <?php foreach($usuarios as $usuario): ?>
            <option <?php echo $entrada->usuarioId == $usuario->id ? 'selected' : ''; ?> value="<?php echo s($usuario->id); ?>" ><?php echo s($usuario->email); ?></option>
        <?php endforeach; ?>
    </select>

</fieldset>