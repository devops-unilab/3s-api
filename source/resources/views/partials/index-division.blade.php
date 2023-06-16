<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

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
                                <tbody>

                                    @foreach ($list as $element)
                                        <tr>
                                            <td>{{ $element->id }}</td>
                                            <td>{{ $element->nome }}</td>
                                            <td>{{ $element->descricao }}</td>
                                            <td>{{ $element->email }}</td>
                                            <td>
                                                <a href="?page=area_responsavel&edit={{ $element->id }}"
                                                    class="btn btn-success text-white">Editar</a>
                                                <a href="?page=area_responsavel&delete={{ $element->id }}"
                                                    class="btn btn-danger text-white">Apagar</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
