<?php
/**
 * Description of Acesso
 *
 * @author Bernardo.Novak
 */
class Acesso {
    private $ID;
    private $nome;
    private $arquivo;
    private $visivel;
    
    public function getID() {
        return $this->ID;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function getVisivel() {
        return $this->visivel;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function setVisivel($visivel) {
        $this->visivel = $visivel;
    }
    
}
