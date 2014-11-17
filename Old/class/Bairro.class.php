<?php
/**
 * Description of Bairro
 *
 * @author Bernardo.Novak
 */
class Bairro {
    
    private $ID;
    private $idCidade;
    private $nome;
    
    private $cidade;
    
    function __construct($ID = 0, $nome = '') {
        $this->setID($ID);
        $this->setNome($nome);
    }

    
    public function getID() {
        return $this->ID;
    }

    public function getIdCidade() {
        return $this->idCidade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
}
