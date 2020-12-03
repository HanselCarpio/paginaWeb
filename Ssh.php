<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author Victor
 */
class Ssh {

// SSH Host
    private $host = '';
// SSH Port
    private $port = 22;
// SSH Username
    private $user = '';
// SSH Public Key File
    private $password = '';
// SSH Connection
    private $connection;

    public function connect() {
        $this->connection = ssh2_connect($this->host, $this->port);
        if (!$this->connection) {
            die('Connection failed');
        }

        if (ssh2_auth_password($this->connection, $this->user, $this->password)) {
            echo "<script>alert('Authentication Successful!\n')</script>";
        } else {
            die('Authentication Failed...');
        }
    }

    public function execTop($cmd) {
        if (!($stream = ssh2_shell($this->connection))) {
            throw new Exception('SSH command failed');
        }
        fwrite($stream, $cmd . PHP_EOL);
        sleep(1);
        while ($buf = stream_get_contents($stream)) {
            flush();
            echo '<pre>';
            echo $buf . "<br />";
            echo '</pre>';
        }
        fclose($stream);
        
    }

    public function execProcess($cmd) {
        if (!($stream = ssh2_shell($this->connection, 'xterm'))) {
            throw new Exception('SSH command failed');
        }
        fwrite($stream, $cmd . PHP_EOL);
        sleep(1);
        echo '<pre>';
        echo "Se esta ejecuntado el proceso " . $cmd;
        echo '</pre>';
        fclose($stream);
    }

    public function execWin($cmd) {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new Exception('SSH command failed');
        }
        stream_set_blocking($stream, true);
        $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        $output = stream_get_contents($stream_out);
        $file = fopen("archivo.txt", "w");
        sleep(2);
        fwrite($file, $output . PHP_EOL);

        $path_to_file = 'archivo.txt';
        file_put_contents($path_to_file, str_replace("ÿ", " ", file_get_contents($path_to_file)));
        $file2 = fopen("archivo.txt", "r");

        while (!feof($file2)) {
            echo '<pre>';
            echo fgets($file2) . "<br />";
            echo '</pre>';
        }
        fclose($file);
        fclose($stream);
    }
    
    public function execProcessLinux($cmd) {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new Exception('SSH command failed');
        }
        stream_set_blocking($stream, true);
        $data = "";
        while ($buf = fread($stream, 4096)) {
            $data .= $buf;
            echo '<pre>';
            echo "" . $data."\n";
            echo '</pre>';
        }
        fclose($stream);
    }

    public function exec($cmd) {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new Exception('SSH command failed');
        }
        stream_set_blocking($stream, true);
        $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        $output = stream_get_contents($stream_out);

        fclose($stream);
        return $output;
    }

    public function disconnect() {
        $this->exec('echo "EXITING" && exit;');
        $this->connection = null;
    }

    public function __destruct() {
        $this->disconnect();
    }

    function getSsh_user() {
        return $this->user;
    }

    function getSsh_pass() {
        return $this->password;
    }

    function setSsh_user($user): void {
        $this->user = $user;
    }

    function setSsh_password($password): void {
        $this->password = $password;
    }

    function getSsh_host() {
        return $this->host;
    }

    function setSsh_host($host): void {
        $this->host = $host;
    }

}

?>
