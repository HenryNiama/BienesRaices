<?php 

    require 'includes/config/database.php';

    $db = conectarBD();


    //Autenticar al usuario
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string( $db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string( $db, $_POST['password']);
    
        if (!$email) {
            $errores[] = "El email es obligatorio o no es valido.";
        }

        if (!$password) {
            $errores[] = "El password es obligatorio.";
        }

        // echo "<pre>";
        //  var_dump($errores);
        // echo "</pre>";
    

        //Si no hay errores, todo esta bien:
        if (empty($errores)) {

            //Revisar si el usuario existe
            $query = "SELECT * from usuarios WHERE email = '${email}';";

            $resultado = mysqli_query($db, $query);
            
                //var_dump($resultado);

            if ($resultado->num_rows) {//En caso de que haya resultados:, num_rows diferente de 0
                //Revisar si el password es correcto:
                //recuperamos la fila del query realizado>
                $usuario = mysqli_fetch_assoc($resultado);
                    //var_dump($usuario);
                
                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);//retorna TRUE or FALSE
                    //var_dump($auth);

                if ($auth) {
                    //El usuario esta autenticado
                    session_start();

                    //Llenar el arreglo de la sesion / va a estar activa todo el tiempo hasta que cerremos o expire la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    // echo "<pre>";
                    //     var_dump($_SESSION);
                    // echo "</pre>";

                    header('Location: /admin');

                }else{
                    $errores[] = 'El password es incorrecto';
                }

            }else{
                $errores[] = "El usuario no existe.";
            }
        }
    }






    //Incluye el header
    require 'includes/funciones.php';

    incluirTemplate('header');
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" novalidate>
            <fieldset>
                <legend>Email y Password</legend>

                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Tu email" id="email" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu password" id="password" required>
            </fieldset>

            <input type="submit" value="Sign In" class="boton boton-verde">
        </form>
    </main>


<?php 
    incluirTemplate('footer');
?>