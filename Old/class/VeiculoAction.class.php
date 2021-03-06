<?php
/**
 * Description of VeiculoAction
 *
 * @author Bernardo.Novak
 */
class VeiculoAction {
    
    public static function loadBean($row){
        $obj = new Veiculo();
        $obj->setID($row['id_veiculo']);
        $obj->setPlaca($row['placa']);
        $obj->setVagas($row['vagas']);
        $obj->setDescricao($row['descricao_veiculo']);
        $obj->setCreated($row['created_veiculo']);
        $obj->setAtivo($row['ativo_veiculo']);
        $obj->setQtdeTrajetos($row['qtde_trajetos']);
        
        $obj->setIdUsuario($row['id_usuario']);
        $obj->setIdTipoVeiculo($row['id_tipo_veiculo']);
        
        
        if($obj->getIdUsuario() > 0){
            $obj->setUsuario(new Usuario($row['id_usuario'], $row['nome']));
        }
        if($obj->getIdTipoVeiculo() > 0){
            $obj->setVeiculoTipo(new VeiculoTipo($row['id_tipo_veiculo'], $row['nome_tipo_veiculo']));
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
    
    public static function getLista($idResponsavel = 0) {
        $db = new Conexao();
        $SQL = "SELECT 
                    v.id AS id_veiculo, v.descricao as descricao_veiculo, v.placa, v.vagas, 
                    v.created AS created_veiculo, v.ativo AS ativo_veiculo,
                    vt.id AS id_tipo_veiculo, vt.nome AS nome_tipo_veiculo,
                    u.id AS id_usuario, u.nome,
                    COUNT((CASE WHEN t.id > 0 THEN 1 ELSE NULL END)) qtde_trajetos
                FROM veiculo v
                    INNER JOIN tipo_veiculo vt ON vt.id = v.id_tipo_veiculo
                    LEFT JOIN usuario u ON u.id = v.id_usuario
                    LEFT JOIN trajeto t ON t.id_veiculo = v.id
                WHERE 1 = 1";
            if($idResponsavel > 0){
                $SQL .= " AND v.id_usuario = ".$idResponsavel;
            }
        $rs = $db->geraMatriz($SQL);
        if (Util::arrayTemItens($rs)) {
            foreach ($rs as $row) {
                $arrObj[] = self::loadBean($row);
            }
        }
        return $arrObj;
    }
    
    public static function gravar(Veiculo $objeto, $db = NULL) {
        global $dadosUsuarioAvanti;
        
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
                    '".Util::escapeOracle($dadosUsuarioAvanti->getID())."',
                    'S'
                )";
        }
        return $db->execute($SQL);
    }
    
    public static function getDataCadastro($ID) {
        if ($ID > 0) {
            $obj = self::load($ID);
            $data['ID'] = $obj->getID();
            $data['id_tipo_veiculo'] = $obj->getIdTipoVeiculo();
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
        global $dadosUsuarioAvanti;
        
        $arrObject = self::getLista($dadosUsuarioAvanti->getID());
        $strCorpoTabela = '';
        if (Util::arrayTemItens($arrObject)) {
            foreach ($arrObject as $object) {
                $tipoVeiculo = ($object->getVeiculoTipo() instanceof VeiculoTipo) ? $object->getVeiculoTipo()->getNome() : 'N/D';
                $usuario = ($object->getUsuario() instanceof Usuario) ? $object->getUsuario()->getNome() : 'N/D';
                
                if($object->getAtivo() == "S"){
                    $ativacao = "<img src=\"img/img_sinalVerde.gif\" id=\"imgBanner_".$object->getID()."\" style=\"cursor:pointer;\" alt=\"Ativa\" onclick=\"setAtivacao('".$object->getID()."')\" />";
                }else{
                    $ativacao = "<img src=\"img/img_sinalVermelho.gif\" id=\"imgBanner_".$object->getID()."\" style=\"cursor:pointer;\" alt=\"Desativa\" onclick=\"setAtivacao('".$object->getID()."')\" />";
                }
                if($object->getQtdeTrajetos() == 0){
                    $excluir = "<img alt=\"Excluir\" src=\"img/delete.gif\" style=\"cursor:pointer;\" onClick=\"confirmaExclusao(".$object->getID().",'".$object->getDescricao()."')\" />";
                }
                $strCorpoTabela .= <<<EOT
            <tr>
                <td style="width:60px;text-align: center"><img alt="Editar" src="img/edit.gif" style="cursor:pointer;" onclick="navega('cadastro','','{$object->getID()}')" /></td>
                <td style="width:60px;text-align: center">{$ativacao}</td>
                <td style="width:60px;text-align: center">{$excluir}</td>
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
        $SQL = "select v.id as chave, concat(t.nome, ' - ', v.placa) as valor
                from veiculo v
                    inner join tipo_veiculo t on t.id = v.id_tipo_veiculo
                    inner join usuario u on u.id = v.id_usuario and u.id = 1";
        $strCombobox = Util::getComboBySQL($SQL, $IDSelected);
        return $strCombobox;
    }
    
    public static function excluir($ID){
        $db = new Conexao();
        $SQL = "DELETE FROM veiculo WHERE id = ".$ID;
        return $db->execute($SQL);
    }
    
    public static function setAtivacao($ID, $indAtivacao){
        $db = new Conexao();
        $SQL = "UPDATE veiculo SET ativo = '$indAtivacao' WHERE id = ".$ID;
        return $db->execute($SQL);
    }
}
