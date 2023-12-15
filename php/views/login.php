<form action="index.php?action=sesion&controller=juego" method="post">
    <label for="nombreUsuario">Correo:</label>
    <input type="text" id="nombreUsuario" name="nombreUsuario" required>
    
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    
    <input type="submit" value="Iniciar Sesión">
    
    <!-- Botón alternativo para ir a la página de registro -->
    <a href="index.php?action=crearusuario&controller=juego">Registrarse</a>
</form>
