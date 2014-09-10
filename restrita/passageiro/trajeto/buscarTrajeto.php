<script type="text/javascript" src="restrita/passageiro/trajeto/js/buscarTrajeto.js"></script>
<div class="interno">
    
    
    <div id="alertSucesso" style="display:none" class="alert_sucesso" ></div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <input type="hidden" id="origem_uf_UPDATE" value="<?=$data['origem_uf']?>" />
    <input type="hidden" id="origem_cidade_UPDATE" value="<?=$data['origem_cidade']?>" />
    <input type="hidden" id="origem_bairro_UPDATE" value="<?=$data['origem_bairro']?>" />
    <input type="hidden" id="destino_uf_UPDATE" value="<?=$data['destino_uf']?>" />
    <input type="hidden" id="destino_cidade_UPDATE" value="<?=$data['destino_cidade']?>" />
    <input type="hidden" id="destino_bairro_UPDATE" value="<?=$data['destino_bairro']?>" />
    <div>
        <fieldset>
            <legend>Origem</legend>
            <label for="origem_uf">Estado</label>
            <select name="origem_uf" id="origem_uf"><?=$data['COMBO_ORIGEM_UF'];?></select>
            <label for="origem_cidade">Cidade</label>
            <select name="origem_cidade" id="origem_cidade"><?=$data['COMBO_ORIGEM_CIDADE'];?></select>
            <label for="origem_bairro">Bairro</label>
            <select name="origem_bairro" id="origem_bairro"><?=$data['COMBO_ORIGEM_BAIRRO'];?></select>
        </fieldset>
        <fieldset>
            <legend>Destino</legend>
            <label for="destino_uf">Estado</label>
            <select name="destino_uf" id="destino_uf"><?=$data['COMBO_DESTINO_UF'];?></select>
            <label for="destino_cidade">Cidade</label>
            <select name="destino_cidade" id="destino_cidade"><?=$data['COMBO_DESTINO_CIDADE'];?></select>
            <label for="destino_bairro">Bairro</label>
            <select name="destino_bairro" id="destino_bairro"><?=$data['COMBO_DESTINO_BAIRRO'];?></select>
        </fieldset>
        
        <input type="button" value="Voltar" id="btnVoltar" />
        <input type='button' id="btnNovaBusca" value="Buscar" class="btn botaoAdicionar" />
        
    </div>
    <div class="quebraLinha" />
    
    
    <? if ($data['corpo_tabela'] != "") { ?>
        <h2>Trajeots Encontados</h2>
        <hr />
        <table id="tableLista" class="tablesorter" >
            <thead>
                <tr>
                    <th>Pontos</th>
                    <th>Veículo</th>
                    <th>Bairro de Origem</th>
                    <th>Bairro de Destino</th>
                    <th>Hora de Início</th>
                    <th>Hora de Fim</th>
                    <th>Preço Mensal</th>
                    <th>Preço Avulso</th>
                    <th>Responsável</th>
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
    }elseif($data['buscou']){
        echo 'Nenhum trajeto encontrado';
    }
    ?>
</div>
