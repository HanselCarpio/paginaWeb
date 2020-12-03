<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="icon" type="image/png" href="/image/Imagen1.png" />
        <script type="text/javascript">
            history.forward();
        </script>
    </head>
    <body id="Login">
        <div id="login">
            <form action= "Menu.php" method="post">
                <label>Servidor: </label>
                <input type="text" name="server" required/><br>
                <label>Usuario: </label>
                <input type="text" name="user" required/><br>
                <label>Contraseña: </label>
                <input type="password" name="password" required/><br>
                <label>Host: </label>
                <input type="text" name="host" required/><br><br>
                <input type="submit" value="Enviar" id="boton"/>
            </form>
        </div>
    </body>

</html>
