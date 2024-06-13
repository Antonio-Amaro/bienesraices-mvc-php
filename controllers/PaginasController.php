<?php

    namespace Controllers;

    use MVC\Router;
    use Model\Propiedad;
    use Model\Blog;
    use PHPMailer\PHPMailer\PHPMailer;

    class PaginasController{
        public static function index(Router $router) {
            
            $propiedades = Propiedad::get(3);
            $entradas = Blog::get(1);
            $inicio = true;

            $router->render('paginas/index', [
                'propiedades' => $propiedades,
                'entradas' => $entradas,
                'inicio' => $inicio
            ]);
        }

        public static function nosotros(Router $router) {
            
            $router->render('paginas/nosotros');
        }

        public static function propiedades(Router $router) {
            
            $propiedades = Propiedad::all();
            
            $router->render('paginas/propiedades', [
                'propiedades' => $propiedades
            ]);
        }

        public static function propiedad(Router $router) {
            $id = validarORedireccionar('/propiedades');
            
            $propiedad = Propiedad::find($id);
            
            $router->render('paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        }

        public static function blog(Router $router) {
            
            $entradas = Blog::all();

            $router->render('paginas/blog', [
                'entradas' => $entradas
            ]);

        }

        public static function entrada(Router $router) {
            
            $id = validarORedireccionar('/blog');
            $entrada = Blog::find($id);

            $router->render('paginas/entrada', [
                'entrada' => $entrada
            ]);
       
        }

        public static function contacto(Router $router) {
            
            $mensaje = null;
            $exitoso = null;

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $respuestas = $_POST['contacto'];

                // crear una instancia de phpmailer
                $mail = new PHPMailer();

                // Configurar el SMTP
                // Indicamos que usaremos SMTP para el envío de correos
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['EMAIL_USER'];
                $mail->Password = $_ENV['EMAIL_PASS'];
                $mail->SMTPSecure = 'tls';
                $mail->Port = $_ENV['EMAIL_PORT'];

                // Remitente (El que envía)
                $mail->setFrom('admin@bienesraices.com');
                // Destinatario
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
                // Asunto
                $mail->Subject = 'Tienes un nuevo mensaje';
                
                // Habilitar HTML
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                // Contenido
                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo mensaje</p>';
                $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
                $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
                $contenido .= '<p>Vende o compra: <strong>' . $respuestas['tipo'] . '</strong> </p>';
                $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . ' </p>';
                
                // Enviar de forma condicional algunos campos de email o telefono
                if($respuestas['contacto'] === 'telefono') {
                    $contenido .= '<p>Eligió ser contactado por Teléfono</p>';
                    $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
                    $contenido .= '<p>Fecha y hora de contacto: ' . $respuestas['fecha'] . ' ' . $respuestas['hora'] . 'hora/s </p>';
                } else {
                    $contenido .= '<p>Eligió ser contactado por E-mail</p>';
                    $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
                }

                $contenido .= '</html>';

                $mail->Body = $contenido;
                $mail->AltBody = 'Esto es texto alternativo';

                // Enviar el email
                if($mail->send()) {
                    $exitoso = true;
                    $mensaje = "Mensaje enviado correctamente";
                } else {
                    $exitoso = false;
                    $mensaje = "El mensaje no se pudo enviar";
                }

            }

            $router->render('paginas/contacto', [
                'mensaje' => $mensaje,
                'exitoso' => $exitoso
            ]);
        }
    }