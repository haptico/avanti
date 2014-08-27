<?php
/**
 * Description of VeiculoTipoAction
 *
 * @author Bernardo.Novak
 */
class VeiculoTipoAction {
    
    public static function gravar($obj){
        
    }

    public static function getComboBox($valor){
        $strCombo = Util::getCombobox('nome', 'id', 'tipo_veiculo', $valor);
        return $strCombo;
    }
    
}
