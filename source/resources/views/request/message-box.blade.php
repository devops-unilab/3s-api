<form id="insert_form_mensagem_forum" class="user" method="post">
    <input type="hidden" name="enviar_mensagem_forum" value="1">
    <input type="hidden" name="ocorrencia" value="{{$idRequest}}">
    <input type="hidden" id="campo_tipo" name="tipo" value="1">

    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
        <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
    </div>
    <div class="custom-file mb-3 escondido" id="campo-anexo">
        <input type="file" class="custom-file-input" name="anexo" id="anexo"
            accept="
                application/msword,
                application/vnd.ms-excel,
                application/vnd.ms-powerpoint,
                text/plain, application/pdf,
                image/*,
                application/zip,
                application/rar,
                .ovpn,
                .xlsx">
        <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um Arquivo</label>
    </div>
    <div class="input-group">
        <input name="mensagem" id="campo-texto" type="text" class="form-control input-sm chat_set_height"
            placeholder="Digite sua mensagem aqui..." tabindex="0" dir="ltr" spellcheck="false"
            autocomplete="off" autocorrect="off" autocapitalize="off" contenteditable="true" />
        <span class="input-group-btn">
            <button class="btn bt_bg btn-sm" id="botao-enviar-mensagem">
                Enviar
            </button></span>
    </div>
</form>
