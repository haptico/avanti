<?php
/**
 * Description of Avulso
 *
 * @author Bernardo.Novak
 */
class Avulso {
    
    private $ID;
    private $idUsuario;
    private $idTrajeto;
    private $idPonto;
    private $data;
    private $valor;
    
    private $usuario;
    private $trajeto;
    private $ponto;
    
    function __construct($ID = 0, $data = "", $valor = "") {
        $this->setID($ID);
        $this->setData($data);
        $this->setValor($valor);
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdTrajeto() {
        return $this->idTrajeto;
    }

    public function getIdPonto() {
        return $this->idPonto;
    }

    public function getData() {
        return $this->data;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIdTrajeto($idTrajeto) {
        $this->idTrajeto = $idTrajeto;
    }

    public function setIdPonto($idPonto) {
        $this->idPonto = $idPonto;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }

    public function getTrajeto() {
        return $this->trajeto;
    }

    public function getPonto() {
        return $this->ponto;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setTrajeto($trajeto) {
        $this->trajeto = $trajeto;
    }

    public function setPonto($ponto) {
        $this->ponto = $ponto;
    }
    
}
