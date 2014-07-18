<?php

/**
 * Description of Usuario
 *
 * @author paulista
 */
class Usuario {

    private $ID = 0; //"ID_USUARIO"
    private $idTipoUsuario;
    private $nome; //"NOME"
    private $email; //"USUARIO"
    private $telefone;
    private $celular;
    private $CPF;
    private $ativo;
    
    
    public function __construct($ID = 0, $nome = "", $email = '') {
        if ($ID > 0) {
            $this->setID($ID);
            $this->setNome($nome);
            $this->setEmail($email);
        } else {
            $this->setID("NULL");
        }
    }

    public function getID() {
        return $this->ID;
    }

    public function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
    
    public function getCPF() {
        return $this->CPF;
    }

    public function setCPF($CPF) {
        $this->CPF = $CPF;
    }
}
?>