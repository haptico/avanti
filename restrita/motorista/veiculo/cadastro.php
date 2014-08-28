<script type="text/javascript" src="restrita/motorista/veiculo/js/cadastro.js"></script>
<input type="hidden" id="ID" name="id_veiculo" value="<?= $data['ID'] ?>" />
<div class="interno">
    <h2>Cadastro de veículos</h2>
    <div id="alertSucesso" style="display:none" class="alert_sucesso" >Evento cadastrado com sucesso.</div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <hr />
    <div class="form_div">
        
        <label for="id_tipo_veiculo">Tipo do Veículo</label>
        <select name="id_tipo_veiculo" id="id_tipo_veiculo">
            <?=$data['comboTipoVeiculo'];?>
        </select>
        
        <label for="placa">Placa</label>
        <input type="text" name="placa" id="placa" value="<?=$data['placa'];?>" />
        
        <label for="vagas">Quantidade de vagas</label>
        <input type="text" name="vagas" id="vagas" value="<?=$data['vagas'];?>" />

        <label for="descricao_veiculo">Descrição</label>
        <textarea name="descricao_veiculo" id="descricao_veiculo" ><?=$data['descricao_veiculo']?></textarea>

        <div class="quebraLinha"></div>
        <input type="button" value="Voltar" id="btnVoltar" /> 
        <input type="button" value="Gravar" id="btnGravar" />
       
    </div>
</div>