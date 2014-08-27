<?php

/**
 *
 * @author Bruno Rossetto
 */

class UFAction {
    public static function getCombobox($IDSelected = ""){
        $strCombobox = Util::getCombobox('nome', 'id', 'cidade', $IDSelected);
        return $strCombobox;
    }
}
