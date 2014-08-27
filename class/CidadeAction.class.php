<?php

/**
 *
 * @author Bruno Rossetto
 */
class CidadeAction {
    public static function getCombobox($IDSelected = "", $uf = null){
        $strCombobox = Util::getCombobox('nome', 'id', 'cidade', $IDSelected, !is_null($uf)?"and id_uf = $uf":"");
        return $strCombobox;
    }
    
}
