<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

-->

<?php
session_start();
?>

<?php
if (isset($_SESSION['user']) && isset($_SESSION['password']) && isset($_SESSION['host'])) {
    include_once 'Ssh.php';
    include_once 'Data.php';
    include_once 'Historial.php';
    try {
        $ssh = new Ssh();
        $user = $_SESSION['user'];
        $password = $_SESSION['password'];
        $host = $_SESSION['host'];
        $server = $_SESSION['server'];
        $ssh->setSsh_user($user);
        $ssh->setSsh_password($password);
        $ssh->setSsh_host($host);
        $ssh->connect();
        $dateTime = new DateTime('now');
        $dateTime->setTimeZone(new DateTimeZone('America/Costa_Rica')); // Change to london time.
        $hora = $dateTime->format('l jS \of F Y  G:i:s A');
        $historial = new Historial();
        $data = new Data();
    } catch (Exception $e) {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }
    if (isset($_POST['comando'])) {
        $comm = $_POST['comando'];
        if ($server == "Linux" || $server == "linux" || $server == "UbuntuServer" || $server == "ubuntuserver") {
            if ($comm == "service --status-all" || $comm == "systemctl list-unit-files" || $comm == "systemctl list-unit-files --state=enabled") {
                $stream = $ssh->exec($comm);
                echo '<pre>';
                printf($stream);
                $historial->setUser($user);
                $historial->setComm($comm);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        } else if ($server == "Windows" || $server == "windows" || $server == "WindowsServer" || $server == "windowsserver") {
            if ($comm == "powerShell Get-Content roles.txt" || $comm == "powerShell Get-Content rolesInstall.txt") {

                $stream2 = $ssh->exec($comm);
                echo '<pre>';
                printf($stream2);
                $historial->setUser($user);
                $historial->setComm($comm);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        }
    } else if (isset($_POST['comando2'])) {
        $comm2 = $_POST['comando2'];
        if ($server == "Linux" || $server == "linux" || $server == "UbuntuServer" || $server == "ubuntuserver") {
            if ($comm2 == "ls -la") {
                $stream = $ssh->exec($comm2);
                echo '<pre>';
                printf($stream);
                $historial->setUser($user);
                $historial->setComm($comm2);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        } else if ($server == "Windows" || $server == "windows" || $server == "WindowsServer" || $server == "windowsserver") {
            if ($comm2 == "powerShell dir" || $comm2 == "powerShell ls" || $comm2 == "powerShell gci") {
                $stream = $ssh->exec($comm2);
                echo '<pre>';
                printf($stream);
                $historial->setUser($user);
                $historial->setComm($comm2);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        }
    } else if (isset($_POST['comando3'])) {
        $comm3 = $_POST['comando3'];
        if ($server == "Linux" || $server == "linux" || $server == "UbuntuServer" || $server == "ubuntuserver") {
            if ($comm3 == "top") {
                $stream = $ssh->execTop($comm3);
                echo '<pre>';
                $historial->setUser($user);
                $historial->setComm($comm3);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else if ($comm3 == "ps -e" || $comm3 == "ps -ef" || $comm3 == "ps -aux") {
                $stream = $ssh->execWin($comm3);
                echo '<pre>';
                $historial->setUser($user);
                $historial->setComm($comm3);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        } else if ($server == "Windows" || $server == "windows" || $server == "WindowsServer" || $server == "windowsserver") {
            if ($comm3 == "powerShell Tasklist") {
                $stream = $ssh->execWin($comm3);
                echo '<pre>';
                $historial->setUser($user);
                $historial->setComm($comm3);
                $historial->setTime($hora);
                $data->escribir($user, $historial);
                echo '</pre>';
            } else {
                echo "Comando invalido";
            }
        }
    } else if (isset($_POST['comando4'])) {
        $comm4 = $_POST['comando4'];
        if ($server == "Linux" || $server == "linux" || $server == "UbuntuServer" || $server == "ubuntuserver") {
            $stream = $ssh->execProcessLinux($comm4);
            echo '<pre>';
            $historial->setUser($user);
            $historial->setComm($comm4);
            $historial->setTime($hora);
            $data->escribir($user, $historial);
            echo '</pre>';
        } else if ($server == "Windows" || $server == "windows" || $server == "WindowsServer" || $server == "windowsserver") {
            $stream = $ssh->execProcess($comm4);
            echo '<pre>';
            $historial->setUser($user);
            $historial->setComm($comm4);
            $historial->setTime($hora);
            $data->escribir($user, $historial);
            echo '</pre>';
        }
    } else if (isset($_POST['comando5'])) {
        $comm5 = $_POST['comando5'];
        if ($server == "Linux" || $server == "linux" || $server == "UbuntuServer" || $server == "ubuntuserver") {
            $stream = $ssh->exec($comm5);
            echo '<pre>';
            echo "Se ejecutó el proceso " . $comm5;
            printf($stream);
            echo
            $historial->setUser($user);
            $historial->setComm($comm5);
            $historial->setTime($hora);
            $data->escribir($user, $historial);
            echo '</pre>';
        } else if ($server == "Windows" || $server == "windows" || $server == "WindowsServer" || $server == "windowsserver") {
            $stream = $ssh->exec($comm5);
            echo '<pre>';
            printf($stream);
            $historial->setUser($user);
            $historial->setComm($comm5);
            $historial->setTime($hora);
            $data->escribir($user, $historial);
            echo '</pre>';
        }
    } else if (isset($_POST['comando6'])) {
        echo '<pre>';
        $data->leer($user);
        echo '</pre>';
    } else if (isset($_POST['comando7'])) {
        $stream = $ssh->disconnect();
    }
} else {
    echo "<p>Error al acceder a cookie de sesión</p>\n";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comando</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" type="image/x-icon" href="/image/Imagen7.ico"/>
        <script type="text/javascript">
            history.forward();
        </script>
    </head>
    <body id="usuario">
        <div id="fondo1">
            <div id="fondo2">
                <form action= "Menu.php" method="POST">
                    <input type="hidden" name="server" value="<?php echo $server; ?>"/><br>
                    <input type="hidden" name="user" value="<?php echo $user; ?>"/><br>
                    <input type="hidden" name="password" value="<?php echo $password; ?>"/><br>
                    <input type="hidden" name="host" value="<?php echo $host; ?>"/><br>
                    <input type="submit" value="Regresar" id="boton1" onclick="goBack();"/>
                </form>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>


