<div class="row">
    <div class="col-md-12 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Cadastrar Ocorrência
        </h3>
        <div class="card card-body">
            <form id="insert_form_ocorrencia" method="post" action="" enctype="multipart/form-data">
                <span class="titulo medio">Informe os dados para cadastro</span><br>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="select-demanda">Serviço*</label>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <select id="select-servicos" name="servico" required>
                                    <option value="" selected="selected">Selecione um serviço</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->nome }}
                                            {{ $service->descricao != '' ? ' - ' . $service->descricao : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="descricao">Descrição*</label>
                                <textarea class="form-control" rows="3" name="descricao" id="descricao" required></textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="anexo" id="anexo"
                                        accept="application/msword, application/vnd.ms-excel,
                            application/vnd.ms-powerpoint,
                            text/plain,
                            application/pdf,
                            image/*,
                            application/zip,application/rar,
                            .ovpn,
                            .xlsx">
                                    <label class="custom-file-label" for="anexo" data-browse="Anexar">Anexar um
                                        Arquivo</label>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="row">
                            <!--Campus Local Sala Contato(Ramal e email)-->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="campus">Campus*</label>
                                <select name="campus" id="select-campus" required>
                                    <option value="" selected>Selecione um Campus</option>
                                    <option value="liberdade">Campus Liberdade</option>
                                    <option value="auroras">Campus Auroras</option>
                                    <option value="palmares">Campus Palmares</option>
                                    <option value="males">Campus dos Malês</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <label for="local_sala">Local/Sala</label>
                                <input class="form-control" type="text" name="local_sala" id="local_sala"
                                    value="">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <label for="patrimonio">Patrimônio</label>
                                <input class="form-control" type="text" name="patrimonio" id="patrimonio"
                                    value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <label for="ramal">Ramal</label>
                                <input class="form-control" type="number" name="ramal" id="ramal" value="">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <label for="email">E-mail*</label>
                                <input class="form-control" type="email" name="email" id="email"
                                    value="{{ $email }}" required>
                            </div>

                        </div>
                    </div>
                </div>
                <input type="hidden" name="enviar_ocorrencia" value="1">

            </form>


        </div><br><br>
        <div class="d-flex justify-content-center m-3">
            <button id="btn-inserir-ocorrencia" form="insert_form_ocorrencia" type="submit"
                class="btn btn-primary">Cadastrar
                Ocorrência</button>

        </div><br><br>
    </div>
</div>
