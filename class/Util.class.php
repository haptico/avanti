<?php

/**
 * Description of Util
 * utilitarios
 * @author paulista
 */
class Util {

    //recebe string dd/mm/YYYY hh:mm:ss e retorna a string formatada para o oracle
    public static function dateTimeToSQLString($dateTime) {
        $result = 'NULL';
        if (!is_null($dateTime)) {
            $dateTime = str_replace("'", "''", $dateTime);
            $arrDateTime = split(" ", $dateTime);
            $arrDate = split('/',$arrDateTime[0]);
            $dia = $arrDate[0];
            $mes = $arrDate[1];
            $ano = $arrDate[2];
            $arrHora = split(":", $arrDateTime[1]);
            $hora = $arrHora[0];
            $minuto = $arrHora[1];
            $segundo = (isset($arrHora[2]) && $arrHora[2] > 0) ? $arrHora[2] : "00";
            $result = "to_date('" . $dia . "/" . $mes . "/" . $ano . " " . $hora . ":" . $minuto . ":" . $segundo . "','dd/mm/yyyy hh24:mi:ss')";
        }
        return $result;
    }

    //recebe string dd/mm/YYYY e retorna a string formatada para o oracle
    public static function dateToSQLString($date) {
        $result = 'NULL';
        if (!is_null($date) && self::validaData($date)) {
            $date = str_replace("'", "''", $date);
            $result = " TO_DATE('" . $date . "', 'dd/mm/yyyy') ";
        }
        return $result;
    }

    //escapeOracle
    public static function escapeOracle($str) {
        return str_replace("'", "''", $str);
    }

    //escapeMySQL
    public static function escapeMySQL($str) {
        return str_replace("'", "\'", $str);
    }

    
    public static function strTamanhoMaximo($string, $tamanhoMaximo, $substitui = '') {
        $strRetorno = $string;
        if(strlen($strRetorno) > $tamanhoMaximo){
            $strRetorno = substr($strRetorno, 0,($tamanhoMaximo - strlen($substitui)));
            // se tem um espaco em branco depois de 2/3 da string, termina a string nesse espa�o, senao continua com o tamanho maximo
            if(intval(strrpos($strRetorno, ' ')) >= (floor(strlen($strRetorno)/3)*2)){
                $strRetorno = substr($strRetorno, 0, strrpos($strRetorno, ' '));
            }
            $strRetorno .= $substitui;
        }
        return $strRetorno;
    }

    public static function moedaToFloat($valor) {
        if ($valor == "") {
            $ret = 0;
        } else {
            $ret = str_replace('.', '', $valor);
            $ret = str_replace(',', '.', $ret);
        }
        return $ret;
    }

    public static function sqlNumberToMoeda($valor) {
        if (strpos($valor, ",") === false) {
            $valor.= ',00';
        } elseif (strlen(substr($valor, strpos($valor, ",") + 1)) == 1) {
            $valor.= '0';
        }
        return $valor;
    }

