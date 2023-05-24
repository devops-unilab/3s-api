<div class="card">
    <div class="card-header">
        Lista Usuario
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Nível de Acesso</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Nível de Acesso</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($list as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nome }}</td>
                            <td>{{ $user->str_nivel }}</td>
                            <td>
                                <a href="{{ env('APP_URL') }}?page=usuario&edit={{ $user->id }}" class="btn btn-success text-white">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




    </div>
</div>
