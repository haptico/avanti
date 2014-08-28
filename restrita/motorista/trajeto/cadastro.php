<script type="text/javascript" src="restrita/motorista/trajeto/js/cadastro.js"></script>

<input type="hidden" id="ID" name="id_trajeto" value="<?= $data['id_trajeto'] ?>" />
<div class="interno">
    <h2>Cadastro de Trajeto</h2>
    <div id="alertSucesso" style="display:none" class="alert_sucesso" >Evento cadastrado com sucesso.</div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <hr />
    <div class="form_div">
        <label for="descricao">Descrição <?= Util::imageRequired() ?></label>
        <textarea id="descricao" name="descricao" ><?= $data['descricao']; ?></textarea>

        <label for="id_veiculo">Veiculo <?= Util::imageRequired() ?></label>
        <select id="id_veiculo" name="id_veiculo" ><?= $data['combo_veiculo'] ?></select>

        <label for="id_uf_origem">Estado <?= Util::imageRequired() ?></label>
        <select id="id_uf_origem" name="id_uf_origem" ><?= $data['combo_uf_origem'] ?></select>

        <label for="id_cidade_origem">Cidade <?= Util::imageRequired() ?></label>
        <select id="id_cidade_origem" name="id_cidade_origem" ><?= $data['combo_cidade_origem'] ?></select>

        <label for="id_bairro_origem">Bairro <?= Util::imageRequired() ?></label>
        <select id="id_bairro_origem" name="id_bairro_origem" ><?= $data['combo_bairro_origem'] ?></select>

        <label for="id_uf_destino">Estado <?= Util::imageRequired() ?></label>
        <select id="id_uf_destino" name="id_uf_destino" ><?= $data['combo_uf_destino'] ?></select>

        <label for="id_cidade_destino">Cidade <?= Util::imageRequired() ?></label>
        <select id="id_cidade_destino" name="id_cidade_destino" ><?= $data['combo_cidade_destino'] ?></select>

        <label for="id_bairro_destino">Bairro <?= Util::imageRequired() ?></label>
        <select id="id_bairro_destino" name="id_bairro_destino" ><?= $data['combo_bairro_destino'] ?></select>

        <label for="hora_inicio">Hora Início <?= Util::imageRequired() ?></label>
        <input id="hora_inicio" name="hora_inicio" type="text" class="timepicker" value="<?= $data['hora_inicio']; ?>"/>

        <label for="hora_fim">Hora Fim <?= Util::imageRequired() ?></label>
        <input id="hora_fim" name="hora_fim" type="text" class="timepicker" value="<?= $data['hora_fim']; ?>"/>

        <label for="preco_mensalista">Preço Mensalista<?= Util::imageRequired() ?></label>
        <input id="preco_mensalista" name="preco_mensalista" type="text" value="<?= $data['preco_mensalista']; ?>"/>

        <label for="preco_avulso">Preço Avulso<?= Util::imageRequired() ?></label>
        <input id="preco_avulso" name="preco_avulso" type="text" value="<?= $data['preco_avulso']; ?>"/>

        <div class="quebraLinha"></div>
        <input type="button" value="Voltar" id="btnVoltar" /> 
        <input type="button" value="Gravar" id="btnGravar" /> 
    </div>
</div>
