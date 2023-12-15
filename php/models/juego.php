<?php
class Juego {

    private $conexion;
    
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
        $this->comprobarfilas();
    }

    public function comprobarfilas() {
    $query = "SELECT COUNT(*) as count FROM us_admin";
    $resultado = $this->conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $count = $fila['count'];

        if ($count == 0) {
            // No hay filas, crear superadmin
            $correo = 'admin';
            $nombre = 'admin';
            $contrasena = password_hash('admin', PASSWORD_DEFAULT); // Añadido PASSWORD_DEFAULT
            $query = "INSERT INTO us_admin (nombre, correo, pw, perfil) VALUES ('$nombre', '$correo', '$contrasena', 'admin')"; 
            $resultado = $this->conexion->query($query);
    
            if ($resultado) {
                return true;
            } else {
                return false;
            }
        }
    }
}

public function iniciarSesion($nombreUsuario, $contrasena) {
    $nombreUsuario = $this->conexion->real_escape_string($nombreUsuario);

    $query = "SELECT correo, pw , perfil FROM us_admin WHERE correo = '$nombreUsuario'";
    $resultado = $this->conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        return $resultado;
    } else {
       return false;
    }
}

public function crearAdmin($nombre, $correo, $contrasena) {
    $nombre = $this->conexion->real_escape_string($nombre);
    $correo = $this->conexion->real_escape_string($correo);
    // Encriptar la contraseña antes de almacenarla
    $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    $query = "INSERT INTO us_admin (nombre, correo, pw, perfil) VALUES ('$nombre', '$correo', '$contrasenaEncriptada', '2admin')";
    $resultado = $this->conexion->query($query);

    if ($resultado) {
        return true;
    } else {
        return false;
    }
}

public function crearUsuario($nombre, $correo, $contrasena) {
    $nombre = $this->conexion->real_escape_string($nombre);
    $correo = $this->conexion->real_escape_string($correo);
    // Encriptar la contraseña antes de almacenarla
    $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    $query = "INSERT INTO us_admin (nombre, correo, pw, perfil) VALUES ('$nombre', '$correo', '$contrasenaEncriptada', 'juego1')";
    $resultado = $this->conexion->query($query);

    if ($resultado) {
        return true;
    } else {
        return false;
    }
}

}