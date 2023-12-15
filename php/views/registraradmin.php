<form action="index.php?action=crearAdmin&controller=juego" method="post">
    <label for="nombreUsuario">Nombre:</label>
    <input type="text" id="nombreUsuario" name="nombreUsuario" required>
    
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <input type="submit" value="Crear Administrador">
</form>
