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
    
    public static function getUF($id){
        $db = new Conexao();
        $uf = new UF();
        $SQL = "select c.id_uf, uf.sigla 
                from cidade c
                    inner join uf on uf.id = c.id_uf and c.id = $id";
        $rs = $db->geraMatriz($SQL);
        if (Util::arrayTemItens($rs)){
            $uf->setID($rs[0]["id_uf"]);
            $uf->setNome($rs[0]["sibla"]);
        }
        return $uf;
    }

}
