<?php

    namespace MVC;

    class Router {

        public $rutasGET = [];
        public $rutasPOST = [];

        public function get($url, $fn) {
            // Almacenamos la ruta/url en el atributo $rutasGET y le asignamos la función deseada
            $this->rutasGET[$url] = $fn;
            
        }

        public function post($url, $fn) {
            // Almacenamos la ruta/url en el atributo $rutasGET y le asignamos la función deseada
            $this->rutasPOST[$url] = $fn;   
        }

        // Hacer la comprobación de dónde nos encontramos (página/ruta)
        public function comprobarRutas() {

            session_start();

            $auth = $_SESSION['login'] ?? null;

            $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar' ];

            $urlActual = strtok( $_SERVER['REQUEST_URI'], '?' ) ?? '/';
            $metodo = $_SERVER['REQUEST_METHOD'];

            if($metodo === 'GET') {
                // Le pasamos la $urlActual para que se ejecute solamente la función asociada a esa url de todas las que tenemos
                $fn = $this->rutasGET[$urlActual] ?? null;
            } else { // EN PHP SOLO EXISTE GET Y POST
                $fn = $this->rutasPOST[$urlActual] ?? null;
            }

            // Proteger las rutas
            if(in_array($urlActual, $rutas_protegidas) && !$auth) {
                header('Location: /');
            } else if($urlActual === "/login" && $auth){
                header('Location: /');
            }

            // Comprobar que la url existe y hay una función asociada
            if($fn) {

                // Esta función se usa cuando no sabes como se llama la función que vas a llamar
                call_user_func($fn, $this);

            } else {
                echo "Página no encontrada";
            }
        }

        // Muestra una vista
        public function render($view, $datos = []) {

            foreach($datos as $key => $value) {
                // El doble signo es para formar una variable apartir del nombre del $key
                $$key = $value;
            }
            
            // Esta función almacena en memoria la sig línea de código (Lo que queremos renderizar)
            ob_start();
            include __DIR__ . "/views/$view.php";

            // Lo almacena en la variable y limpia la memoria
            $contenido = ob_get_clean();

            // La plantilla que tendrá el contenido a mostrar
            include __DIR__ . "/views/layout.php";
        }
    }