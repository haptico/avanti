<?php

/**
 * @author paulista
 */
class UsuarioAction {

    const ANALISTA_EVT = 'CPTFA';
    const PRE_VENDA = 'PREVENDAS';
    const LP = 'LP';
    const GP = 'GP';
    const PLANNING = 'MW Planning';
    //const SOLICITANTE = 'Prevendas';
    const ELABORADOR_COM = 'Elaborador CPCOM';
    const CONFIGURACAO = 'Configuração';
    const FIBER = 'FIBER';
    //ultilizado pra filtrar os dois departamentos
    const ELABORADOR_COM_E_ANALISTA_EVT = "Elaborador CPCOM','CPTFA";
    const SWAP = "SWAP";
    const TIM_FIBER = "TIM FIBER";
    const TIM_FIBER_ADMIN = "TIM FIBER ADMIN";
    const TIM_FIBER_OPERACAO = "TIM FIBER OPERACAO";

    public static function loadBean($rs) {
        $object = new Usuario();
        $object->setArea($rs["area"]);
        $object->setAtivo($rs["ativo"]);
        $object->setCadastradopor($rs["cadastrado_por"]);
        $object->setCelular($rs["celular"]);
        $object->setClassificacao($rs["classificacao"]);
        $object->setDataAlteracao($rs["data_alteracao"]);
        $object->setDepartamento($rs["departamento"]);
        $object->setEmail($rs["email"]);
        $object->setEmpresa($rs["empresa"]);
        $object->setGestor($rs["gestor"]);
        $object->setId($rs["departamento"]);
        $object->setIDLogUltimaAtividade($rs["id_log_ultima_atividade"]);
        $object->setLogUltimaAtividade($rs["log_ultima_atividade"]);
        $object->setIDNivelUsuario($rs["id_nivel_usuario"]);
        $object->setIDSegmento($rs["id_segmento"]);
        $object->setID($rs["id_usuario"]);
        $object->setIDLogado($rs["logado"]);
        $object->setIDMatricula($rs["matricula"]);
        $object->setNome($rs["nome"]);
        $object->setSenha($rs["senha"]);
        $object->setTelefone($rs["telefone"]);
        $object->setUltimaAtividade($rs["ultima_atividade"]);
        $object->setUsuario($rs["usuario"]);
        $object->setGrupo($rs["grupo"]);
        
        $object->setCentroDeCusto($rs['centro_de_custo']); 
        $object->setProjeto($rs['projeto']); 
        $object->setTemPlano($rs['tem_plano']); 
        $object->setCpf($rs['cpf']); 
        $object->setSexo($rs['sexo']); 
        $object->setDataNascimento($rs['data_de_nascimento']); 
        $object->setIdCargo($rs['id_cargo']); 
        $object->setIdEncarregado($rs['id_encarregado']); 
        $object->setIdEmpresa($rs['id_empresa']); 
        $object->setIdProjeto($rs['id_projeto']); 
        $object->setAtivoAte($rs['ativo_ate']);
        $object->setRg($rs['rg']); 
        $object->setSituacao($rs['situacao']); 
        $object->setCartaoEstacionamento($rs['cartao_estacionamento']); 
        $object->setMatriculaTIM($rs['matricula_tim']); 
        $object->setEmailTIM($rs['email_tim']);
        $object->setEmailParticular($rs['email_particular']); 
        $object->setTituloEleitor($rs['titulo_eleitor']); 
        $object->setOrgao($rs['orgao']); 
        $object->setNaturalidade($rs['naturalidade']);
        $object->setPis($rs['pis']); 
        $object->setCtps($rs['ctps']); 
        $object->setBanco($rs['banco']); 
        $object->setAgencia($rs['agencia']); 
        $object->setConta($rs['conta']); 
        $object->setFormacao($rs['formacao']); 
        $object->setEspecializacao($rs['especializacao']); 
        $object->setErRua($rs['er_rua']); 
        $object->setErNumero($rs['er_numero']); 
        $object->setErComplemento($rs['er_complemento']); 
        $object->setErCep($rs['er_cep']); 
        $object->setErBairro($rs['er_bairro']); 
        $object->setErCidade($rs['er_cidade']); 
        $object->setErEstado($rs['er_estado']); 
        $object->setDataExpedicao($rs['data_expedicao']); 
        $object->setDataCadastro($rs['data_cadastro']); 
        $object->setFoto($rs['foto']); 
                        
        $object->setDataContratacao($rs['data_contratacao']);
        $object->setOpVt($rs['op_vt']);
        $object->setMatriculaPlanoSaude($rs['matricula_plano_saude']);
        $object->setNumApoliceSeguro($rs['num_apolice_seguro']);
        $object->setNomeConjuge($rs['nome_conjuge']);
        $object->setNomePai($rs['nome_pai']);
        $object->setNomeMae($rs['nome_mae']);
        $object->setNomeFilho1($rs['nome_filho1']);
        $object->setNomeFilho2($rs['nome_filho2']);
        $object->setNomeFilho3($rs['nome_filho3']);
        $object->setNomeFilho4($rs['nome_filho4']);
        $object->setDataNascConjuge($rs['data_nasc_conjuge']);
        $object->setDataNascFilho1($rs['data_nasc_filho1']);
        $object->setDataNascFilho2($rs['data_nasc_filho2']);
        $object->setDataNascFilho3($rs['data_nasc_filho3']);
        $object->setDataNascFilho4($rs['data_nasc_filho4']);
        $object->setCargo($rs['cargo']);
        $object->setLocado($rs['locado']);
        return $object;
    }

