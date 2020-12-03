<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" type="image/x-icon" href="/image/Imagen2.ico" />
        <script type="text/javascript">
            history.forward();
        </script>
    </head>
    <body id="Menu">
        <div id="menu">
            <nav>
                <ul>
                    <li><a href="#">Listar Roles</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <label>Comando: </label>
                                <input type="text" name="comando"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Listar Carpetas y Ficheros</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <label>Comando: </label>
                                <input type="text" name="comando2"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Monitor procesos</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <label>Comando: </label>
                                <input type="text" name="comando3"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Lanzar procesos</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <label>Comando: </label>
                                <input type="text" name="comando4"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Señal procesos</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <label>Comando: </label>
                                <input type="text" name="comando5"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Historial</a>
                        <div>
                            <form action= "Comandos.php" method="POST">
                                <input type="hidden" name="comando6" value="<?php echo $_POST['user'] ?>"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                    <li><a href="#">Desconectar</a>
                        <div>
                            <form action= "index.php" method="POST">
                                <input type="hidden" name="comando7"/><br>
                                <input type="submit" value="Enviar" id="boton"/>
                            </form>
                        </div>
                    </li>

                </ul>
            </nav>
            <?php
            // put your code here
            include_once 'Ssh.php';
            try {
                $user = $_POST['user'];
                $password = $_POST['password'];
                $host = $_POST['host'];
                $server = $_POST['server'];
                $ssh = new Ssh();
                $ssh->setSsh_user($user);
                $ssh->setSsh_password($password);
                $ssh->setSsh_host($host);
                $ssh->connect();
                $_SESSION['server'] = $server;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['host'] = $host;
            } catch (Exception $e) {
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
            }
            ?>
    </body>
</html>
