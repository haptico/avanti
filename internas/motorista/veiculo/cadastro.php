<div class="interno">
    <h2>CADASTRO</h2>
    <div id="alertSucesso" style="display:none" class="alert_sucesso" >Evento cadastrado com sucesso.</div>
    <div id="alertCadastro" style="display:none" class="alert_cadastro" > </div>
    <hr />
    <div class="form_div">
        
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value="<?=$titulo;?>" />

        <label for="texto">Descrição</label>
        <textarea name="texto" id="texto" ><?=$texto?></textarea>

        <label for="link">Data Início</label>
        <input type="text" name="data_inicio" id="data_inicio" value="<?=$dataInicio;?>" class="data" maxlength="10" />
        <img src="../img/calendar.gif" alt="Calendário" class="img_clicavel" />

        <label for="link">Data Final</label>
        <input type="text" name="data_fim" id="data_fim" value="<?=$dataFim;?>" class="data" maxlength="10" />
        <img src="../img/calendar.gif" alt="Calendário" class="img_clicavel" />

        <label for="ativo">Ativo</label>
        <select name="ativo" id="ativo">
            <option value="S">SIM</option>
            <option value="N">NÃO</option>
        </select>

        <div class="quebraLinha"></div>
       <input type="reset" value="Limpar" id="btnLimpar" /> 
       <input type="submit" value="Gravar" id="btnGravar" /> 
       
    </div>
</div>