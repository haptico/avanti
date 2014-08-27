<?php

/**
 *
 * @author Bruno Rossetto
 */
class VeiculoAction {
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
