<?php
class Conexao {
	//link de conexao com o banco de dadoss
	private $conn;
	
	private $server = 'localhost';//DESENVOLVIMENTO
	//private $server = '10.9.5.16';//PRODU��O
	private $db = 'avanti';
	private $user = 'root';
	private $pass = '';
        private $erro;
        
        public function getErro() {
            return $this->erro;
        }

        /*
	O construtor da classe
	*/
	function __construct($db){
            global $global_servidorMysql, $global_userMysql, $global_passMysql;
            
            $this->server = $global_servidorMysql;
            $this->user = $global_userMysql;
            $this->pass = $global_passMysql;
            
            $this->db = $db;
            $this->open();
	}

	function open(){
            //$this->conn = mysql_connect($this->server,$this->user,$this->pass);
            $strCnx = "mysql:host={$this->server}; dbname={$this->db}";
            //echo "$strCnx - {$this->user} - {$this->pass}";


            //$this->conn = new PDO($strCnx+" user={$this->user} password={$this->pass}");
            $this->conn = new PDO($strCnx, $this->user, $this->pass);
//            if($this->conn){
//                mysql_select_db($this->db,$this->conn) or die(mysql_error());
//            }
//            else{
//                die(mysql_error());
//            }
	}

        function geraMatriz($pSql){
            $this->erro = '';
            if(!$this->conn){
                $this->open();
            }
            $xQuery = $this->conn->query($pSql);
            if ( !$xQuery ) {
                $this->erro = $this->conn->errorInfo();
                return false;
            }
            $i = 0;
            $xRegsArray = '';
            while($aFetchArray = $xQuery->fetch()){
                foreach( $aFetchArray as $xCampo => $xValor ) {
                    $xRegsArray[$i][$xCampo] = $xValor;
                }
                $i++;
            }
            return $xRegsArray;
        }

        function total($pSql){
            $this->erro = '';
            if(!$this->conn){
                $this->open();
            }
            $xQuery = $this->conn->prepare($pSql);
            if ( !$xQuery ) {
                $this->erro = $this->conn->errorInfo();
                return false;
            }
            $i = 0;
            $xRegsArray = $xQuery->columnCount();
            return $xRegsArray;
        }

        function pegaValor($SQL, $pColuna) {
            
            $this->erro = '';
            
            if(!$this->conn){
                $this->open();
            }
            
            $xQuery = $this->conn->query($SQL);
            
            if ( !$xQuery ) {
                $this->erro = $this->conn->errorInfo();
                return false;
            }
            
            return $xQuery;
            
        }

        function execute($SQL) {
            $this->erro = '';
            if (empty($SQL)) {
                echo "query vazia";
                return FALSE;
            } else {
                if(!$this->conn){
                    $this->open();
                }
                try{
                    $rs = $this->conn->exec($SQL);
                    if(!$rs){
                        $this->erro = $this->conn->errorInfo();
                    }
                 
                    // Retornando erro caso o mesmo ocorra, ou true em caso de sucesso.
                    return (is_array($this->erro) && intval($this->erro[0])>0)?false:true;
       
                }  catch (Exception $e){
                    echo $e->getMessage();
                    return FALSE;
                }
            }
        }
        
        function begin(){
//            mysql_query("SET AUTOCOMMIT=0;");
//            mysql_query("START TRANSACTION;");
            $this->conn->BeginTransaction();
        }
        function commit()
        {
//            mysql_query("COMMIT;");
            $this->conn->Commit();
        }
        function rollback()
        {
//            mysql_query("ROLLBACK;");
            $this->conn->RollBack();
        }
}
?>