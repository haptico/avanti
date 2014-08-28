<script type="text/javascript" src="internas/motorista/trajeto/js/lista.js"></script>
<div class="interno">
    <h2>Lista de Trajetos</h2>
    <hr />
    
    <div id="alertSucesso" style="display:none" class="alert_sucesso" >Trajeto cadastrado com sucesso.</div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <input type="hidden" id="ID" name="ID" value="" />
    <input type="hidden" id="filtrou" name="filtrou" value="" />
    <div>
        <input type='button' id="btnNovoRegistro" value="Incluir novo registro" class="btn botaoAdicionar" />
    </div>

    <? if ($data['corpo_tabela'] != "") { ?>
        <table id="tableLista" class="tablesorter" >
            <thead>
                <tr>
                    <th width="40px" align="center">Editar</th>
                    <th>Descrição</th>
                    <th>Veículo</th>
                    <th>Bairro de Origem</th>
                    <th>Bairro de Destino</th>
                    <th>Hora de Início</th>
                    <th>Hora de Fim</th>
                    <th>Preço Mensalista</th>
                    <th>Preço Avulso</th>
                </tr>
            </thead>
            <tbody>
                <?=$data['corpo_tabela']?>
            </tbody>
        </table>

        <div id="pager" class="pager">
            <form action="">
                <img src="../img/first.png" class="first" alt="primeira p&aacute;gina"/>
                <img src="../img/prev.png" class="prev" alt="p&aacute;gina anterior"/>
                <input type="text" class="pagedisplay"/>
                <img src="../img/next.png" class="next" alt="pr&oacute;xima p&aacute;gina"/>
                <img src="../img/last.png" class="last" alt="&uacute;ltima p&aacute;gina"/>
                <select class="pagesize">
                    <option selected="selected"  value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option  value="40">40</option>
                </select>
            </form>
        </div>
    <?
    }else{
        echo 'Nenhum trajeto encontrado';
    }
    ?>
</div>