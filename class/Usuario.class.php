<?php

/**
 * Description of Usuario
 *
 * @author paulista
 */
class Usuario {

    private $ID = 0; //"ID_USUARIO"
    private $IDLogUltimaAtividade;
    private $LogUltimaAtividade;
    private $IDNivelUsuario;
    private $IDSegmento;
    private $IDLogado;
    private $IDMatricula;
    private $nome; //"NOME"
    private $usuario;
    private $usuarioLogin; //"USUARIO"
    private $email; //"USUARIO"
    private $senha; //"USUARIO"
    private $departamento; //CPTFA, GP, LP, Prevenda
    private $telefone;
    private $celular;
    private $idPerfil;
    private $empresa;
    private $matricula;
    private $gestor;
    private $area;
    private $classificacao;
    private $perfil; //Obj Perfil (niveus de acesso do usuario)
    private $perfilUsuario; // faz referência a id_nivel_usuario
    private $senhaAntiga;
    private $senhaNova;
    private $senhaConfirmacao;
    private $equipes; //array de objeto equipes
    private $ativo;
    private $ultimaAtividade;
    private $cadastradopor;
    private $logado;
    private $dataAlteracao;
    private $segmento;
    private $log;
    private $vencimento;
    private $senhaStatus;
    private $analista; //obj de Usuario -> LP tem 1 analista
    private $arrGrupos;
    private $Grupo;
    
    private $centroDeCusto;
    private $projeto;
    private $temPlano;
    private $cpf;
    private $sexo;
    private $dataCadastro;
    private $idCargo;
    private $idEncarregado;
    private $idEmpresa;
    private $idProjeto;
    private $ativoAte;
    private $rg;
    private $situacao;
    private $cartaoEstacionamento;
    private $matriculaTIM;
    private $emailTIM;
    private $emailParticular;
    private $foto;
    private $tituloEleitor;
    private $orgao;
    private $naturalidade;
    private $pis;
    private $ctps;
    private $banco;
    private $agencia;
    private $conta;
    private $formacao;
    private $especializacao;
    private $erRua;
    private $erNumero;
    private $erComplemento;
    private $erCep;
    private $erBairro;
    private $erCidade;
    private $erEstado;
    private $dataExpedicao;
    private $dataNascimento;
    
    private $dataContratacao;
    private $opVt;
    private $matriculaPlanoSaude;
    private $numApoliceSeguro;
    private $nomeConjuge;
    private $dataNascConjuge;
    private $nomePai;
    private $nomeMae;
    private $nomeFilho1;
    private $nomeFilho2;
    private $nomeFilho3;
    private $nomeFilho4;
    private $dataNascFilho1;
    private $dataNascFilho2;
    private $dataNascFilho3;
    private $dataNascFilho4;
    private $cargo;
    private $locado;
    
    public function __construct($ID = 0, $nome = "", $email = '') {
        if ($ID > 0) {
            $this->setID($ID);
            $this->setNome($nome);
            $this->setEmail($email);
        } else {
            $this->setID("NULL");
        }
    }

    public function getArrGrupos() {
        return $this->arrGrupos;
    }

    public function setArrGrupos($arrGrupos) {
        $this->arrGrupos = $arrGrupos;
    }

    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function getIDLogUltimaAtividade() {
        return $this->IDLogUltimaAtividade;
    }

    public function setIDLogUltimaAtividade($IDLogUltimaAtividade) {
        $this->IDLogUltimaAtividade = $IDLogUltimaAtividade;
    }

    public function getLogUltimaAtividade() {
        return $this->LogUltimaAtividade;
    }

    public function setLogUltimaAtividade($LogUltimaAtividade) {
        $this->LogUltimaAtividade = $LogUltimaAtividade;
    }

    public function getIDNivelUsuario() {
        return $this->IDNivelUsuario;
    }

    public function setIDNivelUsuario($IDNivelUsuario) {
        $this->IDNivelUsuario = $IDNivelUsuario;
    }

    public function getIDSegmento() {
        return $this->IDSegmento;
    }

    public function setIDSegmento($IDSegmento) {
        $this->IDSegmento = $IDSegmento;
    }

    public function getIDLogado() {
        return $this->IDLogado;
    }

    public function setIDLogado($IDLogado) {
        $this->IDLogado = $IDLogado;
    }

    public function getIDMatricula() {
        return $this->IDMatricula;
    }

