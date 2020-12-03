
<!--
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
-->

<?php

class Historial implements JsonSerializable{

    private $user ;
    private $comm ;
    private $time ;
    
    function __construct() {
        $this->user='';
        $this->comm='';
        $this->time='';
    }

    public function getUser() {
        return $this->user;
    }

    public function getComm() {
        return $this->comm;
    }

    public function getTime() {
        return $this->time;
    }

    public function setUser($user): void {
        $this->user = $user;
    }

    public function setComm($comm): void {
        $this->comm = $comm;
    }

    public function setTime($time): void {
        $this->time = $time;
    }

    public function jsonSerialize() {
        return 
        [
            'Usuario'   => $this->getUser(),
            'Comando' => $this->getComm(),
            'Fecha-Hora de ingreso' => $this->getTime()
        ];
    }

}
?>

