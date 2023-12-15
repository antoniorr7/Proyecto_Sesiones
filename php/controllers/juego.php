<?php
require_once '../php/models/juego.php';

class Controladorjuego {

    public $objJuego;
    public $pagina;
    public $view;

    public function __construct() {
        $this->view = 'login';
        $this->objJuego = new Juego(HOST, USER, PASSWORD, DATABASE, CHARSET);
    }
    public function sesion() {
        session_start();
    
        // Verificar si nombre de usuario o contraseña están vacíos
        if (empty($_POST['nombreUsuario']) || empty($_POST['contrasena'])) {
            // Nombre de usuario o contraseña vacíos, redirigir a login
            $this->view = 'antiguille';
            return;
        }
    
        $nombreUsuario = $_POST['nombreUsuario'];
        $contrasena = $_POST['contrasena'];
    
        $resultado = $this->objJuego->iniciarSesion($nombreUsuario, $contrasena);
    
        if ($resultado && $resultado->num_rows > 0) {
            // Inicio de sesión exitoso, obtener los datos del usuario
            $datosUsuario = $resultado->fetch_assoc();
    
            // Verificar la contraseña utilizando password_verify
            if (password_verify($contrasena, $datosUsuario['pw'])) {
                $_SESSION['nombre'] = $datosUsuario['correo'];
                $_SESSION['perfil'] = $datosUsuario['perfil'];
    
                switch ($_SESSION['perfil']) {
                    case 'admin':
                        $this->view = 'registraradmin';
                        break;
                    case 'juego1':
                        $this->view = 'juego1';
                        break;
                    case '2admin':
                        $this->view = 'admin';
                        break;
                    default:
                        // Perfil desconocido, destruir la sesión y redirigir a login
                        session_destroy();
                        $this->view = 'login';
                        break;
                }
            } else {
                // Contraseña incorrecta, redirigir a login
                $this->view = 'login';
            }
        }
    }
       
    

    public function crearAdmin() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombreUsuario"];
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];

            // Llama al método para crear un administrador
            $resultado = $this->objJuego->crearAdmin($nombre, $correo, $contrasena);

            if ($resultado) {
                echo "Administrador creado correctamente.";
            } else {
                echo "Error al crear el administrador.";
            }
        }
    }
    public function crearUsuario() {
        $this->view = 'registrarusuario';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombreUsuario"];
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];

            // Llama al método para crear un administrador
            $resultado = $this->objJuego->crearUsuario($nombre, $correo, $contrasena);

            if ($resultado) {
                echo "Usuario creado correctamente.";
            } else {
                echo "Error al crear el Usuario.";
            }
        }
        
    }
}
