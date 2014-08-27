<?php

/**
 *
 * @author Bruno Rossetto
 */
class VeiculoAction {
    public static function getCombobox($IDSelected = ""){
        $strCombobox = Util::getCombobox('descricao', 'id', 'veiculo', $IDSelected);
        return $strCombobox;
    }
    
}
