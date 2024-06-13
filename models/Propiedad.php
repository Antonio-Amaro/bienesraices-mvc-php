<?php

    namespace Model;

    class Propiedad extends ActiveRecord{
        protected static $tabla = 'propiedades';
        protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
        
        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedorId;

        // El constructor recibe un argumento como parámetro por eso es que le pasamos $_POST
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedorId = $args['vendedorId'] ?? '';
        }
    
        // Valida y cuando alguna no se cumple, lo almacena en el arreglo del atributo $errores
        public function validar() {
            if(!$this->titulo) {
                self::$errores[] = 'Debes añadir un título';
            }

            if(strlen($this->titulo) > 100) {
                self::$errores[] = 'El título es demasiado largo';
            }

            if(!$this->precio) {
                self::$errores[] = 'El precio es obligatorio';
            }

            if(strlen($this->descripcion) < 50) {
                self::$errores[] = 'Debes añadir una descripción de al menos 50 caractéres';
            }

            if(!$this->habitaciones) {
                self::$errores[] = 'El número de habitaciones es obligatorio';
            }

            if(!$this->wc) {
                self::$errores[] = 'El número de baños es obligatorio';
            }

            if(!$this->estacionamiento) {
                self::$errores[] = 'El número de lugares de estacionamiento es obligatorio';
            }

            if(!$this->vendedorId) {
                self::$errores[] = 'Debes elegir un vendedor';
            }

            if(!$this->imagen){
                self::$errores[] = 'La imagen es obligatoria';
            }

            return self::$errores;
        }
    
    }