<?php

namespace Model;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // Definir la conexión a la BD. El método debe ser 'protected' al ser protected el atributo al que se va acceder
    public static function setDB($database) {
        // Asignamos la conexión al atributo $db
        self::$db = $database;
    }

    public function guardar() {
        if( !is_null($this->id) ) {
            $this->actualizar();
        } else {
            $this->crear();
        }
        
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
            header('Location: /admin?resultado=1');
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
            header('Location: /admin?resultado=2');
        }

        return $resultado;
    }

    // Eliminar un registro
    public function eliminar() {
        // Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();

            header('location: /admin?resultado=3');
        }
    }

    // Relacionar columnas de la BD con los atributos correspondientes
    public function atributos() {
        $atributos = [];

        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            // Columna tabla BD = Valor atributo de mismo nombre
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        
        $sanitizado = [];

        // Iterar en un arreglo asociativo con llave y valor
        foreach($atributos as $key => $value) {
            // LLave (columna BD) = Atributo sanitizado
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;
    }

    // Asignar imagen
    public function setImagen($imagen){
        // Elimina la imagen previa
        if( !is_null($this->id) ) {
            $this->borrarImagen();
        }

        // Asignar el nombre de la imagen al atributo de imagen 
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

    // Validación
    public static function getErrores() {
        // Retornamos el atributo de errores con su contenido
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todos los registros
    public static function all() {
        
        $query = " SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
        
    }

    // Obtiene determinado número de registros
    public static function get($cantidad) {
        
        $query = " SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
        
    }

    // Busca un registro por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );

    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;

    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    /* ---  METODO ALTERNATIVO PARA ACTIVE RECORD --- */
    // public static function all() {
        
    //     $query = " SELECT * FROM " . static::$tabla;

    //     $resultados = self::$db->query($query);

    //     $propiedades = [];
    //     foreach ($resultados as $registro) {
    //         $propiedades[] = new Propiedad($registro);
    //     }
    //     return $propiedades;
        
    // }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    
    public function sincronizar( $args = [] ) {
        foreach( $args as $key => $value ) {
            if( property_exists($this, $key) && !is_null($value) ) {
                $this->$key = $value;
            }
        }
    }
}