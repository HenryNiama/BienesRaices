<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);

        $inicio = true;//Esta es para que se ubique el hero, de la pagina principal

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/public/propiedades');      
        
        //Buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        //Si quisiera hacer este blog importante, deberia agregar un nuevo modelo llamado Blog
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {//Si quisiera hacer el blog dinamico, esta entrada debe usar active record, y usar el metodo de find, aqui.
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Recoleccion de datos del formulario que lleno el usuario
            $respuestas = $_POST['contacto'];
            // debugear($respuestas);

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();//Le decimos que use este protocolo para el envio de mails.
            $mail->Host = 'smtp.mailtrap.io';//Este le copiamos de la pagina de mailtrap, en el codigo de Laravel en HOST
            $mail->SMTPAuth = true;//Le decimos que nos queremos autenticar.

            //Estas credenciales las copiamos de la pagina de Mailtrap
            $mail->Username = '3da1bb271badcb';
            $mail->Password = '837263d6fc53b0';

            $mail->SMTPSecure = 'tls';//Transport Layer Secure
            $mail->Port = 2525;//Le indicamos por el puerto que se va a comunicar


            //Configurar el Contenido del Email
            $mail->setFrom('admin@bienesraices.com');//Este es quien envia el emal.
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');//Este es a quien le llega el email. Es donde se recibe
            $mail->Subject = 'Tienes un nuevo mensaje'; //Esto es lo que el usuario va a leer.

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';//Muestra los acentos correctamente.
            
            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>'; 

            //Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por Teléfono: </p>'; 

                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>'; 
                $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . '</p>'; 
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>'; 

            }else{//Si es email, agregamos el campo de email
                $contenido .= '<p>Eligió ser contactado por E-mail: </p>'; 

                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>'; 
            }


            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>'; 
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>'; 
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . 'USD. </p>'; 
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>'; 

            $contenido .= '</html>';



            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el Email      
            if ($mail->send()) {//Retornar true or false
                $mensaje = "Mensaje enviado Correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar...";
            }

        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje 
        ]);
        
    }

}

?>