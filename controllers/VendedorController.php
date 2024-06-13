<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class VendedorController {

        public static function index(Router $router) {

            $vendedores = Vendedor::all();
            
            // Muestra mensaje condicional
            $resultado = $_GET['resultado'] ?? null;
            
            // Le pasamos la ruta del contenido que queremos renderizar(mostrar)
            $router->render('vendedores/admin', [
                'vendedores' => $vendedores,
                'resultado' => $resultado
            ]);

        }

        public static function crear(Router $router) {

            $vendedor = new Vendedor;

            // Obtenemos el arreglo de errores vacío y asignamos a variable para evitar undefined
            $errores = Vendedor::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $vendedor = new Vendedor($_POST['vendedor']);

                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';

                // setear la imagen
                // Realiza un resize a la imagen con intervention
                if($_FILES['vendedor']['tmp_name']['imagen']){

                    // Image es el alias que le dimos a Intervention\Image\ImageManagerStatic
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(600,800);
                    $vendedor->setImagen($nombreImagen);

                }

                $errores = $vendedor->validar();

                // No hay errores
                if(empty($errores)){

                    // Crear la carpeta para subir imagenes
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }

                    // Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);

                    // Guarda en la base de datos
                    
                    $vendedor->guardar();
                
                }


            }

            $router->render('/vendedores/crear', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);

        }

        public static function actualizar(Router $router) {

            $id = validarORedireccionar('/admin');
            $vendedor = Vendedor::find($id);

            // Obtenemos el arreglo de errores vacío y asignamos a variable para evitar undefined
            $errores = Vendedor::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                // Asignar valores
                $args = $_POST['vendedor'];
        
                // Sincronizar el objeto en memoria
                $vendedor->sincronizar($args);
        
                // Subida de archivos
                // Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
                    
                // Realiza un resize a la imagen con intervention
                if($_FILES['vendedor']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(600,800);
                    $vendedor->setImagen($nombreImagen);
                }
        
                $errores = $vendedor->validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
                    if($_FILES['vendedor']['tmp_name']['imagen']){
                        // Almacenar la imagen
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    
                    $vendedor->guardar();
                
                }
            }

            $router->render('/vendedores/actualizar', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);

        }

        public static function eliminar() { // Eliminar no requiere importar el router ya que no se va a renderizar nada

            if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

                // Validar ID
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if($id){
        
                    $tipo = $_POST['tipo'];
        
                    if( validarTipoContenido($tipo) ) {
                        $vendedor = Vendedor::find($id);
                        $vendedor->eliminar();
                    }            
        
                }
            }

        }

    }