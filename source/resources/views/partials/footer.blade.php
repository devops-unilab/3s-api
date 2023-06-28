</main>
<footer class="blog-footer">
    <p>Desenvolvido pela <a href="https://dti.unilab.edu.br/"> Diretoria de Tecnologia da Informação DTI </a> / <a
            href="http://unilab.edu.br">Unilab</a></p>

</footer>



<!-- Modal -->
<div class="modal fade" id="modalResposta" tabindex="-1" role="dialog" aria-labelledby="labelModalResposta"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModalResposta">Resposta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="textoModalResposta"></span>
            </div>
            <div class="modal-footer">
                <button type="button" id="botao-modal-resposta" class="btn btn-primary"
                    data-dismiss="modal">Continuar</button>
            </div>
        </div>
    </div>
</div>


</body>

<script src="js/barra_2.0.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="vendor/popper.min.js"></script>
<script src="vendor/bootstrap-4.6.0/js/bootstrap.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="js/selectize.js"></script>
<script src="js/login_load.js?a=12"></script>
<script src="js/mudar_nivel.js?a=12"></script>
<script src="js/change-contraste.js?a=1"></script>
<script src="js/ocorrencia_selectize.js?a=1"></script>
<script src="js/jquery.easyPaginate.js?a=1"></script>
<script src="js/ocorrencia.js?a=1451"></script>
@if (isset($_GET['page']) && $_GET['page'] == 'ocorrencia' && isset($_GET['selecionar']))
    <script src="js/mensagem_forum.js?a=174"></script>
@endif
@if (isset($_GET['page']) && $_GET['page'] == 'painel_kamban')
    <script src="js/painel_kamban.js?123=123"></script>
@endif
@if (isset($_GET['page']) && $_GET['page'] == 'painel_tabela')
    <script src="js/painel_tabela.js?a=12"></script>
@endif
<script src="js/status_ocorrencia.js"></script>

</html>
