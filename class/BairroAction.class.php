<?php

/**
 *
 * @author Bruno Rossetto
 */
class Bairro {
    public static function getCombobox($IDSelected = "", $cidade = null){
        $strCombobox = Util::getCombobox('nome', 'id', 'cidade', $IDSelected, !is_null($cidade)?"and id_cidade = $cidade":"");
        return $strCombobox;
    }
    
    public static function getCidade($id){
        $db = new Conexao();
        $cidade = new Cidade();
        $SQL = "select b.id_cidade, c.nome 
                from bairro b
                    inner join cidade c on c.id = b.id_cidade and b.id = $id";
        $rs = $db->geraMatriz($SQL);
        if (Util::arrayTemItens($rs)){
            $cidade->setID($rs[0]["id_cidade"]);
            $cidade->setNome($rs[0]["nome"]);
        }
        return $cidade;
    }

}