    public function setIDMatricula($IDMatricula) {
        $this->IDMatricula = $IDMatricula;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuarioLogin() {
        return $this->usuarioLogin;
    }

    public function setUsuarioLogin($usuarioLogin) {
        $this->usuarioLogin = $usuarioLogin;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function getIdPerfil() {
        return $this->idPerfil;
    }

    public function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getGestor() {
        return $this->gestor;
    }

    public function setGestor($gestor) {
        $this->gestor = $gestor;
    }

    public function getArea() {
        return $this->area;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function getClassificacao() {
        return $this->classificacao;
    }

    public function setClassificacao($classificacao) {
        $this->classificacao = $classificacao;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getPerfilUsuario() {
        return $this->perfilUsuario;
    }

    public function setPerfilUsuario($perfilUsuario) {
        $this->perfilUsuario = $perfilUsuario;
    }

    public function getSenhaAntiga() {
        return $this->senhaAntiga;
    }

    public function setSenhaAntiga($senhaAntiga) {
        $this->senhaAntiga = $senhaAntiga;
    }

    public function getSenhaNova() {
        return $this->senhaNova;
    }

    public function setSenhaNova($senhaNova) {
        $this->senhaNova = $senhaNova;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getUltimaAtividade() {
        return $this->ultimaAtividade;
    }

    public function setUltimaAtividade($ultimaAtividade) {
        $this->ultimaAtividade = $ultimaAtividade;
    }

    public function getCadastradopor() {
        return $this->cadastradopor;
    }

    public function setCadastradopor($cadastradopor) {
        $this->cadastradopor = $cadastradopor;
    }

    public function getLogado() {
        return $this->logado;
    }

    public function setLogado($logado) {
        $this->logado = $logado;
    }

    public function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    public function setDataAlteracao($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }

    public function getSegmento() {
        return $this->segmento;
    }

    public function setSegmento($segmento) {
        $this->segmento = $segmento;
    }

    public function getLog() {
        return $this->log;
    }

    public function setLog($log) {
        $this->log = $log;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    public function getSenhaStatus() {
        return $this->senhaStatus;
    }

    public function setSenhaStatus($senhaStatus) {
        $this->senhaStatus = $senhaStatus;
    }

    public function getSenhaConfirmacao() {
        return $this->senhaConfirmacao;
    }

    public function setSenhaConfirmacao($senhaConfirmacao) {
        $this->senhaConfirmacao = $senhaConfirmacao;
    }

    public function getEquipes() {
        return $this->equipes;
    }

    public function setEquipes($equipes) {
        $this->equipes = $equipes;
    }

    public function getAnalista() {
        return $this->analista;
    }

    public function setAnalista($analista) {
        $this->analista = $analista;
    }

    public function getGrupo() {
        return $this->Grupo;
    }

    public function setGrupo($Grupo) {
        $this->Grupo = $Grupo;
    }
    
    public function getCentroDeCusto() {
        return $this->centroDeCusto;
    }

    public function setCentroDeCusto($centroDeCusto) {
        $this->centroDeCusto = $centroDeCusto;
    }

    public function getProjeto() {
        return $this->projeto;
    }

    public function setProjeto($projeto) {
        $this->projeto = $projeto;
    }

    public function getTemPlano() {
        return $this->temPlano;
    }

    public function setTemPlano($temPlano) {
        $this->temPlano = $temPlano;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    public function getIdCargo() {
        return $this->idCargo;
    }

    public function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    public function getIdEncarregado() {
        return $this->idEncarregado;
    }

    public function setIdEncarregado($idEncarregado) {
        $this->idEncarregado = $idEncarregado;
    }
    
    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function getIdProjeto() {
        return $this->idProjeto;
    }

    public function setIdProjeto($idProjeto) {
        $this->idProjeto = $idProjeto;
    }

    public function getAtivoAte() {
        return $this->ativoAte;
    }

    public function setAtivoAte($ativoAte) {
        $this->ativoAte = $ativoAte;
    }

    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getCartaoEstacionamento() {
        return $this->cartaoEstacionamento;
    }

    public function setCartaoEstacionamento($cartaoEstacionamento) {
        $this->cartaoEstacionamento = $cartaoEstacionamento;
    }

    public function getMatriculaTIM() {
        return $this->matriculaTIM;
    }

    public function setMatriculaTIM($matriculaTIM) {
        $this->matriculaTIM = $matriculaTIM;
    }

    public function getEmailTIM() {
        return $this->emailTIM;
    }

    public function setEmailTIM($emailTIM) {
        $this->emailTIM = $emailTIM;
    }

    public function getEmailParticular() {
        return $this->emailParticular;
    }

    public function setEmailParticular($emailParticular) {
        $this->emailParticular = $emailParticular;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getTituloEleitor() {
        return $this->tituloEleitor;
    }

    public function setTituloEleitor($tituloEleitor) {
        $this->tituloEleitor = $tituloEleitor;
    }

    public function getOrgao() {
        return $this->orgao;
    }

    public function setOrgao($orgao) {
        $this->orgao = $orgao;
    }

    public function getNaturalidade() {
        return $this->naturalidade;
    }

    public function setNaturalidade($naturalidade) {
        $this->naturalidade = $naturalidade;
    }

    public function getPis() {
        return $this->pis;
    }

    public function setPis($pis) {
        $this->pis = $pis;
    }

    public function getCtps() {
        return $this->ctps;
    }

    public function setCtps($ctps) {
        $this->ctps = $ctps;
    }

    public function getBanco() {
        return $this->banco;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function getAgencia() {
        return $this->agencia;
    }

    public function setAgencia($agencia) {
        $this->agencia = $agencia;
    }

    public function getConta() {
        return $this->conta;
    }

    public function setConta($conta) {
        $this->conta = $conta;
    }

    public function getFormacao() {
        return $this->formacao;
    }

    public function setFormacao($formacao) {
        $this->formacao = $formacao;
    }

    public function getEspecializacao() {
        return $this->especializacao;
    }

    public function setEspecializacao($especializacao) {
        $this->especializacao = $especializacao;
    }

    public function getErRua() {
        return $this->erRua;
    }

    public function setErRua($erRua) {
        $this->erRua = $erRua;
    }

    public function getErNumero() {
        return $this->erNumero;
    }

    public function setErNumero($erNumero) {
        $this->erNumero = $erNumero;
    }

    public function getErComplemento() {
        return $this->erComplemento;
    }

    public function setErComplemento($erComplemento) {
        $this->erComplemento = $erComplemento;
    }

    public function getErCep() {
        return $this->erCep;
    }

    public function setErCep($erCep) {
        $this->erCep = $erCep;
    }

    public function getErBairro() {
        return $this->erBairro;
    }

    public function setErBairro($erBairro) {
        $this->erBairro = $erBairro;
    }

    public function getErCidade() {
        return $this->erCidade;
    }

    public function setErCidade($erCidade) {
        $this->erCidade = $erCidade;
    }

    public function getErEstado() {
        return $this->erEstado;
    }

    public function setErEstado($erEstado) {
        $this->erEstado = $erEstado;
    }

    public function getDataExpedicao() {
        return $this->dataExpedicao;
    }

    public function setDataExpedicao($dataExpedicao) {
        $this->dataExpedicao = $dataExpedicao;
    }
    
    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
    
    public function getDataContratacao() {
        return $this->dataContratacao;
    }

    public function setDataContratacao($dataContratacao) {
        $this->dataContratacao = $dataContratacao;
    }

    public function getOpVt() {
        return $this->opVt;
    }

    public function setOpVt($opVt) {
        $this->opVt = $opVt;
    }

    public function getMatriculaPlanoSaude() {
        return $this->matriculaPlanoSaude;
    }

    public function setMatriculaPlanoSaude($matriculaPlanoSaude) {
        $this->matriculaPlanoSaude = $matriculaPlanoSaude;
    }

    public function getNumApoliceSeguro() {
        return $this->numApoliceSeguro;
    }

    public function setNumApoliceSeguro($numApoliceSeguro) {
        $this->numApoliceSeguro = $numApoliceSeguro;
    }

    public function getNomeConjuge() {
        return $this->nomeConjuge;
    }

    public function setNomeConjuge($nomeConjuge) {
        $this->nomeConjuge = $nomeConjuge;
    }

    public function getDataNascConjuge() {
        return $this->dataNascConjuge;
    }

    public function setDataNascConjuge($dataNascConjuge) {
        $this->dataNascConjuge = $dataNascConjuge;
    }

    public function getNomePai() {
        return $this->nomePai;
    }

    public function setNomePai($nomePai) {
        $this->nomePai = $nomePai;
    }

    public function getNomeMae() {
        return $this->nomeMae;
    }

    public function setNomeMae($nomeMae) {
        $this->nomeMae = $nomeMae;
    }

    public function getNomeFilho1() {
        return $this->nomeFilho1;
    }

    public function setNomeFilho1($nomeFilho1) {
        $this->nomeFilho1 = $nomeFilho1;
    }

    public function getNomeFilho2() {
        return $this->nomeFilho2;
    }

    public function setNomeFilho2($nomeFilho2) {
        $this->nomeFilho2 = $nomeFilho2;
    }

    public function getNomeFilho3() {
        return $this->nomeFilho3;
    }

    public function setNomeFilho3($nomeFilho3) {
        $this->nomeFilho3 = $nomeFilho3;
    }

    public function getDataNascFilho1() {
        return $this->dataNascFilho1;
    }

    public function setDataNascFilho1($dataNascFilho1) {
        $this->dataNascFilho1 = $dataNascFilho1;
    }

    public function getDataNascFilho2() {
        return $this->dataNascFilho2;
    }

    public function setDataNascFilho2($dataNascFilho2) {
        $this->dataNascFilho2 = $dataNascFilho2;
    }

    public function getDataNascFilho3() {
        return $this->dataNascFilho3;
    }

    public function setDataNascFilho3($dataNascFilho3) {
        $this->dataNascFilho3 = $dataNascFilho3;
    }

    public function getLocado() {
        return $this->locado;
    }

    public function setLocado($locado) {
        $this->locado = $locado;
    }
    
    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }
    
    public function getNomeFilho4() {
        return $this->nomeFilho4;
    }

    public function setNomeFilho4($nomeFilho4) {
        $this->nomeFilho4 = $nomeFilho4;
    }

    public function getDataNascFilho4() {
        return $this->dataNascFilho4;
    }

    public function setDataNascFilho4($dataNascFilho4) {
        $this->dataNascFilho4 = $dataNascFilho4;
    }



}
?>