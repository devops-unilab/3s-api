@php
    $checkedSetor = '';
    if (isset($_GET['setor'])) {
        $checkedSetor = 'checked';
    }
    $checkedDemanda = '';
    if (isset($_GET['demanda'])) {
        $checkedDemanda = 'checked';
    }
    $checkedSolicitacao = '';
    if (isset($_GET['solicitacao'])) {
        $checkedSolicitacao = 'checked';
    }
@endphp
<form id="form-filtro-basico">
    <input type="hidden" value="{{$userDivision->id}}" id="meu-setor" name="meu-setor">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="filtro-meu-setor" {{ $checkedSetor }}>
        <label class="custom-control-label" for="filtro-meu-setor">Demandas ({{ $userDivision->name }}) </label>
    </div>
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="filtro-minhas-demandas" {{ $checkedDemanda }}>
        <label class="custom-control-label" for="filtro-minhas-demandas">Meus Atendimentos</label>
    </div>
    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="filtro-minhas-solicitacoes" {{ $checkedSolicitacao }}>
        <label class="custom-control-label" for="filtro-minhas-solicitacoes">Minhas Solicitações</label>
    </div>
    <div class="form-group">
        <label for="select-tecnico">Técnico Responsável</label>
        <select id="select-tecnico">
            <option value="">Selecione um atendente</option>';
            @foreach ($providers as $tecnico)
                @php
                    $selectedAtt = '';
                    if (isset($_GET['tecnico'])) {
                        if ($tecnico->id == $_GET['tecnico']) {
                            $selectedAtt = 'selected';
                        }
                    }
                @endphp
                <option value="{{ $tecnico->id }}" {{ $selectedAtt }}>{{ $tecnico->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="select-requisitante">Usuário Requisitante</label>
        <select id="select-requisitante">
            <option value="">Selecione um Requisitante</option>
            @foreach ($allUsers as $userElement)
                @php
                    $selectedAtt = '';
                    if (isset($_GET['requisitante'])) {
                        if ($userElement->id == $_GET['requisitante']) {
                            $selectedAtt = 'selected';
                        }
                    }
                @endphp
                <option value="{{ $userElement->id }}" {{ $selectedAtt }}>{{ $userElement->name }}</option>
            @endforeach
        </select>
    </div>
</form>
