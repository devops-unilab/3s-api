<div class="row">
    <div class="col-md-12 blog-main">

        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Para continuar confirme os chamados fechados.
        </h3>

        <div class="alert-group">
            @forelse ($requests as $elemento)
                @php
                    $strClass = 'alert-warning';
                    if ($elemento->status == 'a') {
                        $strClass = 'alert-warning';
                    } elseif ($elemento->status == 'e') {
                        $strClass = 'alert-info';
                    } elseif ($elemento->status == 'f') {
                        $strClass = 'alert-success';
                    } elseif ($elemento->status == 'g') {
                        $strClass = 'alert-success';
                    } elseif ($elemento->status == 'h') {
                        $strClass = 'alert-secondary';
                    } elseif ($elemento->status == 'r') {
                        $strClass = 'alert-warning';
                    } elseif ($elemento->status == 'b') {
                        $strClass = 'alert-warning';
                    } elseif ($elemento->status == 'c') {
                        $strClass = 'alert-info';
                    } elseif ($elemento->status == 'd') {
                        $strClass = 'alert-danger';
                    } elseif ($elemento->status == 'i') {
                        $strClass = 'alert-danger';
                    }
                @endphp
                <div class="alert {{ $strClass }} alert-dismissable">
                    <a href="?page=ocorrencia&selecionar={{ $elemento->id }}" class="close">
                        <i class="fa fa-search icone-maior"></i>
                    </a>
                    <strong>#{{ $elemento->id }}</strong>
                    {{ substr($elemento->descricao, 0, 80) }}...
                </div>
            @empty
                <div class="alert alert-light alert-dismissable text-center">
                    <strong>Nenhuma Ocorrência</strong>

                </div>
            @endforelse
        </div>
    </div>
</div>
