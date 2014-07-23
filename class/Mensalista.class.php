<?php
/**
 * Description of Mensalista
 *
 * @author Bernardo.Novak
 */
class Mensalista {
    
    private $ID;
    private $idUsuario;
    private $idTrajeto;
    private $idPonto;
    private $dataInicio;
    private $dataFim;
    
    private $usuario;
    private $trajeto;
    private $ponto;
    
    function __construct($dataInicio, $dataFim) {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
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

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
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

    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
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
