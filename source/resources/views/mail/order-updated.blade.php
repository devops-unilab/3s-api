<!DOCTYPE html>
<html>

<head>
    <title>Status do Pedido Atualizado</title>
</head>

<body>
    <p>Prezado(a) {{ $toName }},</p>
    <p>{{ $text }}</p>
    <p><a href="{{ env('APP_URL') }}">Ocorrência Nº {{ $order->id }}</a></p>
    <ul>
        <li>Serviço Solicitado: {{ $order->service->name }}</li>
        <li>Descrição do Problema: {{ $order->description }}</li>
        <li>Setor Responsável: {{ $order->service->division->name }} - {{ $order->service->division->description }}</li>
        <li>Cliente: {{ $order->customer->name }}</li>
    </ul><br>
    <p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>
</body>

</html>
