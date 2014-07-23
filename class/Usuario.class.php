<?php

/**
 * Description of Usuario
 *
 * @author Bernardo.Novak
 */
class Usuario {

    private $ID = 0;
    private $idTipoUsuario;
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $telefone;
    private $celular;
    private $CPF;
    private $ativo;
    private $created;
    
    private $tipoUsuario;
    
    public function __construct($ID = 0, $nome = "", $sobrenome = "", $email = '', $tipoUsuario = "") {
        if ($ID > 0) {
            $this->setID($ID);
            $this->setNome($nome);
            $this->setSobrenome($sobrenome);
            $this->setEmail($email);
            $this->setTipoUsuario($tipoUsuario);
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
    
    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }
}
?>