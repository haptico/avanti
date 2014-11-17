

<div class="titulo">
    <h1><?=$SYS_GIF_CORRENTE;?> HOME </h1>
</div>
<?php
$lista = UsuarioAction::getList(' AND u.ativo = 1 AND u.logado = 1 AND u.ultima_atividade > sysdate - 1/24', 'u.ultima_atividade DESC');

//LOG
LogAction::gravarProcedimento($opt, "Acessando Página Principal", '', '', Log::NAVEGACAO, Log::BARRA_LATERAL);

function dashShow($t){
    return (!empty($t)) && $t != -1 ? $t : '-';
}

if (count($lista) > 0) {
    $l = 0;
    foreach ($lista as $object) {
        $class = ($l % 2 == 0) ? 'class="par"' : 'class="impar"';
        $list .= '
    <tr '.$class.'>
        <td>'.dashShow($object->getNome()).'</td>
        <td>'.dashShow($object->getProjeto()).'</td>
        <td align="center">'.dashShow($object->getUltimaAtividade()).'</td>
    </tr>
';
        $l++;
    }
}
?>
<table width="100%" class="datagrid">
    <caption>Lista de usuários on-line</caption>
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Projeto</th>
            <th scope="col">Última Atividade</th>
            <? /*<th scope="col">Usuário</th>
            <th scope="col">Empresa</th>
            <th scope="col">Ação</th>
             *
             */?>
        </tr>
    </thead>
    <tbody>
        <?=$list;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7">Registros encontrados <?=$l;?></th>
        </tr>
    </tfoot>
</table>
