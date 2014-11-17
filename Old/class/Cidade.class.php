<?php
/**
 * Description of Cidade
 *
 * @author Bernardo.Novak
 */
class Cidade {
    
    private $ID;
    private $idUF;
    private $nome;
    
    private $UF;
    
    function __construct($ID = 0, $nome = '') {
        $this->setID($ID);
        $this->setNome($nome);
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getIdUF() {
        return $this->idUF;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getUF() {
        return $this->UF;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdUF($idUF) {
        $this->idUF = $idUF;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setUF($UF) {
        $this->UF = $UF;
    }


    
}
