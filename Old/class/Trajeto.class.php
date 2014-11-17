<?php
/**
 * Description of Trajeto
 *
 * @author Bernardo.Novak
 */
class Trajeto {
    
    private $ID;
    private $idVeiculo;
    private $idBairroOrigem;
    private $idBairroDestino;
    private $descricao;
    private $horaInicio;
    private $horaFim;
    private $precoMensalista;
    private $precoAvulso;
    private $ativo;
    private $created;
    
    private $veiculo;
    private $bairroOrigem;
    private $bairroDestino;
    
    public function getID() {
        return $this->ID;
    }

    public function getIdVeiculo() {
        return $this->idVeiculo;
    }

    public function getIdBairroOrigem() {
        return $this->idBairroOrigem;
    }

    public function getIdBairroDestino() {
        return $this->idBairroDestino;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getHoraFim() {
        return $this->horaFim;
    }

    public function getPrecoMensalista() {
        return $this->precoMensalista;
    }

    public function getPrecoAvulso() {
        return $this->precoAvulso;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdVeiculo($idVeiculo) {
        $this->idVeiculo = $idVeiculo;
    }

    public function setIdBairroOrigem($idBairroOrigem) {
        $this->idBairroOrigem = $idBairroOrigem;
    }

    public function setIdBairroDestino($idBairroDestino) {
        $this->idBairroDestino = $idBairroDestino;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    public function setHoraFim($horaFim) {
        $this->horaFim = $horaFim;
    }

    public function setPrecoMensalista($precoMensalista) {
        $this->precoMensalista = $precoMensalista;
    }

    public function setPrecoAvulso($precoAvulso) {
        $this->precoAvulso = $precoAvulso;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setCreated($created) {
        $this->created = $created;
    }
    
    public function getVeiculo() {
        return $this->veiculo;
    }

    public function getBairroOrigem() {
        return $this->bairroOrigem;
    }

    public function getBairroDestino() {
        return $this->bairroDestino;
    }

    public function setVeiculo($veiculo) {
        $this->veiculo = $veiculo;
    }

    public function setBairroOrigem($bairroOrigem) {
        $this->bairroOrigem = $bairroOrigem;
    }

    public function setBairroDestino($bairroDestino) {
        $this->bairroDestino = $bairroDestino;
    }
}
