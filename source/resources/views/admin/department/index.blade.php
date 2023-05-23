<div class="card">
    <div class="card-header">
        Lista Area Responsavel
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->nome }}</td>
                        <td>{{ $department->descricao }}</td>
                        <td>{{ $department->email }}</td>
                        <td>
                            <a href="{{ env('APP_URL') }}?page=area_responsavel&edit={{ $department->id }}"
                                class="btn btn-success text-white">
                                Editar
                            </a>
                            <a href="{{ env('APP_URL') }}?page=area_responsavel&delete={{ $department->id }}"
                                class="btn btn-danger text-white">
                                Apagar
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>




    </div>
</div>
