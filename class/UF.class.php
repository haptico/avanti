<?php
/**
 * Description of UF
 *
 * @author Bernardo.Novak
 */
class UF {
    
    private $ID;
    private $nome;
    
    function __construct($ID = 0, $nome = '') {
        $this->setID($ID);
        $this->setNome($nome);
    }
    
    public function getID() {
        return $this->ID;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
}
