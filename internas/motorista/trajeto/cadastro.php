<script type="text/javascript" src="internas/motorista/trajeto/js/cadastro.js"></script>
<input type="hidden" id="ID" name="ID" value="<?= $data['ID'] ?>" />
<div class="interno">
    <h2>Cadastro de Trajeto</h2>
    <div id="alertSucesso" style="display:none" class="alert_sucesso" >Evento cadastrado com sucesso.</div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <hr />
    <div class="form_div">
        <label for="descricao" class="description">Descrição <?= Util::imageRequired() ?></label>
        <textarea id="descricao" name="descricao" ><?= $data['descricao']; ?></textarea>

        <label for="id_veiculo">Veiculo <?= Util::imageRequired() ?></label>
        <select id="id_veiculo" name="id_veiculo" ><?= $data['combo_veiculo'] ?></select>

        <label for="id_uf_origem">Estado <?= Util::imageRequired() ?></label>
        <?= $data['combo_uf_origem'] ?>

        <label for="id_cidade_origem">Cidade <?= Util::imageRequired() ?></label>
        <select id="id_cidade_origem" name="id_cidade_origem" ></select>

        <label for="id_bairro_origem">Bairro <?= Util::imageRequired() ?></label>
        <select id="id_bairro_origem" name="id_bairro_origem" ></select>

        <label for="id_uf_destino">Estado <?= Util::imageRequired() ?></label>
        <?= $data['combo_uf_destino'] ?>

        <label for="id_cidade_destino">Cidade <?= Util::imageRequired() ?></label>
        <select id="id_cidade_destino" name="id_cidade_destino" ></select>

        <label for="id_bairro_destino">Bairro <?= Util::imageRequired() ?></label>
        <select id="id_bairro_destino" name="id_bairro_destino" ></select>

        <label for="hora_inicio" class="description">Hora Início <?= Util::imageRequired() ?></label>
        <input id="hora_inicio" name="hora_inicio" type="text" value="<?= $data['hora_inicio']; ?>"/>

        <label for="hora_fim" class="description">Hora Fim <?= Util::imageRequired() ?></label>
        <input id="hora_fim" name="hora_fim" type="text" value="<?= $data['hora_fim']; ?>"/>

        <label for="preco_mensalista" class="description">Preço Mensalista<?= Util::imageRequired() ?></label>
        <input id="preco_mensalista" name="preco_mensalista" type="text" value="<?= $data['preco_mensalista']; ?>"/>

        <label for="preco_avulso" class="description">Preço Avulso<?= Util::imageRequired() ?></label>
        <input id="preco_avulso" name="preco_avulso" type="text" value="<?= $data['preco_avulso']; ?>"/>

        <div class="quebraLinha"></div>
        <input type="button" value="Voltar" id="btnVoltar" /> 
        <input type="button" value="Gravar" id="btnGravar" /> 
    </div>
</div>