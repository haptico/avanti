<?php

/**
 * @author paulista
 */
class UsuarioAction {
    
    const MOTORISTA = "MOTORISTA";
    const PASSAGEIRO = "PASSAGEIRO";

    public static function loadBean($row) {
        $obj= new Usuario();
        $obj->setID($row["id_usuario"]);
        $obj->setIdTipoUsuario($row["id_tipo_usuario"]);
        $obj->setNome($row["nome"]);
        $obj->setSobrenome($row["sobrenome"]);
        $obj->setEmail($row["email"]);
        $obj->setCelular($row["celular"]);
        $obj->setTelefone($row["telefone"]);
        $obj->setCPF($row["cpf"]);
        $obj->setAtivo($row["ativo"]);
        
        if($obj->getIdTipoUsuario() > 0){
            //carregar tipo Usuario
        }
        
        return $obj;
    }

    public static function getList($filtros = "", $order = 'u.nome ASC') {
        $db = new Conexao();
        $SQL = "SELECT 
                    id AS id_usuario, nome, email, telefone, celular, ativo
                FROM usuario u
                WHERE 1=1 ";
        if ($filtros != "") {
            $SQL.= "{$filtros}";
        }
        $SQL.=" ORDER BY {$order}";
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                $arrObj[] = self::loadBean($rs[$i]);
            }
        }
        return $arrObj;
    }

    public static function load($ID, $isAdmin = false) {
        if (!$ID) {
            return NULL;
        }
        $db = new Conexao();
        $SQL = " 
            SELECT 
                u.id AS id_usuario, u.nome, u.email, u.telefone, u.celular, u.ativo,
                tu.id AS id_tipo_usuario, tu.nome AS tipo_usuario
            FROM usuario u  
                LEFT JOIN tipo_usuario tu ON tu.id = u.id_tipo_usuario
            WHERE u.id_usuario = " . Util::escapeOracle($ID) . " ";
        if (!$isAdmin) {
            $SQL .= " AND u.ativo = 1 ";
        }
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $obj = self::loadBean($rs[0]);
        }
        return $obj;
    }

    public static function doLogin($login, $pass) {
        $db = new Conexao();
        $SQL = " 
            SELECT 
                u.id AS id_usuario, u.nome, u.sobrenome, u.email, u.telefone, u.celular, u.ativo,
                tu.id AS id_tipo_usuario, tu.nome AS tipo_usuario
            FROM usuario u
                LEFT JOIN tipo_usuario tu ON tu.id = u.id_tipo_usuario
            WHERE UPPER(TRIM(u.email)) = UPPER(TRIM('".Util::escapeOracle($login)."'))
                AND u.senha = '" . Util::escapeOracle(md5($pass)) . "'";
        $arrGrupos = array();
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $obj = self::loadBean($rs[0]);
            $_SESSION['USERLOGADO'] = serialize($obj);
            return true;
        } else {
            return false;
        }
    }
    
    // grava/atualiza uma linha na tabela
    public static function gravar(Usuario $objeto, $db = NULL) {
        global $id_usuario_logado;
        if (is_null($db)) {
            $db = new Conexao();
        }
        $idInsert = $objeto->getID();
        if ($objeto->getID() > 0) {
            $SQL = "
                UPDATE usuario SET
                    nome = '" . Util::escapeOracle($objeto->getNome()) . "', 
                    email = '" . Util::escapeOracle($objeto->getEmail()) . "', 
                    telefone = '" . Util::escapeOracle($objeto->getTelefone()) . "',
                    celular = '" . Util::escapeOracle($objeto->getCelular()) . "',
                    cpf = '" . Util::escapeOracle($objeto->getCPF()) . "', 
                WHERE id = " . $objeto->getID();
        } else {
            $SQL = "
                INSERT INTO usuarios ( 
                    nome, sobrenome, email, telefone, celular, id_tipo_usuario,
                    senha, cpf
                ) VALUES(
                    '" . Util::escapeOracle($objeto->getNome()) . "',
                    '" . Util::escapeOracle($objeto->getSobrenome()) . "',
                    '" . Util::escapeOracle($objeto->getEmail()) . "',
                    '" . Util::escapeOracle($objeto->getTelefone()) . "',
                    '" . Util::escapeOracle($objeto->getCelular()) . "',
                    '" . Util::escapeOracle($objeto->getIdTipoUsuario()) . "',
                    '" . Util::escapeOracle(md5($objeto->getSenha())) . "',
                    '" . Util::escapeOracle($objeto->getCPF()) . "'
                )";
        }
        return $db->execute($SQL);
    }

    public static function isLogged() {
        $lastAccess = $_SESSION["lastAccess"];
        $now = time("d/m/Y G:i:s");
        $tempoTranscorrido = ($now - $lastAccess);
        if (isset($_SESSION["lastAccess"]) && ($tempoTranscorrido <= 300) && (unserialize($_SESSION['usuarioLogado']) instanceof Usuario)) {
            $_SESSION["lastAccess"] = $now;
            return true;
        } else {
            return false;
        }
    }

    public static function loadByEmail($email, $login, $isAdmin = false) {
        $db = new Conexao();
        $SQL = "
            SELECT id as id_usuario, nome, email, senha
            FROM usuario
            WHERE UPPER(TRIM(email)) = UPPER(TRIM('" . Util::escapeOracle($email) . "')) ";
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $objRetorno = new Usuario();
            $objRetorno->setID($rs[0]["id_usuario"]);
            $objRetorno->setNome($rs[0]["nome"]);
            $objRetorno->setEmail($rs[0]["email"]);
            $objRetorno->setSenha($rs[0]["senha"]);
        }
        return $objRetorno;
    }

    public static function resetarSenha($novaSenha, $ID) {
        $db = new Conexao();
        $SQL = "UPDATE usuarios SET ";
        $SQL .= " senha ='" . md5($novaSenha) . "'";
        $SQL .= " , data_alteracao = SYSDATE-30 ";
        //$SQL .= " , ativo=1 ";
        $SQL .= " WHERE id_usuario = '$ID'";
        return $db->execute($SQL);
    }

    public static function setAtivacao($ID, $ativacao) {
        $db = new Conexao();
        $ativ = ($ativacao == 'S') ? 1 : 0;
        $SQL = " UPDATE usuarios SET ativo = '{$ativ}' WHERE id_usuario = " . $ID;
        //Log
        return $db->execute($SQL);
    }
}
?>
