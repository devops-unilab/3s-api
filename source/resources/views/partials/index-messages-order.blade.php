 <!-- Modal -->
 <div class="modal fade" id="modalDeleteChat" tabindex="-1" aria-labelledby="modalDeleteChatLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalDeleteChatLabel">Apagar Mensagem</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Tem certeza que deseja apagar esta mensagem?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                 <form action="" method="post">
                     <input type="hidden" id="chatDelete" name="chatDelete" value="" />
                     <button type="submit" class="btn btn-primary">Confirmar</button>
                 </form>

             </div>
         </div>
     </div>
 </div>


 <div class="container">
     <div class="row">
         <div class="chatbox chatbox22">
             <div class="chatbox__title">
                 <h5 class="text-white">#<span id="id-ocorrencia">{{ $order->id }}</span></h5>
                 <button class="chatbox__title__tray"><span></span></button>
             </div>
             <div id="corpo-chat" class="chatbox__body">


                 @foreach ($messageList as $mensagemForum)
                     <div class="chatbox__body__message chatbox__body__message--left">

                         <div class="chatbox_timing">
                             <ul>
                                 <li><a href="#"><i class="fa fa-calendar"></i>
                                         {{ date('d/m/Y', strtotime($mensagemForum->created_at)) }}</a></li>
                                 <li><a href="#"><i class="fa fa-clock-o"></i>
                                         {{ date('H:i', strtotime($mensagemForum->created_at)) }}</a></a></li>
                                 @if ($canDelete = $mensagemForum->user_id == $userId && $mensagemForum->order_status === 'e')
                                     <li><button data-toggle="modal" onclick="changeField(' . $mensagemForum->id . ')"
                                             data-target="#modalDeleteChat"><i class="fa fa-trash-o"></i> Apagar
                                             </a></button></li>
                                 @endif

                             </ul>
                         </div>
                         <!-- <img src="https://www.gstatic.com/webp/gallery/2.jpg"
            alt="Picture">-->
                         <div class="clearfix"></div>
                         <div class="ul_section_full">
                             <ul class="ul_msg">
                                 <li><strong>{{ substr(ucwords(mb_strtolower($mensagemForum->user_name, 'UTF-8')), 0, 14) . (strlen($mensagemForum->user_name) > 14 ? '...' : '') }}</strong>
                                 </li>
                                 @if ($mensagemForum->message_type == 2)
                                     <li>Anexo: <a href="uploads/{{ $mensagemForum->message_content }}">Clique aqui</a>
                                     </li>
                                 @else
                                     <li>{{ strip_tags($mensagemForum->message_content) }}</li>
                                 @endif

                             </ul>
                             <div class="clearfix"></div>

                         </div>

                     </div>
                     @if ($loop->last)
                         <span id="ultimo-id-post" class="escondido">{{ $mensagemForum->id }}</span>
                     @endif
                 @endforeach
             </div>
             <div class="panel-footer">
                 @if ($canSendMessage)
                     <form id="insert_form_mensagem_forum" class="user" method="post">
                         <input type="hidden" name="enviar_mensagem_forum" value="1">
                         <input type="hidden" name="ocorrencia" value="{{ $order->id }}">
                         <input type="hidden" id="campo_tipo" name="tipo" value="1">
                         <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" name="muda-tipo" id="muda-tipo">
                             <label class="custom-control-label" for="muda-tipo">Enviar Arquivo</label>
                         </div>
                         <div class="custom-file mb-3 escondido" id="campo-anexo">
                             <input type="file" class="custom-file-input" name="anexo" id="anexo"
                                 accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*, application/zip,application/rar, .ovpn, .xlsx">
                             <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um
                                 Arquivo</label>
                         </div>
                         <div class="input-group">
                             <input name="mensagem" id="campo-texto" type="text"
                                 class="form-control input-sm chat_set_height" placeholder="Digite sua mensagem aqui..."
                                 tabindex="0" dir="ltr" spellcheck="false" autocomplete="off" autocorrect="off"
                                 autocapitalize="off" contenteditable="true" />
                             <span class="input-group-btn"> <button class="btn bt_bg btn-sm"
                                     id="botao-enviar-mensagem">Enviar</button></span>
                         </div>
                     </form>
                 @endif
             </div>
         </div>
     </div>
 </div>

 <script>
     function changeField(id) {
         document.getElementById('chatDelete').value = id;
     }
 </script>
