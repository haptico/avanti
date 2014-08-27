<?php
/**
 * Description of VeiculoAction
 *
 * @author Bernardo.Novak
 */
class VeiculoAction {
    
    public static function loadBean($row){
        $obj = new Veiculo();
        $obj->setPlaca($row['placa']);
        $obj->setVagas($row['vagas']);
        $obj->setDescricao($row['descricao_veiculo']);
        $obj->setCreated($row['created_veiculo']);
        $obj->setAtivo($row['ativo_veiculo']);
        
        $obj->setIdUsuario($row['id_usuario']);
        $obj->setIdTipoVeiculo($row['id_tipo_veiculo']);
        
        
        if($obj->getIdUsuario() > 0){
            $obj->setUsuario(new Usuario($row['id_usuario'], $row['nome']));
        }
        if($obj->getIdVeiculoTipo() > 0){
            $obj->setTipoVeiculo(new VeiculoTipo($row['id_veiculo_tipo'], $row['nome_veiculo_tipo']));
        }
        
        return $obj;
    }
    
    public static function load($ID) {
        if (!$ID) {
            return NULL;
        }
        $db = new Conexao();
        $SQL = "SELECT 
                    v.id AS id_veiculo, v.descricao as descricao_veiculo, v.placa, v.vagas, 
                    v.created AS created_veiculo, v.ativo AS ativo_veiculo,
                    vt.id AS id_tipo_veiculo, vt.nome AS nome_tipo_veiculo,
                    u.id AS id_usuario, u.nome
                FROM veiculo v
                    INNER JOIN tipo_veiculo vt ON vt.id = v.id_tipo_veiculo
                    left join usuario u on u.id = v.id_usuario
                WHERE v.id = $ID ";
        $rs = $db->geraMatriz($SQL);
        if (Util::arrayTemItens($rs)) {
            $obj = self::loadBean($rs[0]);
        }
        return $obj;
    }
    
    public static function getLista() {
        $db = new Conexao();
        $SQL = "SELECT 
                    v.id AS id_veiculo, v.descricao as descricao_veiculo, v.placa, v.vagas, 
                    v.created AS created_veiculo, v.ativo AS ativo_veiculo,
                    vt.id AS id_tipo_veiculo, vt.nome AS nome_tipo_veiculo,
                    u.id AS id_usuario, u.nome
                FROM veiculo v
                    INNER JOIN tipo_veiculo vt ON vt.id = v.id_tipo_veiculo
                    left join usuario u on u.id = v.id_usuario";
        $rs = $db->geraMatriz($SQL);
        if (Util::arrayTemItens($rs)) {
            foreach ($rs as $row) {
                $arrObj[] = self::loadBean($row);
            }
        }
        return $arrObj;
    }
    
    public static function gravar(Veiculo $objeto, $db = NULL) {
        if (is_null($db)) {
            $db = new Conexao();
        }
        if ($objeto->getID() > 0) {
            $SQL = "
                UPDATE veiculo SET
                    id_tipo_veiculo = '" . Util::escapeOracle($objeto->getIdTipoVeiculo()) . "',
                    placa = '" . Util::escapeOracle($objeto->getPlaca()) . "',
                    vagas = '" . Util::escapeOracle($objeto->getVagas()) . "',
                    descricao = '" . Util::escapeOracle($objeto->getDescricao()) . "'
                WHERE id = " . $objeto->getID();
        } else {
            $SQL = "
                INSERT INTO veiculo ( 
                    id_tipo_veiculo, placa, vagas, descricao,
                    id_usuario, ativo
                ) VALUES(
                    '" . Util::escapeOracle($objeto->getIdTipoVeiculo()) . "', 
                    '" . Util::escapeOracle($objeto->getPlaca()) . "', 
                    '" . Util::escapeOracle($objeto->getVagas()) . "', 
                    '" . Util::escapeOracle($objeto->getDescricao()) . "',
                    '".Util::escapeOracle(1)."',
                    'S'
                )";
        }
        return $db->execute($SQL);
    }
    
    public static function getDataCadastro($ID) {
        if ($ID > 0) {
            $obj = self::load($ID);
            $data['ID'] = $obj->getID();
            $data['id_tipo_veiculo'] = $obj->getID();
            $data['placa'] = $obj->getPlaca();
            $data['vagas'] = $obj->getVagas();
            $data['descricao_veiculo'] = $obj->getDescricao();
        } else {
            $data['ID'] = 0;
            $data['id_tipo_veiculo'] = '';
        }
        
        $data['comboTipoVeiculo'] = VeiculoTipoAction::getComboBox($data['id_tipo_veiculo']);
        
        return $data;
    }
    
    public static function getDataLista($post) {
        global $id_usuario_logado;
        $arrObject = self::getLista();
        $strCorpoTabela = '';
        if (Util::arrayTemItens($arrObject)) {
            foreach ($arrObject as $object) {
                $tipoVeiculo = ($object->getVeiculoTipo() instanceof VeiculoTipo) ? $object->getVeiculoTipo()->getNome() : 'N/D';
                $usuario = ($object->getUsuario() instanceof Usuario) ? $object->getUsuario()->getNome() : 'N/D';
                
                if($object->getAtivo() == "S"){
                    $ativacao = "<img src=\"../img/img_sinalVerde.gif\" id=\"imgBanner_".$object->getID()."\" style=\"cursor:pointer;\" alt=\"Ativa\" onclick=\"setAtivacao('".$object->getID()."')\" />";
                }else{
                    $ativacao = "<img src=\"../img/img_sinalVermelho.gif\" id=\"imgBanner_".$object->getID()."\" style=\"cursor:pointer;\" alt=\"Desativa\" onclick=\"setAtivacao('".$object->getID()."')\" />";
                }
                $excluir = "<img alt=\"Excluir\" src=\"../img/delete.gif\" style=\"cursor:pointer;\" onClick=\"confirmaExclusao(".$object->getID().",'".$object->getDescricao()."')\" />";
                
                $strCorpoTabela .= <<<EOT
            <tr>
                <td style="width:60px;text-align: center"><img alt="Editar" src="img/edit.gif" style="cursor:pointer;" onclick="editar('{$object->getID()}')" /></td>
                <td style="width:60px;text-align: center">{$ativacao}</td>
                <td style="width:60px;text-align: center">{$excluir}</td>
                <td>{$usuario}</td>
                <td>{$tipoVeiculo}</td>
                <td>{$object->getPlaca()}</td>
                <td>{$object->getVagas()}</td>
            </tr>
EOT;
            }
        }
        $data['corpo_tabela'] = $strCorpoTabela;
        return $data;
    }

    public static function getCombobox($IDSelected = ""){
        global $id_usuario_logado;
        $SQL = "select v.id as chave, concat(t.nome, ' - ', v.placa) as valor
                from veiculo v
                    inner join tipo_veiculo t on t.id = v.id_tipo_veiculo
                    inner join usuario u on u.id = v.id_usuario and u.id = 1";
        $strCombobox = Util::getComboBySQL($SQL, $IDSelected);
        return $strCombobox;

    }
    
}
