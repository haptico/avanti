<?php

/**
 *
 * @author Bruno Rossetto
 */

class UFAction {
    public static function getCombobox($IDSelected = ""){
        $strCombobox = Util::getCombobox('sigla', 'id', 'uf', $IDSelected);
        return $strCombobox;
    }
}
