<?php

    namespace Model;

    class Blog extends ActiveRecord{

        // Nombre de nuestra tabla para el método que consulta a la BD
        protected static $tabla = 'entradasblog';
        // Nombres de las columnas en nuestra tabla en la BD
        protected static $columnasDB = ['id', 'titulo', 'contenido', 'fechaPublicacion', 'imagen', 'usuarioId'];

        public $id;
        public $titulo;
        public $contenido;
        public $fechaPublicacion;
        public $imagen;
        public $usuarioId;

        public function __construct($args = []) {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->contenido = $args['contenido'] ?? '';
            $this->fechaPublicacion = date('Y/m/d');
            $this->imagen = $args['imagen'] ?? '';
            $this->usuarioId = $args['usuarioId'] ?? '';
        }

        // Subida de archivos
        public function setImagen($imagen){
            // Elimina la imagen previa
            if( !is_null($this->id) ) {
                $this->borrarImagen();
            }

            // Asignar al atributo de imagen el nombre de la imagen
            if($imagen){
                $this->imagen = $imagen;
            }
        }

        // Elimina el archivo
        public function borrarImagen() {
            if(!is_null($this->imagen)){
                // Comprobar si existe el archivo
                $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

                if($existeArchivo) {
                    unlink(CARPETA_IMAGENES . $this->imagen);
                }
            }
        }

        public function validar() {
            if(!$this->titulo) {
                self::$errores[] = 'Debes colocar un título a la entrada';
            }

            if( strlen($this->contenido) < 500) {
                self::$errores[] = 'El contenido debe ser de al menos 500 caracteres';
            }

            if(!$this->imagen){
                self::$errores[] = 'La imagen es obligatoria';
            }
            if(!$this->usuarioId){
                self::$errores[] = 'El autor es obligatorio';
            }

            return self::$errores;
        }

        public function crear() {
            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            // Insertar en la base de datos
            $query = " INSERT INTO " . static::$tabla . " ( ";
            // array_keys obtiene las llaves del arreglo y con join los unimos en un string
            $query.= join(', ', array_keys($atributos));
            $query.= " ) VALUES (' "; 
            // array_values obtiene los valores del arreglo y con join los unimos en un string
            $query.= join("', '", array_values($atributos));
            $query.= " ') ";
    
            // Ya tenemos la conexión a la BD 
            // Hacemos referencia a la BD y le pasamos el query que formamos
            $resultado = self::$db->query($query);
    
            if($resultado){
                // Redireccionar al usuario
                header('Location: /blog/admin?resultado=1');
            }

        }

        public function actualizar() {
            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
            
            $valores = [];
            foreach($atributos as $key => $value) {
                $valores[] = "$key='$value'";
            }
            
            $query = "UPDATE " . static::$tabla . " SET ";
            $query.= join(', ', $valores);
            $query.= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 ";
    
            $resultado = self::$db->query($query);
    
            if($resultado) {
                // Redireccionar al usuario
                header('Location: /blog/admin?resultado=2');
            }
    
            return $resultado;
        }

        public function eliminar() {
            // Eliminar la propiedad
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    
            $resultado = self::$db->query($query);
            if($resultado) {
                $this->borrarImagen();
    
                header('Location: /blog/admin?resultado=3');
            }
        }
    }