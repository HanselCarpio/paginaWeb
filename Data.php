
<!--
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<?php
include_once 'Historial.php';

class Data {

    private $Histotial;

    function __construct() {
        $this->Histotial = new Historial();
    }

    public function escribir($archivo, $historial) {
        $content = json_encode($historial);
        $file = fopen($archivo . ".txt", "a");
        fwrite($file, $content . PHP_EOL);
        file_put_contents($archivo . ".txt", str_replace("{", " ", file_get_contents($archivo . ".txt")));
        file_put_contents($archivo . ".txt", str_replace("}", " ", file_get_contents($archivo . ".txt")));
        fclose($file);
    }

    public function leer($archivo) {
        if (file_exists($archivo.".txt")) {
            $fp = fopen($archivo . ".txt", "r");
            while (!feof($fp)) {
                $linea = fgets($fp);
                echo '<span style="color:black; font-size:15px;">' . $linea . "\n" . "\n" . '</span>';
            }
            fclose($fp);
        } else {
            echo "El fichero $archivo.txt no existe";
        }
    }

}
?>

