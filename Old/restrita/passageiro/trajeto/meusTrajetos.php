<script type="text/javascript" src="restrita/passageiro/trajeto/js/meusTrajetos.js"></script>
<div class="interno">
    
    
    <div id="alertSucesso" style="display:none" class="alert_sucesso" ></div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <input type="hidden" id="ID" name="id_trajeto" value="" />
    <div>
        <input type='button' id="btnNovoRegistro" value="Buscar novo trajeto" class="btn botaoAdicionar" />
    </div>
    <div class="quebraLinha" />
    
    <h2>Meus Trajetos Mensais</h2>
    <hr />
    <? if ($data['mensalista']['corpo_tabela'] != "") { ?>
        <table id="tableLista" class="tablesorter" >
            <thead>
                <tr>
                    <th>Ponto</th>
                    <th>Bairro de Origem</th>
                    <th>Bairro de Destino</th>
                    <th>Veículo</th>
                    <th>Responsável</th>
                    <th>Hora de Início</th>
                    <th>Hora de Fim</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?=$data['mensalista']['corpo_tabela']?>
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
    
    <h2>Meus Trajetos Avulso</h2>
    <hr />
    <? if ($data['avulso']['corpo_tabela'] != "") { ?>
        <table id="tableLista" class="tablesorter" >
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Ponto</th>
                    <th>Bairro de Origem</th>
                    <th>Bairro de Destino</th>
                    <th>Veículo</th>
                    <th>Responsável</th>
                    <th>Hora de Início</th>
                    <th>Hora de Fim</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?=$data['avulso']['corpo_tabela']?>
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