    public static function getList($filtros = "", $order = 'u.nome ASC') {
        $db = new Conexao();
        $SQL = "SELECT U.AREA,
                        U.ATIVO,
                        CDP.NOME AS CADASTRADO_POR,
                        U.CELULAR,
                        U.CLASSIFICACAO,
                        TO_CHAR(U.DATA_ALTERACAO, 'DD/MM/RRRR') AS DATA_ALTERACAO,
                        U.DEPARTAMENTO,
                        U.EMAIL,
                        U.EMPRESA,
                        NVL(U.GESTOR, 'Não informado') AS GESTOR,
                        U.ID_LOG_ULTIMA_ATIVIDADE,
                        L.ACAO AS LOG_ULTIMA_ATIVIDADE,
                        U.ID_NIVEL_USUARIO,
                        U.ID_SEGMENTO,
                        U.ID_USUARIO,
                        U.LOGADO,
                        U.MATRICULA,
                        U.NOME,           
                        U.SENHA,
                        U.TELEFONE,
                        TO_CHAR(U.ULTIMA_ATIVIDADE, 'DD/MM/RRRR HH24:MI') AS ULTIMA_ATIVIDADE,
                        U.USUARIO,
                        U.ID_NIVEL_USUARIO AS GRUPO,
                        u.centro_de_custo, u.projeto, u.tem_plano, u.cpf, u.sexo, 
                        u.data_de_nascimento, u.id_cargo, u.id_encarregado, u.id_empresa, u.id_projeto, u.ativo_ate,
                        u.rg, u.situacao, u.cartao_estacionamento, u.matricula_tim, u.email_tim,
                        u.email_particular, u.titulo_eleitor, u.orgao, u.naturalidade,
                        u.pis, u.ctps, u.banco, u.agencia, u.conta, u.formacao, 
                        u.especializacao, u.er_rua, u.er_numero, u.er_complemento, u.er_cep, 
                        u.er_bairro, u.er_cidade, u.er_estado, u.data_expedicao, u.data_cadastro, u.foto, u.foto_blob, l.acao as ultima_acao
                FROM USUARIOS U
                    LEFT JOIN USUARIOS CDP ON CDP.ID_USUARIO = U.CADASTRADO_POR
                    LEFT JOIN (
                        SELECT LO.ID_USUARIO, LO.ACAO, MAX(LO.DATA) AS DATAS
                        FROM  LOGS LO
                        WHERE ROWNUM = 1
                        GROUP BY LO.ID_USUARIO, LO.ACAO
                        ORDER BY DATAS DESC
                    ) L ON L.ID_USUARIO = U.ID_USUARIO
                    /*LEFT JOIN (
                        SELECT UG.ID_USUARIO,  WM_CONCAT(DISTINCT(G.GRUPO_DESCRICAO) ) AS GRUPO
                        FROM USUARIOS_GRUPOS UG
                            LEFT JOIN GRUPOS G ON G.ID_GRUPO = UG.ID_GRUPO
                        GROUP BY UG.ID_USUARIO
                    ) G ON G.ID_USUARIO = U.ID_USUARIO*/
                WHERE 1=1 ";
        if ($filtros != "") {
            $SQL.= "{$filtros}";
        }
        $SQL.=" ORDER BY {$order}";
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                $objeto[] = self::loadBean($rs[$i]);
            }
        }
        return $objeto;
    }
    
    public static function resetar($ID) {
        $db = new Conexao();
        $sql = "SELECT usuario, email from usuarios where id_usuario = '{$ID}'";
        $rs = $db->geraMatriz($sql);

        $email = $rs[0]["email"];
        $username = $rs[0]["usuario"];

        $senharesetada = uniqid();

        $msg = "Acesse o sistema Cruscotto no endereço http://cruscotto.intelig23/index.php. Seu login: {$username}, e sua nova senha de acesso é {$senharesetada}. Altere-a no primeiro acesso.";

        $assunto = "[INTEGRA] Senha de acesso resetada";
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SetFrom('no-reply@intelig.com.br','System');
        $mail->AddAddress("{$email}");
        $mail->Subject = $assunto;
        $mail->MsgHTML($msg);
        if(!$mail->Send()) {
           $msg = "Não foi possível resetar a senha do usuário. Não foi possivel enviar para {$email}.";
        } else {
            $sql = "UPDATE usuarios SET senha='" . md5($senharesetada) . "', data_alteracao=SYSDATE-30, ativo=1 WHERE id_usuario = '{$ID}'";
            $db->execute($sql);
            $msg = "Senha resetada e enviada para o email {$email}.";
        }
        return $msg;
    }

    public static function load($ID, $isAdmin = false) {
        if (!$ID) {
            return NULL;
        }
        $db = new Conexao();
        $SQL = " SELECT u.id_usuario, 
                        u.nome, 
                        u.usuario, 
                        u.email, 
                        u.departamento, 
                        u.telefone, 
                        u.ativo,  
                        TO_CHAR(u.ultima_atividade,'DD/MM/YYYY HH24:MI') as ultima_atividade, 
                        g.grupo_descricao, 
                        u.id_nivel_usuario, 
                        u.matricula, 
                        u.gestor, 
                        u.area, 
                        u.classificacao, 
                        u.celular, 
                        u.empresa, 
                        u.senha,
                        g2.grupo_descricao AS perfil, 
                        u.centro_de_custo, u.projeto, u.tem_plano, u.cpf, u.sexo, 
                        u.data_de_nascimento, u.id_cargo, u.id_encarregado, u.id_empresa, u.id_projeto, u.ativo_ate,
                        u.rg, u.situacao, u.cartao_estacionamento, u.matricula_tim, u.email_tim,
                        u.email_particular, u.titulo_eleitor, u.orgao, u.naturalidade,
                        u.pis, u.ctps, u.banco, u.agencia, u.conta, u.formacao, 
                        u.especializacao, u.er_rua, u.er_numero, u.er_complemento, u.er_cep, 
                        u.er_bairro, u.er_cidade, u.er_estado, u.data_expedicao, u.data_cadastro, u.foto, u.foto_blob
            FROM usuarios u  
                LEFT JOIN usuarios_grupos up ON up.id_usuario = u.id_usuario  
                LEFT JOIN grupos g ON g.id_grupo = up.id_grupo
                LEFT JOIN grupos g2 on g2.id_grupo = u.id_nivel_usuario
            WHERE u.id_usuario = " . Util::escapeOracle($ID) . " ";
        if (!$isAdmin) {
            $SQL .= " AND ativo = 1 ";
        }
        $arrGrupos = array();
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $ooo = self::loadBean($rs[0]);
            $objRetorno = new Usuario();
            $objRetorno->setID($rs[0]["id_usuario"]);
            $objRetorno->setNome($rs[0]["nome"]);
            $objRetorno->setUsuarioLogin($rs[0]["usuario"]);
            $objRetorno->setEmail($rs[0]["email"]);
            $objRetorno->setTelefone($rs[0]["telefone"]);
            $objRetorno->setCelular($rs[0]["celular"]);
            $objRetorno->setAtivo($rs[0]["ativo"]);
            $objRetorno->setPerfil($rs[0]["perfil"]);
            $objRetorno->setPerfilUsuario($rs[0]["perfil"]);
            $objRetorno->setIdPerfil($rs[0]["id_nivel_usuario"]);
            $objRetorno->setEmpresa($rs[0]["empresa"]);
            $objRetorno->setMatricula($rs[0]["matricula"]);
            $objRetorno->setGestor($rs[0]["gestor"]);
            $objRetorno->setArea($rs[0]["area"]);
            $objRetorno->setClassificacao($rs[0]["classificacao"]);
            $objRetorno->setDepartamento($rs[0]["departamento"]);
            $objRetorno->setSenha($rs[0]["senha"]);

            $objRetorno->setUltimaAtividade($rs[0]["ultima_ativ"]);

            for ($i = 0; $i < count($rs); $i++) {
                $arrGrupos[] = $rs[$i]["grupo_descricao"];
            }
            $objRetorno->setArrGrupos($arrGrupos);
        }
        return $ooo;
    }

    public static function loadRH($ID, $isAdmin = false) {
        if (!$ID) {
            return NULL;
        }
        $db = new Conexao();
        $SQL = " SELECT u.id_usuario, 
                        u.nome, 
                        u.usuario, 
                        u.email, 
                        u.departamento, 
                        u.telefone, 
                        u.ativo,  
                        TO_CHAR(u.ultima_atividade,'DD/MM/YYYY HH24:MI') as ultima_atividade, 
                        g.grupo_descricao as grupo, 
                        u.id_nivel_usuario, 
                        u.matricula, 
                        u.gestor, 
                        u.area, 
                        u.classificacao, 
                        u.celular, 
                        u.empresa, 
                        to_char(u.data_de_nascimento,'dd/mm/yyyy') as data_de_nascimento, 
                        to_char(u.data_expedicao,'dd/mm/yyyy') as data_expedicao, 
                        TO_CHAR(u.data_cadastro,'DD/MM/YYYY') as data_cadastro, 
                        TO_CHAR( u.ativo_ate,'DD/MM/YYYY') as  ativo_ate, 
                        u.senha,
                        g2.grupo_descricao AS perfil, 
                        u.centro_de_custo, u.projeto, u.tem_plano, u.cpf, u.sexo, 
                        u.id_cargo, u.id_encarregado, u.id_empresa, u.id_projeto,
                        u.rg, u.situacao, u.cartao_estacionamento, u.matricula_tim, u.email_tim,
                        u.email_particular, u.titulo_eleitor, u.orgao, u.naturalidade,
                        u.pis, u.ctps, u.banco, u.agencia, u.conta, u.formacao, 
                        u.especializacao, u.er_rua, u.er_numero, u.er_complemento, u.er_cep, 
                        u.er_bairro, u.er_cidade, u.er_estado,  u.foto, u.foto_blob, 

                        u.op_vt, u.matricula_plano_saude, u. num_apolice_seguro , u.nome_conjuge, 
                        TO_CHAR(u.data_contratacao,'DD/MM/YYYY') as data_contratacao, 
                        TO_CHAR(u.data_nasc_conjuge,'DD/MM/YYYY') as data_nasc_conjuge, 
                        u.nome_pai, u.nome_mae, u.nome_filho1, u.nome_filho2, u.nome_filho3, u.nome_filho4, 
                        TO_CHAR(u.data_nasc_filho1,'DD/MM/YYYY') as data_nasc_filho1, 
                        TO_CHAR(u.data_nasc_filho2,'DD/MM/YYYY') as data_nasc_filho2, 
                        TO_CHAR(u.data_nasc_filho3,'DD/MM/YYYY') as data_nasc_filho3, 
                        TO_CHAR(u.data_nasc_filho4,'DD/MM/YYYY') as data_nasc_filho4, 
                        u.cargo, u.locado                          
            FROM usuarios u  
                LEFT JOIN usuarios_grupos up ON up.id_usuario = u.id_usuario  
                LEFT JOIN grupos g ON g.id_grupo = up.id_grupo
                LEFT JOIN grupos g2 on g2.id_grupo = u.id_nivel_usuario
            WHERE u.id_usuario = " . Util::escapeOracle($ID) . " ";
        

        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $objRetorno = self::loadBean($rs[0]);
        }
        return $objRetorno;
    }

    public static function getLista($isAdmin = false, $departamento = '', $filtros = '') {
        global $opt;
        $db = new Conexao();
        $SQL = " SELECT u.id_usuario, u.nome, u.usuario, u.ativo, u.email ";
        $SQL .= " FROM usuarios u ";
        $SQL .= " WHERE 1 = 1 ";
        if (!$isAdmin) {
            $SQL .= " AND ativo = 1 ";
        }
        if ($departamento != '') {
            $SQL .= " AND UPPER(departamento) IN ('" . strtoupper($departamento) . "') ";
        }
        $SQL .= $filtros . " ORDER BY nome ASC ";

        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                $objRetorno = new Usuario();
                $objRetorno->setID($rs[$i]["id_usuario"]);
                $objRetorno->setNome($rs[$i]["nome"]);
                $objRetorno->setEmail($rs[$i]["email"]);
                $objRetorno->setUsuarioLogin($rs[$i]["usuario"]);
                $objRetorno->setAtivo($rs[$i]["ativo"]);
                $arrRetorno[$i] = $objRetorno;
            }
        }
        return $arrRetorno;
    }

    public static function doLogin($login, $pass) {
        $db = new Conexao();
        $SQL = " SELECT u.id_usuario, 
                        u.nome, 
                        u.usuario, 
                        u.email, 
                        u.departamento, 
                        u.telefone, 
                        u.ativo,  
                        TO_CHAR(u.ultima_atividade,'DD/MM/YYYY HH24:MI') as ultima_ativ, 
                        g.grupo_descricao, 
                        u.id_nivel_usuario, 
                        u.matricula, 
                        u.gestor, 
                        u.area, 
                        u.classificacao, 
                        u.celular, 
                        u.empresa, 
                        u.senha,
                        g2.grupo_descricao AS perfil
            FROM usuarios u  
                LEFT JOIN usuarios_grupos up ON up.id_usuario = u.id_usuario  
                LEFT JOIN grupos g ON g.id_grupo = up.id_grupo
                LEFT JOIN grupos g2 on g2.id_grupo = u.id_nivel_usuario
            WHERE UPPER(TRIM(U.USUARIO)) = UPPER(TRIM('" . Util::escapeOracle($login) . "'))
                AND U.SENHA = '" . Util::escapeOracle(md5($pass)) . "' ";
        $arrGrupos = array();
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $objRetorno = new Usuario();
            $objRetorno->setID($rs[0]["id_usuario"]);
            $objRetorno->setNome($rs[0]["nome"]);
            $objRetorno->setUsuarioLogin($rs[0]["usuario"]);
            $objRetorno->setEmail($rs[0]["email"]);
            $objRetorno->setTelefone($rs[0]["telefone"]);
            $objRetorno->setCelular($rs[0]["celular"]);
            $objRetorno->setAtivo($rs[0]["ativo"]);
            $objRetorno->setPerfil($rs[0]["perfil"]);
            $objRetorno->setPerfilUsuario($rs[0]["perfil"]);
            $objRetorno->setIdPerfil($rs[0]["id_nivel_usuario"]);
            $objRetorno->setEmpresa($rs[0]["empresa"]);
            $objRetorno->setMatricula($rs[0]["matricula"]);
            $objRetorno->setGestor($rs[0]["gestor"]);
            $objRetorno->setArea($rs[0]["area"]);
            $objRetorno->setClassificacao($rs[0]["classificacao"]);
            $objRetorno->setDepartamento($rs[0]["departamento"]);
            $objRetorno->setSenha($rs[0]["senha"]);

            $objRetorno->setUltimaAtividade($rs[0]["ultima_ativ"]);

            for ($i = 0; $i < count($rs); $i++) {
                $arrGrupos[] = $rs[$i]["grupo_descricao"];
            }

            $objRetorno->setArrGrupos($arrGrupos);
            
            $_SESSION['USERLOGADO'] = serialize($objRetorno);
            return true;
        } else {
            return false;
        }
    }
    
    public static function doLogout() {
        LogAction::gravarProcedimento($opt, "LOGOFF", '', '', Log::ACAO);
        $db = new Conexao();
        $SQL = "UPDATE USUARIOS SET LOGADO = 0 WHERE ID_USUARIO = {$_SESSION["id_usuario_logado"]}";
        return $db->execute($SQL);
    }

    /*
     * Método verificarStatusUsuario()
     * Verifica se a data de vencimento da senha do usuário
     * Verifica se a senha do usuário logado e velha e da uma menssagem de erro
     * @param $id_usuário = id do usuário logado
     */

    public static function verificarStatusUsuairo($ID) {
        $db = new Conexao();
        $SQL = " SELECT CASE 
                            WHEN (email like '%@intelig.com.br')
                            THEN 'S' 
                            else 'N' 
                        end AS is_intelig,
                        case 
                            when (data_alteracao < (sysdate-30)) then 'velha'
                            when (data_alteracao < (sysdate-25)) then 'alertar'
                            else 'boa'
                        end as senhas,
                        to_char(data_alteracao + 30, 'DD/MM/YYYY HH24:MI:SS') as vencimento
                FROM usuarios 
                WHERE id_usuario = '" . Util::escapeOracle($ID) . "' ";
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            if ($rs[0]['senhas'] == 'alertar') {
                $msg = 'Atenção, sua senha vence em ' . $rs[0]['vencimento'] . ' altere para não perder o acesso ao sistema.';
            }
            if ($rs[0]['is_intelig'] == 'S') {
                $_SESSION['ALERTA_MUDA_EMAIL'] = 1;
            }
            if ($rs[0]['senhas'] == 'velha') {
                $_SESSION['SENHA_ANTIGA'] = true;
                $msg = 'Sua senha expirou. Renove sua senha.';
            } else {
                $_SESSION['SENHA_ANTIGA'] = false;
            }
        }
        return $msg;
    }

    public static function atualizaEmailUsuario($email) {
        global $id_usuario_logado;

        $db = new Conexao();
        $SQL = " 
                    update 
                        usuarios 
                    set
                        email = '$email'
                    where 
                        id_usuario = '$id_usuario_logado'
        
                ";

        $ret = $db->execute($SQL);
        return $ret;
    }

    // grava/atualiza uma linha na tabela
    public static function gravar(Usuario $objeto, $db = NULL) {
        global $id_usuario_logado;
        if (is_null($db)) {
            $db = new Conexao();
        }
        $idInsert = $objeto->getID();
        if ($objeto->getID() > 0) {
            $SQL = " UPDATE usuarios SET ";
            $SQL .= " nome = '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " usuario = '" . Util::escapeOracle($objeto->getUsuarioLogin()) . "', ";
            $SQL .= " email = '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " telefone = '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " celular = '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " id_nivel_usuario = '" . Util::escapeOracle($objeto->getIdPerfil()) . "', ";
            $SQL .= " empresa = '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " matricula = '" . Util::escapeOracle($objeto->getMatricula()) . "', ";
            $SQL .= " gestor = '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " area = '" . Util::escapeOracle($objeto->getArea()) . "', ";
            $SQL .= " classificacao = '" . Util::escapeOracle($objeto->getClassificacao()) . "', ";
            $SQL .= " departamento = '" . Util::escapeOracle($objeto->getDepartamento()) . "', ";
            $SQL .= " senha = '" . Util::escapeOracle($objeto->getSenha()) . "', ";
            
            $SQL .= " data_alteracao = SYSDATE ";
            $SQL .= " WHERE id_usuario = " . $objeto->getID();
            //Log
        } else {
            $idInsert = $db->getOneValue('SELECT usuarios_id_usuario.NEXTVAL AS id_insert FROM dual', 'id_insert');
            $SQL = " INSERT INTO usuarios ( 
                           id_usuario, nome, usuario, email, telefone, celular, id_nivel_usuario,
                           empresa, matricula, gestor, area, classificacao, departamento, 
                           senha, ativo, cadastrado_por, data_alteracao
                        ) VALUES( ";
            $SQL .= $idInsert . ", ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getUsuarioLogin()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getIdPerfil()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getMatricula()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getArea()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getClassificacao()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getDepartamento()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getSenha()) . "', ";
            $SQL .= " '1', ";
            $SQL .= " '" . $id_usuario_logado . "', ";
            $SQL .= " SYSDATE ";
            $SQL .= " )";
        }
        $ret = $db->execute($SQL);
        if (is_null($ret)) {
            if (is_array($objeto->getEquipes())) {
                $ret = ControleUsuarioAction::gravarEquipesUsuario($idInsert, $objeto->getEquipes(), $db);
            }
        }
        return $ret;
    }

    public static function gravarRH(Usuario $objeto, $db = NULL) {
        global $id_usuario_logado;
        if (is_null($db)) {
            $db = new Conexao();
        }
        $idInsert = $objeto->getID();
        if ($objeto->getID() > 0) {
            $SQL = " UPDATE usuarios SET ";
            $SQL .= " nome = '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " email = '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " telefone = '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " celular = '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " empresa = '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " matricula = '" . Util::escapeOracle($objeto->getIDMatricula()) . "', ";
            $SQL .= " gestor = '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " area = '" . Util::escapeOracle($objeto->getArea()) . "', ";
            
            $SQL .= " centro_de_custo = '" . Util::escapeOracle($objeto->getCentroDeCusto()) . "', ";
        $SQL .= " projeto = '" . Util::escapeOracle($objeto->getProjeto()) . "', ";
        $SQL .= " tem_plano = '" . Util::escapeOracle($objeto->getTemPlano()) . "', ";
        $SQL .= " cpf = '" . Util::escapeOracle($objeto->getCpf()) . "', ";
        $SQL .= " sexo = '" . Util::escapeOracle($objeto->getSexo()) . "', ";
        $SQL .= " data_cadastro = " . Util::dateToSQLString($objeto->getDataCadastro()) . ", ";
        $SQL .= " id_cargo = '" . Util::escapeOracle($objeto->getIdCargo()) . "', ";
        $SQL .= " id_encarregado = '" . Util::escapeOracle($objeto->getIdEncarregado()) . "', ";
        $SQL .= " id_empresa = '" . Util::escapeOracle($objeto->getIdEmpresa()) . "', ";
        $SQL .= " id_projeto = '" . Util::escapeOracle($objeto->getIdProjeto()) . "', ";
        $SQL .= " ativo_ate = " . Util::dateToSQLString($objeto->getAtivoAte()) . ", ";
        $SQL .= " rg = '" . Util::escapeOracle($objeto->getRg()) . "', ";
        $SQL .= " situacao = '" . Util::escapeOracle($objeto->getSituacao()) . "', ";
        $SQL .= " cartao_estacionamento = '" . Util::escapeOracle($objeto->getCartaoEstacionamento()) . "', ";
        $SQL .= " matricula_tim = '" . Util::escapeOracle($objeto->getMatriculaTIM()) . "', ";
        $SQL .= " email_tim = '" . Util::escapeOracle($objeto->getEmailTIM()) . "', ";
        $SQL .= " email_particular = '" . Util::escapeOracle($objeto->getEmailParticular()) . "', ";
        $SQL .= " foto = '" . Util::escapeOracle($objeto->getFoto()) . "', ";
        $SQL .= " titulo_eleitor = '" . Util::escapeOracle($objeto->getTituloEleitor()) . "', ";
        $SQL .= " orgao = '" . Util::escapeOracle($objeto->getOrgao()) . "', ";
        $SQL .= " naturalidade = '" . Util::escapeOracle($objeto->getNaturalidade()) . "', ";
        $SQL .= " pis = '" . Util::escapeOracle($objeto->getPis()) . "', ";
        $SQL .= " ctps = '" . Util::escapeOracle($objeto->getCtps()) . "', ";
        $SQL .= " banco = '" . Util::escapeOracle($objeto->getBanco()) . "', ";
        $SQL .= " agencia = '" . Util::escapeOracle($objeto->getAgencia()) . "', ";
        $SQL .= " conta = '" . Util::escapeOracle($objeto->getConta()) . "', ";
        $SQL .= " formacao = '" . Util::escapeOracle($objeto->getFormacao()) . "', ";
        $SQL .= " especializacao = '" . Util::escapeOracle($objeto->getEspecializacao()) . "', ";
        $SQL .= " er_rua = '" . Util::escapeOracle($objeto->getErRua()) . "', ";
        $SQL .= " er_numero = '" . Util::escapeOracle($objeto->getErNumero()) . "', ";
        $SQL .= " er_complemento = '" . Util::escapeOracle($objeto->getErComplemento()) . "', ";
        $SQL .= " er_cep = '" . Util::escapeOracle($objeto->getErCep()) . "', ";
        $SQL .= " er_bairro = '" . Util::escapeOracle($objeto->getErBairro()) . "', ";
        $SQL .= " er_cidade = '" . Util::escapeOracle($objeto->getErCidade()) . "', ";
        $SQL .= " er_estado = '" . Util::escapeOracle($objeto->getErEstado()) . "', ";
        $SQL .= " data_expedicao = " . Util::dateToSQLString($objeto->getDataExpedicao()) . ", ";
        $SQL .= " data_de_nascimento = " . Util::dateToSQLString($objeto->getDataNascimento()) . ", ";
        
        $SQL .= " data_contratacao = " . Util::dateToSQLString($objeto->getDataContratacao()) . ", ";
        $SQL .= " op_vt = '" . Util::escapeOracle($objeto->getOpVt()) . "', ";
        $SQL .= " matricula_plano_saude = '" . Util::escapeOracle($objeto->getMatriculaPlanoSaude()) . "', ";
        $SQL .= " num_apolice_seguro = '" . Util::escapeOracle($objeto->getNumApoliceSeguro()) . "', ";
        $SQL .= " nome_conjuge = '" . Util::escapeOracle($objeto->getNomeConjuge()) . "', ";
        $SQL .= " nome_pai = '" . Util::escapeOracle($objeto->getNomePai()) . "', ";
        $SQL .= " nome_mae = '" . Util::escapeOracle($objeto->getNomeMae()) . "', ";
        $SQL .= " nome_filho1 = '" . Util::escapeOracle($objeto->getNomeFilho1()) . "', ";
        $SQL .= " nome_filho2 = '" . Util::escapeOracle($objeto->getNomeFilho2()) . "', ";
        $SQL .= " nome_filho3 = '" . Util::escapeOracle($objeto->getNomeFilho3()) . "', ";
        $SQL .= " nome_filho4 = '" . Util::escapeOracle($objeto->getNomeFilho4()) . "', ";
        $SQL .= " data_nasc_conjuge = " . Util::dateToSQLString($objeto->getDataNascConjuge()) . ", ";
        $SQL .= " data_nasc_filho1 = " . Util::dateToSQLString($objeto->getDataNascFilho1()) . ", ";
        $SQL .= " data_nasc_filho2 = " . Util::dateToSQLString($objeto->getDataNascFilho2()) . ", ";
        $SQL .= " data_nasc_filho3 = " . Util::dateToSQLString($objeto->getDataNascFilho3()) . ", ";
        $SQL .= " data_nasc_filho4 = " . Util::dateToSQLString($objeto->getDataNascFilho4()) . ", ";
        $SQL .= " cargo = '" . Util::escapeOracle($objeto->getCargo()) . "', ";
        $SQL .= " locado = '" . Util::escapeOracle($objeto->getLocado()) . "', ";
            
            $SQL .= " data_alteracao = SYSDATE ";
            $SQL .= " WHERE id_usuario = " . $objeto->getID();
            //Log
        } else {
            $idInsert = $db->getOneValue('SELECT usuarios_id_usuario.NEXTVAL AS id_insert FROM dual', 'id_insert');
            $exp_mail = explode("@",$objeto->getEmail());
            $nuser = $exp_mail[0];
            $npass = uniqid();
            $SQL = " INSERT INTO usuarios ( 
                            id_usuario, nome, email, telefone, celular, empresa, matricula, gestor, area, ativo, 
                            cadastrado_por, data_alteracao, centro_de_custo, projeto, tem_plano,
                            cpf, sexo, data_cadastro, id_cargo, id_encarregado, id_empresa, id_projeto, ativo_ate, rg,
                            situacao, cartao_estacionamento, matricula_tim, email_tim, email_particular, foto, titulo_eleitor,
                            orgao, naturalidade, pis, ctps, banco, agencia, conta, formacao, especializacao, er_rua, er_numero,
                            er_complemento, er_cep, er_bairro, er_cidade, er_estado, data_de_nascimento, data_expedicao, 

data_contratacao,op_vt,matricula_plano_saude, num_apolice_seguro ,nome_conjuge,data_nasc_conjuge,nome_pai,nome_mae,nome_filho1,nome_filho2,nome_filho3,nome_filho4,data_nasc_filho1,
  data_nasc_filho2,data_nasc_filho3 ,data_nasc_filho4,
  cargo,locado                      

usuario, senha
                        ) VALUES( ";
            $SQL .= $idInsert . ", ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getIDMatricula()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getArea()) . "', ";
            $SQL .= " '1', ";
            $SQL .= " '" . $id_usuario_logado . "', ";
            $SQL .= " SYSDATE, ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCentroDeCusto()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getProjeto()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getTemPlano()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCpf()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getSexo()) . "', ";
            $SQL .= "  " . Util::dateToSQLString($objeto->getDataCadastro()) . ", ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getIdCargo()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getIdEncarregado()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getIdEmpresa()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getIdProjeto()) . "', ";
            $SQL .= "  " . Util::dateToSQLString($objeto->getAtivoAte()) . ", ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getRg()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getSituacao()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getCartaoEstacionamento()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getMatriculaTIM()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getEmailTIM()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getEmailParticular()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getFoto()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getTituloEleitor()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getOrgao()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getNaturalidade()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getPis()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCtps()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getBanco()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getAgencia()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getConta()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getFormacao()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getEspecializacao()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErRua()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErNumero()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErComplemento()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErCep()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErBairro()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErCidade()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getErEstado()) . "', ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascimento()) . ", ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataExpedicao()) . ", ";
            
            $SQL .= " " . Util::dateToSQLString($objeto->getDataContratacao()) . ", ";
            $SQL .= " '" . Util::escapeOracle($objeto->getOpVt()) . "', ";
            $SQL .= "  '" . Util::escapeOracle($objeto->getMatriculaPlanoSaude()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNumApoliceSeguro()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeConjuge()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomePai()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeMae()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeFilho1()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeFilho2()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeFilho3()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNomeFilho4()) . "', ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascConjuge()) . ", ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascFilho1()) . ", ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascFilho2()) . ", ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascFilho3()) . ", ";
            $SQL .= " " . Util::dateToSQLString($objeto->getDataNascFilho4()) . ", ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCargo()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getLocado()) . "', ";

            $SQL .= "  '" . Util::escapeOracle($nuser) . "', ";
            $SQL .= "  md5('" . Util::escapeOracle($npass) . "') ";
            $SQL .= " )";
        }
        $ret = $db->execute($SQL);
        
        return $ret;
    }

    // grava/atualiza uma linha na tabela
    public static function gravarNovoAcesso(Usuario $objeto, $db = NULL) {
        global $id_usuario_logado;
        if (is_null($db)) {
            $db = new Conexao();
        }
        $idInsert = $objeto->getID();
        if ($objeto->getID() > 0) {
            $SQL = " UPDATE usuarios SET ";
            $SQL .= " nome = '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " usuario = '" . Util::escapeOracle($objeto->getUsuarioLogin()) . "', ";
            $SQL .= " email = '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " telefone = '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " celular = '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " id_nivel_usuario = '" . Util::escapeOracle($objeto->getIdPerfil()) . "', ";
            $SQL .= " empresa = '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " matricula = '" . Util::escapeOracle($objeto->getMatricula()) . "', ";
            $SQL .= " gestor = '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " area = '" . Util::escapeOracle($objeto->getArea()) . "', ";
            $SQL .= " classificacao = '" . Util::escapeOracle($objeto->getClassificacao()) . "', ";
            $SQL .= " departamento = '" . Util::escapeOracle($objeto->getDepartamento()) . "', ";
            $SQL .= " senha = '" . Util::escapeOracle($objeto->getSenha()) . "', ";
            $SQL .= " data_alteracao = SYSDATE";
            $SQL .= " WHERE id_usuario = " . $objeto->getID();
            //Log
        } else {
            $idInsert = $db->getOneValue('SELECT usuarios_id_usuario.NEXTVAL AS id_insert FROM dual', 'id_insert');
            $SQL = " INSERT INTO usuarios ( 
                           id_usuario, nome, usuario, email, telefone, celular, id_nivel_usuario,
                           empresa, matricula, gestor, area, classificacao, departamento, 
                           senha, ativo, cadastrado_por, data_alteracao
                        ) VALUES( ";
            $SQL .= $idInsert . ", ";
            $SQL .= " '" . Util::escapeOracle($objeto->getNome()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getUsuarioLogin()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmail()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getTelefone()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getCelular()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getIdPerfil()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getEmpresa()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getMatricula()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getGestor()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getArea()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getClassificacao()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getDepartamento()) . "', ";
            $SQL .= " '" . Util::escapeOracle($objeto->getSenha()) . "', ";
            $SQL .= " '1', ";
            $SQL .= " '" . $id_usuario_logado . "', ";
            $SQL .= " (SYSDATE - 365) ";
            $SQL .= " )";
        }
        $ret = $db->execute($SQL);
        //Se usuário for GP
        if ($objeto->getIdPerfil() == 3) {
            UsuarioAction::recordGP($idInsert, Util::escapeOracle($objeto->getNome()));
        }
        if (is_null($ret)) {
            if (is_array($objeto->getEquipes())) {
                $ret = ControleUsuarioAction::gravarEquipesUsuario($idInsert, $objeto->getEquipes(), $db);
            }
        }
        return $idInsert;
    }

    public static function isLogged() {
        $lastAccess = $_SESSION["lastAccess"];
        $now = time("d/m/Y G:i:s");
        $tempoTranscorrido = ($now - $lastAccess);
        if (isset($_SESSION["lastAccess"]) && ($tempoTranscorrido <= 300) && (unserialize($_SESSION['usuarioLogado']) instanceof Usuario)) {
            $_SESSION["lastAccess"] = $now;
            return true;
        } else {
            return false;
        }
    }

    public static function validaUsuario($usuario) {
        $db = new Conexao();
        $SQL = " SELECT id_usuario ";
        $SQL .= " FROM usuarios ";
        $SQL .= " WHERE UPPER(usuario) = '" . Util::escapeOracle($usuario) . "'";

        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function loadByEmail($email, $login, $isAdmin = false) {
        $db = new Conexao();
        $SQL = " SELECT id_usuario, nome, usuario, email, departamento, senha ";
        $SQL .= " FROM usuarios ";
        $SQL .= " WHERE UPPER(TRIM(usuario)) = UPPER(TRIM('" . Util::escapeOracle($login) . "')) ";
        $SQL .= " AND UPPER(TRIM(email)) = UPPER(TRIM('" . Util::escapeOracle($email) . "')) ";
//        $SQL .= " WHERE usuario = '".$login."'";
//        $SQL .= " AND email = '".$email."'";
        if (!$isadmin) {
            $SQL .= " AND ativo = 1 ";
        }
        $rs = $db->geraMatriz($SQL);
        if ($rs && sizeof($rs) > 0) {
            $objRetorno = new Usuario();
            $objRetorno->setID($rs[0]["id_usuario"]);
            $objRetorno->setNome($rs[0]["nome"]);
            $objRetorno->setUsuarioLogin($rs[0]["usuario"]);
            $objRetorno->setEmail($rs[0]["email"]);
            $objRetorno->setSenha($rs[0]["senha"]);
        }
        return $objRetorno;
    }

    public static function resetarSenha($novaSenha, $ID) {
        $db = new Conexao();
        $SQL = "UPDATE usuarios SET ";
        $SQL .= " senha ='" . md5($novaSenha) . "'";
        $SQL .= " , data_alteracao = SYSDATE-30 ";
        //$SQL .= " , ativo=1 ";
        $SQL .= " WHERE id_usuario = '$ID'";
        return $db->execute($SQL);
    }

    public static function setAtivacao($ID, $ativacao) {
        $db = new Conexao();
        $ativ = ($ativacao == 'S') ? 1 : 0;
        $SQL = " UPDATE usuarios SET ativo = '{$ativ}' WHERE id_usuario = " . $ID;
        //Log
        return $db->execute($SQL);
    }

    public static function setLogado($ID, $ativacao) {
        $db = new Conexao();
        $ativ = ($ativacao == 'S') ? 1 : 0;
        $SQL = " UPDATE usuarios SET logado = '{$ativ}' WHERE id_usuario = " . $ID;
        return $db->execute($SQL);
    }

    public static function checaSenha(Usuario $obj, $alteraSenha = 'N') {
        $msg = NULL;
        if (!$obj->getID() > 0 || $alteraSenha == 'S') {
            if (is_null($obj->getSenhaNova())) {
                $msg = 'A nova senha não pode estar em branco.';
            } else {
                if ((md5($obj->getSenhaAntiga()) != $obj->getSenha()) && $obj->getID() > 0) {
                    //verifica se senha antiga confere com a senha q consta no banco
                    $msg = 'A senha atual esta incorreta.';
                } elseif (is_null($msg)) {
                    switch ($obj->getSenhaNova()) {
                        case $obj->getSenhaNova() != $obj->getSenhaConfirmacao():
                            $msg = 'Senha e senha de confirmação divergentes.';
                            break;
                        case $atual == $obj->getSenhaNova():
                            $msg = 'A nova senha deve ser diferente da anterior.';
                            break;
                        case strlen(trim($obj->getSenhaNova())) != 8:
                            $msg = 'A senha deve ter 8 digitos.';
                            break;
                    }
                    if (is_null($msg)) {
                        //verifica se existe duas letras e 2 numeros na nova senha
                        $n = 0;
                        $a = 0;
                        for ($i = 0; $i < 8; $i++) {
                            if (is_numeric(substr($obj->getSenhaNova(), $i, 1))) {
                                $n++;
                            }
                            $string = substr($obj->getSenhaNova(), $i, 1);
                            if (!is_numeric($string)) {
                                $a++;
                            }
                        }
                        if (($a < 2) or ($n < 2)) {
                            $msg = "A Senha deve conter pelo menos duas letras e dois números.";
                        } else {
                            if ($id > 0) {
                                $msgv = valida_log_senhas($id, $nova);
                                if ($msgv == "OK") {
                                    guarda_log_senhas($id, $atual);
                                }
                            }
                        }
                    }
                }
            }
        }
        if (!is_null($msg)) {
            return $msg;
        } else {
            return "OK";
        }
    }

    static public function getComboUsuarioWorkflow($ID = null, $descricao = "Escolha uma opção", $area) {
        $db = new Conexao();
        $SQL = "SELECT u.id_usuario as id, u.nome as nome
                FROM usuarios u
                WHERE u.id_usuario IN  (
                    SELECT DISTINCT(id_usu_responsavel)
                    FROM workflow.entidade_posto_operacao
                )
                ORDER BY u.nome ASC ";
        $rs = $db->geraMatriz($SQL);
        $strCombobox = "<option value='' >{$descricao}</option>" . "\n";
        if (is_array($rs) && sizeof($rs) > 0) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                $sel = "";
                if ($ID != "" && $ID == $rs[$i]["id"]) {
                    $sel = " selected='selected' ";
                }
                $strCombobox.= "<option value='{$rs[$i]["id"]}' {$sel} >{$rs[$i]["nome"]}</option>" . "\n";
            }
        }
        return $strCombobox;
    }
    
    static public function getComboUsuario($filtro = '', $ID = '', $firstRow = "Selecione") {
        $SQL = "SELECT u.id_usuario as chave, u.nome as valor
                FROM usuarios u
                $filtro
                ORDER BY u.nome ASC ";
        return    Util::getComboBySQL($SQL, $ID, $firstRow);
    }
    
    public static function getDataLista($post){
        $filtros = '';
        if($post['filtrou']== 'S'){
            if(in_array($post['f_ativo'],array('1','0'))){
                $filtros .= " AND u.situacao = '{$post['f_ativo']}' ";
            }
            if(in_array($post['f_sexo'],array('M','F'))){
                $filtros .= " AND u.sexo = '{$post['f_sexo']}' ";
            }
            $post['f_idade'] = Util::somenteNumeros($post['f_idade']);
            if($post['f_idade'] != '' && is_numeric($post['f_idade'])){
                $filtros .= " AND TRUNC((SYSDATE - TO_DATE(TO_CHAR(u.data_de_nascimento,'dd/mm/yyyy'),'dd/mm/yyyy')) /365, 0 ) = '{$post['f_idade']}' ";
            }
            $post['f_localizacao'] = trim(strtolower($post['f_localizacao']));
            if($post['f_localizacao'] != ''){
                $filtros .= " 
                AND (TRIM(LOWER(u.er_rua)) LIKE '%{$post['f_localizacao']}%'
                    OR TRIM(LOWER(u.er_bairro)) LIKE '%{$post['f_localizacao']}%'
                    OR TRIM(LOWER(u.er_cidade)) LIKE '%{$post['f_localizacao']}%'
                )";
                    
            }
        }
        $arrObject = UsuarioAction::getList($filtros);
        $strCorpoTabela = '';
        if (Util::arrayTemItens($arrObject)) {
            
            foreach ($arrObject as $object) {
                
                $strCorpoTabela .= <<<EOT
            <tr>
                <td>{$object->getNome()}</td>
                <td>{$object->getEmail()}</td>
                <td>{$object->getTelefone()}</td>
                <td>{$object->getProjeto()}</td>
                <td style="width:60px;textalign: center"><img alt="Editar" src="img/edit.gif" style="cursor:pointer;" onclick="editar('{$object->getID()}')" /></td>
            </tr>
EOT;
                
                $strRowsExcel .= <<<EOT
            <tr>
                <td>{$object->getNome()}</td>
                <td>{$object->getEmail()}</td>
                <td>{$object->getTelefone()}</td>
                <td>{$object->getProjeto()}</td>
            </tr>
EOT;
            }
        }
        $data['tabela_excel'] = '
            <table>
            <thead>
            <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Projeto</th>
            </tr>
            </thead>
            <tbody>'. $strRowsExcel.'</tbody>
            </table>';
        $data['corpo_tabela'] = $strCorpoTabela;
        return $data;
    }
    
    public static function getDataCadastro($ID){
        if($ID > 0){
            $obj = UsuarioAction::loadRH($ID);
            $data['ID'] = $obj->getID();
            $data['area'] = $obj->getArea();
            $data['ativo'] = $obj->getAtivo();
            $data['cadastrado_por'] = $obj->getCadastradopor();
            $data['celular'] = $obj->getCelular();
            $data['classificacao'] = $obj->getClassificacao();
            $data['data_alteracao'] = $obj->getDataAlteracao();
            $data['departamento'] = $obj->getDepartamento();
            $data['email'] = $obj->getEmail();
            $data['empresa'] = $obj->getEmpresa();
            $data['gestor'] = $obj->getGestor();
            $data['id_log_ultima_atividade'] = $obj->getIDLogUltimaAtividade();
            $data['log_ultima_atividade'] = $obj->getLogUltimaAtividade();
            $data['id_nivel_usuario'] = $obj->getIDNivelUsuario();
            $data['id_segmento'] = $obj->getIDSegmento();
            $data['id_logado'] = $obj->getIDLogado();
            $data['matricula'] = $obj->getIDMatricula();
            $data['nome'] = $obj->getNome();
            $data['senha'] = $obj->getSenha();
            $data['telefone'] = $obj->getTelefone();
            $data['ultima_atividade'] = $obj->getUltimaAtividade();
            $data['usuario'] = $obj->getUsuario();
            $data['grupo'] = $obj->getGrupo();
            $data['centro_de_custo'] = $obj->getCentroDeCusto(); 
            $data['projeto'] = $obj->getProjeto(); 
            $data['tem_plano'] = $obj->getTemPlano(); 
            $data['cpf'] = $obj->getCpf(); 
            $data['sexo'] = $obj->getSexo(); 
            $data['data_de_nascimento'] = $obj->getDataNascimento(); 
            $data['id_cargo'] = $obj->getIdCargo(); 
            $data['id_encarregado'] = $obj->getIdEncarregado(); 
            $data['id_empresa'] = $obj->getIdEmpresa(); 
            $data['id_projeto'] = $obj->getIdProjeto(); 
            $data['ativo_ate'] = $obj->getAtivoAte();
            $data['rg'] = $obj->getRg(); 
            $data['situacao'] = $obj->getSituacao(); 
            $data['cartao_estacionamento'] = $obj->getCartaoEstacionamento(); 
            $data['matricula_tim'] = $obj->getMatriculaTIM(); 
            $data['email_tim'] = $obj->getEmailTIM();
            $data['email_particular'] = $obj->getEmailParticular(); 
            $data['titulo_eleitor'] = $obj->getTituloEleitor(); 
            $data['orgao'] = $obj->getOrgao(); 
            $data['naturalidade'] = $obj->getNaturalidade();
            $data['pis'] = $obj->getPis(); 
            $data['ctps'] = $obj->getCtps(); 
            $data['banco'] = $obj->getBanco(); 
            $data['agencia'] = $obj->getAgencia(); 
            $data['conta'] = $obj->getConta(); 
            $data['formacao'] = $obj->getFormacao(); 
            $data['especializacao'] = $obj->getEspecializacao(); 
            $data['er_rua'] = $obj->getErRua(); 
            $data['er_numero'] = $obj->getErNumero(); 
            $data['er_complemento'] = $obj->getErComplemento(); 
            $data['er_cep'] = $obj->getErCep(); 
            $data['er_bairro'] = $obj->getErBairro(); 
            $data['er_cidade'] = $obj->getErCidade(); 
            $data['er_estado'] = $obj->getErEstado(); 
            $data['data_expedicao'] = $obj->getDataExpedicao(); 
            $data['data_cadastro'] = $obj->getDataCadastro(); 
            $data['foto'] = $obj->getFoto();
            
            $data['data_contratacao'] = $obj->getDataContratacao();
            $data['op_vt'] = $obj->getOpVt();
            $data['matricula_plano_saude'] = $obj->getMatriculaPlanoSaude();
            $data['num_apolice_seguro'] = $obj->getNumApoliceSeguro();
            $data['nome_pai'] = $obj->getNomePai();
            $data['nome_mae'] = $obj->getNomeMae();
            $data['nome_conjuge'] = $obj->getNomeConjuge();
            $data['data_nasc_conjuge'] = $obj->getDataNascConjuge();
            $data['nome_filho1'] = $obj->getNomeFilho1();
            $data['data_nasc_filho1'] = $obj->getDataNascFilho1();
            $data['nome_filho2'] = $obj->getNomeFilho2();
            $data['data_nasc_filho2'] = $obj->getDataNascFilho2();
            $data['nome_filho3'] = $obj->getNomeFilho3();
            $data['data_nasc_filho3'] = $obj->getDataNascFilho3();
            $data['nome_filho4'] = $obj->getNomeFilho4();
            $data['data_nasc_filho4'] = $obj->getDataNascFilho4();
            $data['cargo'] = $obj->getCargo();
            $data['classificacao'] = $obj->getClassificacao();
            $data['locado'] = $obj->getLocado();
            
            $data['hidden_update'] = '
                <input type="hidden" id="sexo_update" class="hidden_update" value="'.$obj->getSexo().'" />
                <input type="hidden" id="tem_plano_update" class="hidden_update" value="'.$obj->getTemPlano().'" />
                <input type="hidden" id="er_estado_update" class="hidden_update" value="'.$obj->getErEstado().'" />
                <input type="hidden" id="situacao_update" class="hidden_update" value="'.$obj->getSituacao().'" />
                <input type="hidden" id="op_vt_update" class="hidden_update" value="'.$obj->getOpVt().'" />
                ';
        }else{
            $data['ID'] = 0;
        }

        return $data;
    }

}

?>