    public static function encripta($str) {
        $ret = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $ret .= (100 + ord($str[$i]));
        }
        return $ret;
    }

    public static function decripta($str) {
        $ind = strlen($str) / 3;
        $ret = '';
        for ($i = 0; $i < $ind; $i++) {
            $ret .= chr(intval(substr($str, 0, 3)) - 100);
            $str = substr($str, 3);
        }
        return $ret;
    }

    public static function leadingZeros($num, $numDigits) {
        return sprintf("%0" . $numDigits . "d", $num);
    }

    public static function somenteNumeros($str) {
        return preg_replace("/[^0-9]/", '', $str);
    }

    public static function images($nome, $width=30, $height=30) {
        return '<img class="sys_img" src="img/icons/'.$nome.'" style="width: '.$width.'px; height: '.$height.'px;" alt="'.$nome.'" />';
    }

    public static function calendario($name, $default="", $blur="", $id="") {
        if ($blur != '') {
            $blur = "onblur=" . trim($blur);
        }
        return "<input type=\"text\" class=\"input-select date element text\" old=\"{$default}\" name=\"{$name}\" id=\"{$id}\"  value=\"{$default}\" size='10' $blur />";
    }

    public static function cargaCtrl($var) {
        if (trim($var) <> '') { //EMAIL FORMULARIO eplepc
            $var = Util::decripta($var);
            $t = explode("&", $var);
            $x = explode("=", $t[0]);
            $_SESSION['EMAIL_FORMULARIO'][$x[0]] = $x[1];
            return true;
        } else {
            return false;
        }
    }

    //trata o nome do arquivo, removendo caracteres invalidos
    public static function normalizaString($str) {
        $str = strtolower($str);
        $a = array('/[�����]/' => 'a', '/[����]/' => 'e', '/[����]/' => 'i', '/[�����]/' => 'o', '/[����]/' => 'u', '/�/' => 'c', '/�/' => 'n');
        $str = preg_replace(array_keys($a), array_values($a), $str);
        $str = preg_replace("/[^a-zA-Z0-9_ ]/", "", $str);
        //$str = ereg_replace("[^a-zA-Z0-9_ ]", "", $str);
        while (strpos($str, "  ") !== false) {
            $str = str_replace("  ", " ", $str);
        }
        $str = str_replace(" ", "_", $str);
        //$str = urlencode($str);
        return $str;
    }
    //retorna um hash unico para o arquivo, se vier o parametro, concatena o hash ao nome do arquivo, senao da um nome padrao file'. Aten��o: SEM EXTENSAO do arquivo!
    public static function geraNomeUnicoParaArquivo($nomeArquivo=''){
        return self::normalizaString(substr((($nomeArquivo!='')?$nomeArquivo:'file'), 0, 30)) . "_" .date('ymdHis').substr(microtime(), 2, 6);
    }

    //diferen�a absoluta entre duas datas yyyy-mm-dd
    public static function numDiasEntreDatas($dataMenor, $dataMaior) {
        return abs(floor((strtotime($dataMaior) - strtotime($dataMenor)) / (24 * 60 * 60)));
    }

    public static function arrayToTable($arrDados) {
        $strHeader = "<thead><tr>";

        foreach ($arrDados as $col => $dados) {
            $strHeader .= "<th>$col</th>";
        }

        $strHeader .= "</tr></thead>";
        $strContent = "<tbody>";

        for ($i = 0; $i < count($arrDados[$col]); $i++) {
            $strContent .= "<tr>";
            foreach ($arrDados as $col => $dados) {
                $strContent .= "<td align='center'>{$arrDados[$col][$i]}</td>";
            }
            $strContent .= "</tr>";
        }

        $strContent .= "</tbody>";

        $exportar_xls = abrir_arquivos("drill_down_" . rand(1, 100), "xls");
        $conteudo_xls = "<table>" . $strHeader . $strContent . "</table>";
        @fputs($exportar_xls["CODIGO_ARQUIVO"], $conteudo_xls);

        $strTable = "<table width='100%' border='0' cellspacing='0' cellpadding='0' id='tableLista' class='tableList' align='center'>
        " . $strHeader . $strContent . "
        <tr>
            <td align='center' style='background-color:#4F95DD;color:#FFFFFF' colspan='" . count($arrDados) . "'>Exportar<br />
                <a href='#' onclick=\"window.open('{$exportar_xls['NOME_ARQUIVO']}')\" target='_TOP'>
                    <img border='0' src='./imagens/excel.gif' alt='Exportar' />
                </a>
            </td>
        </tr></table>";

        return $strTable;
    }

    public static function ExportXSL($name="Error", $content="", $ext = "xls") {
        $exportxls["NOME"] = "temp/$name-" . date("Ymd-H-i-s") . ".{$ext}";
        $exportxls["CONTENT"] = @fopen($exportxls["NOME_ARQUIVO"], "w+");
        @fputs($exportxls["CONTENT"], $content);
        $link = <<<EOT
                    <a href="{$exportxls["NOME"]}" target="_TOP">
                        <img border="0" src="img/icons/excel.gif" alt="Exportar" />
                    </a>
EOT;
        return $link;
    }

    public static function enviarEmail($para, $assunto, $mensagem) {
        global $ERRO, $database;
        //return false;

        try {

            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->From = "no-reply@intelig.com.br";
            $mail->FromName = "System";
            if ($database == 'cttoprd') {
                $mail->AddAddress($para);
            } else {
                $mail->AddAddress('ana.turibio@between-br.com.br');
                $mail->AddCC('leandro.carvalho@between-br.com.br');
            }
            $mail->Subject = $assunto;
            $mail->MsgHTML($mensagem);

            return $mail->Send();
        } catch (Exception $e) {
            $ERRO = $e->getMessage();
            return false;
        }
    }

    public static function getComboBySQL($SQL, $selecionado = '', $labelInicial = 'Selecione') {
        $output = ($labelInicial != '') ? ('<option value="">' . $labelInicial . '</option>' . PHP_EOL) : '';
        $db = new Conexao();
        $rs = $db->geraMatriz($SQL);
        if (self::arrayTemItens($rs)) {
            foreach ($rs as $row) {
                $output .= '<option value="' . $row['chave'] . '" ' . (($row['chave'] == $selecionado) ? 'selected="selected"' : '') . '>' . $row['valor'] . '</option>' . PHP_EOL;
            }
        }
        return $output;
    }
    
    public static function getCombobox($campo, $id, $tabela, $selected = '', $filtros = '', $isFiltro = FALSE) {
        $db = new Conexao();
        $SQL = "
            SELECT $campo as nome, $id as id
            FROM $tabela
            WHERE 1 = 1
                $filtros
            GROUP BY $campo, $id
            ORDER BY nome
        ";
        $rs = $db->geraMatriz($SQL);
        if ($rs && count($rs) > 0) {
            if ($isFiltro) {
                $strFiltroCombo = '<option value="" class="span4">TODOS</option>';
            } else {
                $strFiltroCombo = '<option value="" class="span4">Selecione..</option>';
            }
            for ($i = 0; $i < count($rs); $i++) {
                $strFiltroCombo .= '<option class="span4"' . ($selected == $rs[$i]['id'] ? ' selected="selected" ' : '') . ' value="' . $rs[$i]['id'] . '">' . $rs[$i]['nome'] . '</option>';
            }
        }
        return $strFiltroCombo;
    }
    
    public static function getComboboxArray($array, $valorSelecionado = '', $isFiltro = FALSE) {
        if(is_array($array)){
            if ($isFiltro) {
                $strCombo = '<option value="" class="span4">TODOS</option>';
            } else {
                $strCombo = '<option value="" class="span4">Selecione..</option>';
            }
            foreach ($array as $key => $value) {
                $selected = ($key == $valorSelecionado)?'selected="selected"':'';
                $strCombo .= '<option class="span4" value="'.$key.'" '.$selected.'>'.$value.'</option>';
            }
        }
        return $strCombo;
    }

    public static function validaTokenForm() {
        //valida se o token informado � valido 
        return (isset($_SESSION['token_form']) && $_SESSION['token_form'] != '' && isset($_POST['token_form']) && $_POST['token_form'] != '' && ($_SESSION['token_form'] == $_POST['token_form']));
    }
    
    public static function validaMoeda($str) {
        //valida se $str � moeda 9.999,99
        return  preg_match('/^([0-9]\d{0,2}(\.\d{3})*|([0-9]\d*))(\,\d{1,2})?$/', trim($str));
    }

    public static function redirect($idBarraLateral) {
        global $SYS_GIF_CORRENTE, $SYS_BARRA_LATERAL_CORRENTE,$opt,$msg;
        $objNavigation = NavigationAction::Load($idBarraLateral);
        if (is_a($objNavigation, 'Navigation')) {
            //valida se o token informado � valido 
            $SYS_GIF_CORRENTE = Util::images($objNavigation->getGif());
            $SYS_BARRA_LATERAL_CORRENTE = $objNavigation->getNome();
            $opt = $idBarraLateral;
            if (is_file($objNavigation->getArquivo())) {
                include $objNavigation->getArquivo();
            } else {
                echo '<h1 class="alert">P�gina n�o encontrada</h1>';
            }
            require_once("rodape_geral.inc.php");
            exit();
        }
    }
    
    
    /*  Fun��o para extrair os dados de um arquivo csv
     *  a vari�vel start indica a partir de qual linha come�a a varredura
     * 
     */
    
    public static function extractCsv($file, $start){
        
        if (!empty($file['tmp_name']) && $file['tmp_name'] != 'none') {
            if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
                $row = 1;
                while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                    
                    if($row >= $start){

                        $num = count ($data);
                    
                        for ($c=0; $c < $num; $c++) {
                            $coluna[$c+1] = $data[$c];
                        }

                        $linha[] = $coluna;
                        unset($coluna);
                        
                    }
                    
                    $row++;
                }
                fclose ($handle);
            
                
            }
        }    
        
        if(count($linha)>0){
            return $linha;
        }else{
            return false;
        }
        
    }

    
    
    public static function upLoadComun($file, $diretorio="", $newName = NULL){
        $nomeRetorno = "ERRO";
        try{
            if(!empty($file['tmp_name']) && $file['tmp_name'] != 'none') {
                $objUpload = new FileUpload();
                $objUpload->upload_dir = ($diretorio!='')?$diretorio:'files/';
                $objUpload->validate_ext = false;
                $objUpload->rename_file = true;
                $objUpload->the_temp_file = $file['tmp_name'];
                $objUpload->the_file = $file['name'];
                $objUpload->http_error = $file['error'];
                $extension = $objUpload->get_extension($objUpload->the_file);
                $nomeArquivo = (is_null($newName))?str_replace($extension, '', $objUpload->the_file):$newName;
                $nomeArquivo = self::geraNomeUnicoParaArquivo($nomeArquivo);
                if ($objUpload->upload($nomeArquivo)) {
                    $nomeRetorno = $nomeArquivo . $extension;
                }else{
                    $nomeRetorno = 'ERRO';
                }
            }
        } catch (Exception $e) {
            //erro
        }
        return $nomeRetorno;
    }
    

    public static function upLoadArray($files, $diretorio = ""){
        $arrNomesRetorno = array();
        if(self::arrayTemItens($files['tmp_name'])){
            $objUpload = new FileUpload();
            $objUpload->upload_dir = ($diretorio!='')?$diretorio:'files/';
            $objUpload->validate_ext = FALSE;
            $objUpload->rename_file = TRUE;
            for($i=0; $i<count($files['tmp_name']); $i++){
                if (!empty($files['tmp_name'][$i]) && $files['tmp_name'][$i] != 'none') {
                    $objUpload->the_temp_file = $files['tmp_name'][$i];
                    $objUpload->the_file = $files['name'][$i];
                    $objUpload->http_error = $files['error'][$i];
                    $extension = $objUpload->get_extension($objUpload->the_file);
                    $nomeArquivo = str_replace($extension, '', $objUpload->the_file);
                    $nomeArquivo = self::geraNomeUnicoParaArquivo($nomeArquivo);
                    if ($objUpload->upload($nomeArquivo)) {
                        $arrNomesRetorno[$i] = $nomeArquivo . $extension;
                    } else {
                        $arrNomesRetorno = "ERRO";
                        break;
                    }
                }
            }
        }
        return $arrNomesRetorno;
    }    
    
    
    public static function preparaMoedaBanco($valor){

        $valor = str_replace(',', '.', $valor);

        return $valor;
    }
    
    public static function formata_moeda_capella($valor) {
        $saida = "";
        $split = str_split($valor);

        for ($i = 0; $i <= count($split); $i++) {

            if ($split[$i] == '.') {

                $split[$i] = ($i == (count($split) - 3)) ? ',' : '';
            }

            $saida .= $split[$i];
        }

        if (!strpos($saida, ',')) {

            $saida .= ',00';
        }
        return $saida;
    }

    
    public static function validaNumero($num){
        if(!ereg('[^0-9]',$num)){
            return true;
        }else{
            return false;
        }
    }
    
    public static function validaNumFloat($valor){
        
        $numero = self::formata_moeda_capella($valor);
        $numero = str_replace(',', '', $valor);
        $numero = str_replace('.', '', $numero);

        if(self::validaNumero($numero)){
            return true;
        }else{
            return false;
        }
        
    }

    
    
    public static function comboBySQL($SQL, $selecionando = "", $primeiraLinha = "") {
        if($primeiraLinha!=''){
            $output = '<option value="">'.$primeiraLinha.'</option>'."\n";
        }
        $db = new Conexao();
        $rs = $db->geraMatriz($SQL);
        if ($rs && count($rs) > 0) {
            for ($i = 0; $i < count($rs); $i++) {
                $output .= '<option value="'.$rs[$i]['chave'].'" '.(($rs[$i]['chave']==$selecionando)?'selected="selected"':'').'>'.$rs[$i]['valor'].'</option>'."\n";
            }
        }
        return $output;
        
    }
    public static function printTitulo() {
        global $SYS_GIF_CORRENTE, $SYS_BARRA_LATERAL_CORRENTE;
        $output = '';
        if($SYS_BARRA_LATERAL_CORRENTE != ''){
            $gif  = ($SYS_GIF_CORRENTE != '')?$SYS_GIF_CORRENTE:'';
            $output = <<<EOT

<div class="titulo">
    <h1>{$SYS_GIF_CORRENTE} {$SYS_BARRA_LATERAL_CORRENTE}</h1>
</div>

EOT;
        }
        return $output;
    }

    public static function imageRequired() {
        return '<img src="img/required.gif" alt="Campo Obrigatório" />';
    }

    
    
    /**
     *
     * @param type $opt
     * @param type $showFields
     * @param type $colunaAcao
     * 
     * Monta as colunas selecionadas pelos usu�rio 
     */
    
    public static function montaColuna($opt, $showFields, $colunaAcao=""){
        
        $chosen        = "";
        $toChosen      = "";
        $cacheColunas  = CacheRelatorioUsuario::getArrayColunas($opt);
        
        
        $strHeadTabela = $colunaAcao;
$colunTable = 0;
if (count($cacheColunas) > 0) {
    if ($cacheColunas != 'inibe_todas') {
        foreach ($cacheColunas as $cols) {
            for ($i = 0; $i < count($showFields); $i++) {
                if ($cols == $showFields[$i]["field"]) {
                    $strHeadTabela .= "<th>{$showFields[$i]['label']}</th>" . "\n";
                    $strColumnsHidden .= '<input type="hidden" name="hid_coluna_' . $showFields[$i]['field'] . '" id="hid_coluna_' . $showFields[$i]['field'] . '" value="S" />' . "\n";
                    // Lista de colunas ativadas
                    $chosen.= <<<EOT
                        <li class="ui-state-default">
                            <label id="{$showFields[$i]['field']}">{$showFields[$i]['label']}</label>
                        </li>
EOT;
                }
            }
            $colunTable++;
        }
    }
    for ($i = 0; $i < count($showFields); $i++) {
        if (!in_array($showFields[$i]["field"], $cacheColunas)) {
            $strColumnsHidden .= '<input type="hidden" name="hid_coluna_' . $showFields[$i]['field'] . '" id="hid_coluna_' . $showFields[$i]['field'] . '" value="N" />' . "\n";
            // Lista de colunas desativadas
            $toChosen.= <<<EOT
                <li class="ui-state-default">
                    <label id="{$showFields[$i]['field']}">{$showFields[$i]['label']}</label>
                </li>
EOT;
        }
    }
} else {
    for ($i = 0; $i < count($showFields); $i++) {
        $exibeTmp = 'N';
        if ($showFields[$i]['exibe']) {
            $strHeadTabela .= "<th width='90'>{$showFields[$i]['label']}</th>" . "\n";
            $exibeTmp = 'S';
            // Lista de colunas ativadas
            $chosen.= <<<EOT
                <li class="ui-state-default">
                    <label id="{$showFields[$i]['field']}">{$showFields[$i]['label']}</label>
                </li>
EOT;
            $colunTable++;
        } else {
            // Lista de colunas desativadas
            $toChosen.= <<<EOT
                <li class="ui-state-default">
                    <label id="{$showFields[$i]['field']}">{$showFields[$i]['label']}</label>
                </li>
EOT;
        }
        $strColumnsHidden .= '<input type="hidden" name="hid_coluna_' . $showFields[$i]['field'] . '" id="hid_coluna_' . $showFields[$i]['field'] . '" value="' . $exibeTmp . '" />' . "\n";
    }
}


        $conf['cacheColunas'] = $cacheColunas;
        $conf['strHeadTabela'] = $strHeadTabela;
        $conf['strColumnsHidden'] = $strColumnsHidden;
        $conf['chosen'] = $chosen;
        $conf['toChosen'] = $toChosen;
        $conf['colunTable'] = $colunTable;
        
        return $conf;
        
        
    }   

    //retorna true or false para dizer se � um array e tem itens nele
    public static function arrayTemItens($array){
        return (is_array($array)&& count($array)>0);
    }
    
     //valida data 'dd/mm/yyyy'
    public static function validaData($strData) {
        $retorno = FALSE;
        if (strlen($strData) == 10) {
            $arr = explode("/", $strData);
            if (is_array($arr) && count($arr) == 3) {
                $retorno = checkdate($arr[1], $arr[0], $arr[2]);
            }
        }
        return $retorno;
    }

    public static function getArraySimNao(){
        $arr['S'] = 'SIM';
        $arr['N'] = 'N�O';
        return $arr;
    }
    
}


?>
