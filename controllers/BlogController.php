<?php

namespace Controllers;
use MVC\Router;
use Model\Blog;
use Model\Usuario;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {

    public static function index(Router $router) {

        $entradas = Blog::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('blog/admin', [
            'entradas' => $entradas,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        
        $entrada = new Blog;
        $usuarios = Usuario::all();
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $entrada = new Blog($_POST['entrada']);

            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';

            // Realiza un resize a la imagen con intervention
            if($_FILES['entrada']['tmp_name']['imagen']){
                
                // Image es el alias que le dimos a Intervention\Image\ImageManagerStatic
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);

            }

            $errores = $entrada->validar();

            if(empty($errores)){
                /** Subida de arvhivos **/
                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $entrada->guardar();
            }

        }
        
        $router->render('blog/crear', [
            'entrada' => $entrada,
            'errores' => $errores,
            'usuarios' => $usuarios
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/blog/admin');
        $entrada = Blog::find($id);
        $usuarios = Usuario::all();

        // Obtenemos el arreglo de errores vacío y asignamos a variable para evitar undefined
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            // Asignar los atributos
            $args = $_POST['entrada'];
    
            $entrada->sincronizar($args);
            $errores = $entrada->validar();
    
            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
                
            // Realiza un resize a la imagen con intervention
            if($_FILES['entrada']['tmp_name']['imagen']){
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);
            }
    
            if(empty($errores)){
                if($_FILES['entrada']['tmp_name']['imagen']){
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $entrada->guardar();
            }
            
        }

        $router->render('blog/actualizar', [
            'entrada' => $entrada,
            'usuarios' => $usuarios,
            'errores' => $errores
        ]);
    }
    
    public static function eliminar(Router $router) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $entrada = Blog::find($id);
                $entrada->eliminar();
            }
        }
        
    }
}