<?php
/**
 * Description of Ponto
 *
 * @author Bernardo.Novak
 */
class Ponto {
    
    private $ID;
    private $idBairro;
    private $idTrajeto;
    private $nome;
    private $descricao;
    private $ativo;
    private $created;
    
    private $bairro;
    private $trajeto;
    
    public function getID() {
        return $this->ID;
    }

    public function getIdBairro() {
        return $this->idBairro;
    }

    public function getIdTrajeto() {
        return $this->idTrajeto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
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

    public function setIdBairro($idBairro) {
        $this->idBairro = $idBairro;
    }

    public function setIdTrajeto($idTrajeto) {
        $this->idTrajeto = $idTrajeto;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setCreated($created) {
        $this->created = $created;
    }
    
    public function getBairro() {
        return $this->bairro;
    }

    public function getTrajeto() {
        return $this->trajeto;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setTrajeto($trajeto) {
        $this->trajeto = $trajeto;
    }
}
