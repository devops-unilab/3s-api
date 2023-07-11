<aside class="col-md-4 blog-sidebar">
    <h4 class="font-italic">Histórico</h4>
    <div class="container">
        @foreach ($order->statusLogs as $status)
            @php
                $strCartao = ' alert-warning ';
                if ($status->status === 'opened') {
                    $strCartao = '  notice-warning';
                } elseif ($status->status === 'in progress') {
                    $strCartao = '  notice-info ';
                } elseif ($status->status == 'closed') {
                    $strCartao = 'notice-success ';
                } elseif ($status->status === 'committed') {
                    $strCartao = 'notice-success ';
                } elseif ($status->status == 'canceled') {
                    $strCartao = ' notice-warning ';
                } elseif ($status->status == 'reserved') {
                    $strCartao = '  notice-warning ';
                } elseif ($status->status === 'pending customer response') {
                    $strCartao = '  notice-warning ';
                } elseif ($status->status == 'pending it resource') {
                    $strCartao = ' notice-warning';
                }
            @endphp
            <div class="notice {{ $strCartao }}">
                <strong>{{ __($status->status) }} </strong><br>
                @if ($status->status == 'commited')
                    <br>
                    @for ($i = 0; $i < intval($order->avaliacao); $i++)
                        <img class="m-2 estrela-1" nota="1" src="{{ asset('img/star1.png') }}"
                            alt="1">
                    @endfor
                @endif

                <br>{{ $status->message }}<br>
                <strong>{{ $status->nome_usuario }}<br>{{ date('d/m/Y - H:i', strtotime($status->created_at)) }}</strong>
            </div>
        @endforeach
    </div>
</aside>