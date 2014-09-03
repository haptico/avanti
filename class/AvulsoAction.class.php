<?php
/**
 * Description of AvulsoAction
 *
 * @author Bernardo.Novak
 */
class AvulsoAction {
    
    public static function loadBean($row){
        $obj = new Avulso();
        $obj->setID($row['id_avulso']);
        $obj->setIdPonto($row['id_ponto']);
        $obj->setIdTrajeto($row['id_trajeto']);
        $obj->setIdUsuario($row['id_passageiro']);
        $obj->setData($row['data_avulso']);
        $obj->setValor($row['valor_pago']);
        
        if($obj->getIdUsuario() > 0){
            $obj->setUsuario(new Usuario($row['passageiro_id'], $row['passageiro_nome'], $row['passageiro_sobrenome']));
        }
        if($obj->getIdTrajeto() > 0){
            $obj->setTrajeto(TrajetoAction::loadBean($row));
        }
        if($obj->getIdPonto() > 0){
            //$obj->setPonto(new Ponto());
        }
        
        return $obj;
    }
    
    public static function getLista($idAvulso, $filtros = "") {
        $db = new Conexao();
        $SQL = "SELECT 
                    a.id AS id_avulso, a.id_usuario AS id_passageiro, a.data AS data_avulso, 
                    CONCAT('R$ ',format(a.valor, 2, 'pt_BR')) AS preco_pago,
                    t.id AS id_trajeto, t.descricao, t.id_veiculo, 
                    time_format(t.hora_inicio, '%H:%i') as hora_inicio, 
                    time_format(t.hora_fim, '%H:%i') as hora_fim, 
                    t.id_bairro_origem, t.id_bairro_destino,
                    concat('R$ ',format(t.preco_mensalista, 2,'pt_BR')) as preco_mensalista, 
                    concat('R$ ',format(t.preco_avulso, 2, 'pt_BR')) as preco_avulso, 
                    t.ativo, t.created, concat(tv.nome, ' - ', v.placa) as nome_veiculo, 
                    bo.nome as nome_bairro_origem, bd.nome as nome_bairro_destino,
                    v.id_usuario, CONCAT(u.nome,CONCAT(' ',u.sobrenome)) AS nome
                FROM avulso a
                    INNER JOIN trajeto t ON t.id = a.id_trajeto
                    INNER JOIN veiculo v on v.id = t.id_veiculo
                    INNER JOIN tipo_veiculo tv on tv.id = v.id_tipo_veiculo
                    INNER JOIN bairro bo on bo.id = t.id_bairro_origem
                    INNER JOIN bairro bd on bd.id = t.id_bairro_destino
                    INNER JOIN usuario u ON u.id = v.id_usuario
                WHERE a.id_usuario = $idAvulso ";
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
    
    public static function getDataLista($post) {
        global $id_usuario_logado;
        $arrObject = self::getLista(1);
        $strCorpoTabela = '';
        if (Util::arrayTemItens($arrObject)) {
            foreach ($arrObject as $object) {
                $objPonto = $object->getPonto();
                $objTrajeto = $object->getTrajeto();
                
                $bairroOrigem = 'N/D';
                $bairroDestino = 'N/D';
                $veiculo = 'N/D';
                $responsavel = 'N/D';
                $inicioTrajeto = 'N/D';
                $fimTrajeto = 'N/D';
                $preco = '';
                if($objTrajeto instanceof Trajeto){
                    $objVeiculo = $objTrajeto->getVeiculo();
                    
                    $inicioTrajeto = $objTrajeto->getHoraInicio();
                    $fimTrajeto = $objTrajeto->getHoraInicio();
                    $preco = $object->getPrecoMensalista();
                    $bairroOrigem = ($objTrajeto->getBairroOrigem() instanceof Bairro) ? $objTrajeto->getBairroOrigem()->getNome() : 'N/D';
                    $bairroDestino = ($objTrajeto->getBairroDestino() instanceof Bairro) ? $objTrajeto->getBairroDestino()->getNome() : 'N/D';
                    if($objVeiculo instanceof Veiculo){
                        $veiculo = $objVeiculo->getDescricao();
                        $responsavel = ($objVeiculo->getUsuario() instanceof Usuario)?$objVeiculo->getUsuario()->getNome():'N/D';
                    }
                }
                
                $strCorpoTabela .= <<<EOT
            <tr>
                <td>{$object->getData()}</td>
                <td>{$ponto}</td>
                <td>{$bairroOrigem}</td>
                <td>{$bairroDestino}</td>
                <td>{$veiculo}</td>
                <td>{$responsavel}</td>
                <td>{$inicioTrajeto}</td>
                <td>{$fimTrajeto}</td>
                <td>{$object->getValor()}</td>
            </tr>
EOT;
            }
        }
        $data['corpo_tabela'] = $strCorpoTabela;
        return $data;
    }
    
}
