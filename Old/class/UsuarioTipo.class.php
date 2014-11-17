<?php
/**
 * Description of UsuarioTipo
 *
 * @author Bernardo.Novak
 */
class UsuarioTipo {
    private $ID;
    private $nome;
    private $ativo;
    private $created;
    
    function __construct($ID, $nome) {
        $this->setID($ID);
        $this->setNome($nome);
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getNome() {
        return $this->nome;
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

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setCreated($created) {
        $this->created = $created;
    }
}
