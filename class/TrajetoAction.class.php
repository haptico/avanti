<?php

/**
 * @author paulista
 */
class UsuarioAction {
    
    public static function loadBean($row) {
        $obj= new Trajeto();
        $obj->setID($row["id_trajeto"]);
        $obj->setIdBairroOrigem($row["id_bairro_origem"]);
        $obj->setIdBairroDestino($row["id_bairro_destino"]);
        $obj->setHoraInicio($row["hora_inicio"]);
        $obj->setHorafim($row["hora_fim"]);
        $obj->setIdVeiculo($row["id_veiculo"]);
        $obj->setDescricao($row["descricao"]);
        $obj->setPrecoAvulso($row["preco_avulso"]);
        $obj->setPrecoMensalista($row["preco_mensalista"]);
        $obj->setAtivo($row["ativo"]);
        $obj->setCreated($row["created"]);
        
        if($obj->getIdBairroOrigem() > 0){
            $obj->setBairroOrigem(new Bairro($row['id_bairro_origem'], $row['nome_bairro_origem']));
        }
        if($obj->getIdBairroDestino() > 0){
            $obj->setBairroDestino(new Bairro($row['id_bairro_destino'], $row['nome_bairro_destino']));
        }
        if($obj->getIdVeiculo() > 0){
            $obj->setVeiculo(new Veiculo($row['id_veiculo'], $row['nome_veiculo']));
        }
        
        return $obj;
    }

    public static function getLista($idUsuario, $filtros = "") {
        $db = new Conexao();
        $SQL = "SELECT 
                    t.id AS id_trajeto, t.descricao, t.id_veiculo, t.hora_inicio, 
                    t.hora_fim, t.id_bairro_origem, t.id_bairro_destino,
                    t.preco_mensalista, t.preco_avulso, t.ativo, t.created, 
                    v.descricao as nome_veiculo, bo.nome as nome_bairro_origem, 
                    bd.nome as nome_bairro_destino
                FROM trajeto t
                    left join veiculo v on v.id = t.id_veiculo
                    left join bairro bo on bo.id = t.id_bairro_origem
                    left join bairro bd on bd.id = t.id_bairro_destino
                WHERE v.id_usuario = $idUsuario ";
        if ($filtros != "") {
            $SQL.= "and {$filtros}";
        }
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                $arrObj[] = self::loadBean($rs[$i]);
            }
        }
        return $arrObj;
    }

    public static function load($ID) {
        if (!$ID) {
            return NULL;
        }
        $db = new Conexao();
        $SQL = "SELECT 
                    t.id AS id_trajeto, t.descricao, t.id_veiculo, t.hora_inicio, 
                    t.hora_fim, t.id_bairro_origem, t.id_bairro_destino,
                    t.preco_mensalista, t.preco_avulso, t.ativo, t.created, 
                    v.descricao as nome_veiculo, bo.nome as nome_bairro_origem, 
                    bd.nome as nome_bairro_destino
                FROM trajeto t
                    left join veiculo v on v.id = t.id_veiculo
                    left join bairro bo on bo.id = t.id_bairro_origem
                    left join bairro bd on bd.id = t.id_bairro_destino
                WHERE t.id = $ID ";
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $obj = self::loadBean($rs[0]);
        }
        return $obj;
    }

    // grava/atualiza uma linha na tabela
    public static function gravar(Trajeto $objeto, $db = NULL) {
        if (is_null($db)) {
            $db = new Conexao();
        }
        if ($objeto->getID() > 0) {
            $SQL = "
                UPDATE trajeto SET
                    descricao = '" . Util::escapeOracle($objeto->getDescricao()) . "', 
                    id_veiculo = " . $objeto->getIdVeiculo() . ", 
                    id_bairro_origem = " . $objeto->getIdBairroOrigem() . ", 
                    id_bairro_destino = " . $objeto->getIdBairroDestino() . ", 
                    hora_inicio = '" . Util::escapeOracle($objeto->getHoraInicio()) . "',
                    hora_fim = '" . Util::escapeOracle($objeto->getHoraFim()) . "',
                    preco_mensalista = " . $objeto->getPrecoMensalista() . ",
                    preco_avulso = " . $objeto->getPrecoAvulso() . "
                WHERE id = " . $objeto->getID();
        } else {
            $SQL = "
                INSERT INTO trajeto ( 
                    descricao, id_veiculo, id_bairro_origem, id_bairro_destino, 
                    hora_inicio, hora_fim, preco_mensalista, preco_avulso
                ) VALUES(
                    '" . Util::escapeOracle($objeto->getDescricao()) . "', 
                    " . $objeto->getIdVeiculo() . ", 
                    " . $objeto->getIdBairroOrigem() . ", 
                    " . $objeto->getIdBairroDestino() . ", 
                    '" . Util::escapeOracle($objeto->getHoraInicio()) . "',
                    '" . Util::escapeOracle($objeto->getHoraFim()) . "',
                    " . $objeto->getPrecoMensalista() . ",
                    " . $objeto->getPrecoAvulso() . "
                )";
        }
        return $db->execute($SQL);
    }

    public static function getDataLista($post) {
        global $id_usuario_logado;
        $arrObject = self::getLista($id_usuario_logado);
        $strCorpoTabela = '';
        if (Util::arrayTemItens($arrObject)) {
            foreach ($arrObject as $object) {
                $bairroOrigem = ($object->getBairroOrigem() instanceof Bairro) ? $object->getBairroOrigem()->getNome() : 'N/D';
                $bairroDestino = ($object->getBairroDestino() instanceof Bairro) ? $object->getBairroDestino()->getNome() : 'N/D';
                $veiculo = ($object->getVeiculo() instanceof Veiculo) ? $object->getVeiculo()->getNome() : 'N/D';
                
                $strCorpoTabela .= <<<EOT
            <tr>
                <td style="width:60px;text-align: center"><img alt="Editar" src="img/edit.gif" style="cursor:pointer;" onclick="editar('{$object->getID()}')" /></td>
                <td>{$object->getDescricao()}</td>
                <td>{$veiculo}</td>
                <td>{$bairroOrigem}</td>
                <td>{$bairroDestino}</td>
                <td>{$object->getHoraInicio()}</td>
                <td>{$object->getHoraFim()}</td>
                <td>{$object->getPrecoMensalista()}</td>
                <td>{$object->getPrecoAvulso()}</td>
            </tr>
EOT;
            }
        }
        $data['corpo_tabela'] = $strCorpoTabela;
        return $data;
    }

    public static function getDataCadastro($ID) {
        if ($ID > 0) {
            $obj = self::load($ID);
            $data['ID'] = $obj->getID();
            $data['descricao'] = $obj->getDescricao();
            $data['id_veiculo'] = $obj->getIdVeiculo();
            $data['id_bairro_origem'] = $obj->getIdBairroOrigem();
            $data['id_bairro_destino'] = $obj->getIdBairroDestino();
            $data['hora_inicio'] = $obj->getHoraInicio();
            $data['hora_fim'] = $obj->getHoraFim();
            $data['preco_mensalista'] = $obj->getPrecoMensalista();
            $data['preco_avulso'] = $obj->getPrecoAvulso();
        } else {
            $data['ID'] = 0;
        }
        return $data;
    }

}
?>
