<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class PropiedadController {

        // Toma la instancia del router definida anteriormente en index.php
        public static function index(Router $router) {

            $propiedades = Propiedad::all();
            $vendedores = Vendedor::all();
            
            // Muestra mensaje condicional
            $resultado = $_GET['resultado'] ?? null;
            
            // Le pasamos la ruta del contenido que queremos renderizar(mostrar)
            $router->render('propiedades/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores
            ]);

        }

        public static function crear(Router $router) {
            
            $propiedad = new Propiedad;
            $vendedores = Vendedor::all();

            // Obtenemos el arreglo de errores vacío y asignamos a variable para evitar undefined
            $errores = Propiedad::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                // Crea una nueva instancia. Le pasamos el arreglo de $_POST que contiene los datos del formulario
                $propiedad = new Propiedad($_POST['propiedad']);
        
                // Generar un nombre único para la imagen
                $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
        
                // Realiza un resize a la imagen con intervention\Image
                if($_FILES['propiedad']['tmp_name']['imagen']){
        
                    // Image es el alias que le dimos a Intervention\Image\ImageManagerStatic
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
        
                }
        
                // Validar que los campos no estén vacíos
                $errores = $propiedad->validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // Crear la carpeta para subir imagenes
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
        
                    // Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                    // Guarda instancia (propiedad) en la base de datos
                    $propiedad->guardar();
                
                }
        
                
            }

            $router->render('propiedades/crear', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router) {

            $id = validarORedireccionar('/admin');
            $propiedad = Propiedad::find($id);
            $vendedores = Vendedor::all();

            // Obtenemos el arreglo de errores vacío y asignamos a variable para evitar undefined
            $errores = Propiedad::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                // Asignar los atributos
                $args = $_POST['propiedad'];
        
                $propiedad->sincronizar($args);
        
                $errores = $propiedad->validar();
        
                // Subida de archivos
                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
                    
                // Realiza un resize a la imagen con intervention
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                }
        
                if(empty($errores)){
                    if($_FILES['propiedad']['tmp_name']['imagen']){
                        // Almacenar la imagen
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    
                    $propiedad->guardar();
                }
                
            }

            $router->render('/propiedades/actualizar', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function eliminar() {

            if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

                // Validar ID
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if($id){
        
                    $tipo = $_POST['tipo'];
        
                    if( validarTipoContenido($tipo) ) {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    }            
        
                }
            }

        }
    }