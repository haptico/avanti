<?php
/**
 * Description of Veiculo
 *
 * @author Bernardo.Novak
 */
class Veiculo {
    
    private $ID;
    private $idTipoVeiculo;
    private $idUsuario;
    private $descricao;
    private $placa;
    private $vagas;
    private $ativo;
    private $created;
    
    private $usuario;
    private $tipoVeiculo;
    
    function __construct($ID = 0, $descricao = "", $placa = '', $vagas = '', $tipoVeiculo = '') {
        $this->setID($ID);
        $this->setDescricao($descricao);
        $this->setPlaca($placa);
        $this->setVagas($vagas);
        $this->setTipoVeiculo($tipoVeiculo);
    }

    
    public function getID() {
        return $this->ID;
    }

    public function getIdTipoVeiculo() {
        return $this->idTipoVeiculo;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPlaca() {
        return $this->placa;
    }

    public function getVagas() {
        return $this->vagas;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getTipoVeiculo() {
        return $this->tipoVeiculo;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdTipoVeiculo($idTipoVeiculo) {
        $this->idTipoVeiculo = $idTipoVeiculo;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setPlaca($placa) {
        $this->placa = $placa;
    }

    public function setVagas($vagas) {
        $this->vagas = $vagas;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setTipoVeiculo($tipoVeiculo) {
        $this->tipoVeiculo = $tipoVeiculo;
    }
}
