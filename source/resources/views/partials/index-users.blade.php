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

                    @foreach ($users as $element)
                        <tr>
                            <td>{{ $element->id }}</td>
                            <td>{{ $element->nome }}</td>
                            <td>{{ $element->strNivel }}</td>
                            <td>
                                <a href="?page=usuario&edit={{ $element->id }}"
                                    class="btn btn-success text-white">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




    </div>
</div>
