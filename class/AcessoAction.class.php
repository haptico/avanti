<?php
/**
 * Description of AcessoAction
 *
 * @author Bernardo.Novak
 */
class AcessoAction {
    
    public static function loadBean($row){
        $obj = new Acesso();
        $obj->setID($row['id_acesso']);
        $obj->setNome($row['nome']);
        $obj->setArquivo($row['arquivo']);
        $obj->setVisivel($row['visivel']);
        return $obj;
    }
    
    public static function exibeAcesso($ID){
        $ret['EXIBE'] = FALSE;
        $db = new Conexao();
        $SQL = "
            SELECT id AS id_acesso, nome, arquivo, visivel
            FROM acesso
            WHERE id_acesso = '".  Util::escapeMySQL($ID)."'";
        $rs = $db->geraMatriz($SQL);
        if(Util::arrayTemItens($rs)){
            //if acesso for permitido{
                $obj = self::loadBean($rs[0]);
                $ret['ARQUIVO'] = $obj->getNome();
                $ret['EXIBE'] = TRUE;
            //}else{
            //$ret['MSG'] = 'Acesso não permitido.';
            //}
        }
        return $ret;
    }
    
    public static function exibeMenu(){
        $strMenu = '';
        $db = new Conexao();
        $SQL = "
            SELECT id AS id_acesso, nome
            FROM acesso
            WHERE visivel = 'S'
                AND id_tipo_usuario = ".$_SESSION['IDPERFILUSERLOGADO_AVANTI'];
        $rs = $db->geraMatriz($SQL);
        if(Util::arrayTemItens($rs)){
            foreach ($rs as $row) {
                $strMenu .= '<ul><li><a href="javascript: void(0);" onclick="navega('.$row['id_acesso'].')" >'.$row['nome'].'</a></li></ul>';
            }
        }
        return $strMenu;
    }
    
}
