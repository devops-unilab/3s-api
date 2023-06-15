@php
    $strId = '';
    if(isset($id) && $id != ''){
        $strId = ' id = ' . $id;
    }
@endphp
<div {{ $strId }} class="alert-group">
    @forelse ($orders as $order)
        @php
            $strClass = 'alert-warning';
            if ($order->status == 'a') {
                $strClass = 'alert-warning';
            } elseif ($order->status == 'e') {
                //Em atendimento
                $strClass = 'alert-info';
            } elseif ($order->status == 'f') {
                //Fechado
                $strClass = 'alert-success';
            } elseif ($order->status == 'g') {
                //Fechado confirmado
                $strClass = 'alert-success';
            } elseif ($order->status == 'h') {
                //Cancelado
                $strClass = 'alert-secondary';
            } elseif ($order->status == 'r') {
                //reaberto
                $strClass = 'alert-warning';
            } elseif ($order->status == 'b') {
                //reservado
                $strClass = 'alert-warning';
            } elseif ($order->status == 'c') {
                //em espera
                $strClass = 'alert-info';
            } elseif ($order->status == 'd') {
                //Aguardando usuario
                $strClass = 'alert-danger';
            } elseif ($order->status == 'i') {
                //Aguardando ativo
                $strClass = 'alert-danger';
            }
        @endphp
        <div class="alert {{ $strClass }} alert-dismissable">
            <a href="?page=ocorrencia&selecionar={{$order->id}}" class="close"><i
                    class="fa fa-search icone-maior"></i></a>
            <strong>#{{ $order->id }}</strong>{{ substr($order->descricao, 0, 200) }}...
        </div>
        @empty
        <div class="alert alert-light alert-dismissable text-center">
            <strong>Nenhuma Ocorrência</strong>
        </div>
    @endforelse
</div>
