<div class="card">
    <div class="card-header">
        Lista Servico
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Tempo Sla</th>
                        <th>Area Responsavel</th>
                        <th>Visão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Tempo Sla</th>
                        <th>Area Responsavel</th>
                        <th>Visão</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->nome }}</td>
                            <td>{{ $service->descricao }}</td>
                            <td>{{ $service->tempo_sla }}</td>
                            <td>{{ $service->area_responsavel }}</td>
                            <td>{{ $service->visao }}</td>
                            <td>

                                <a href="{{ env('APP_URL') }}?page=servico&edit={{$service->id}}"
                                    class="btn btn-success btn-circle btn-lg">
                                    <i class="fa fa-pencil icone-maior"></i>
                                </a>
                                <a href="{{ env('APP_URL') }}?page=servico&delete={{$service->id}}"
                                    class="btn btn-danger btn-circle btn-lg">
                                    <i class="fa fa-trash icone-maior"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>


            </table>
        </div>




    </div>
</div>
