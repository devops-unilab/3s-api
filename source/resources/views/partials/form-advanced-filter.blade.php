@php
    $dataAbertura1 = '';
    $dataAbertura2 = '';
    if (isset($_GET['data_abertura1'])) {
        $dataAbertura1 = $_GET['data_abertura1'];
    }
    if (isset($_GET['data_abertura2'])) {
        $dataAbertura2 = $_GET['data_abertura2'];
    }
@endphp
<hr />
<form id="form-filtro-avancado">
    <div class="form-group">
        <label for="filtro-data-1">Setor Requisitante</label>
        <select id="select-setores-filtro">
            <option value="">Selecione o Setor</option>';
            @foreach ($divisionCustomers as $requester)
                <option value="{{ $requester->division_sig_id }}">{{ $requester->division_sig }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="filtro-data-1">Setor Responsável</label>
        <select id="select-setores-filtro2">
            <option value="">Selecione o Solicitante</option>';
            @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
            @endforeach

        </select>
    </div>

    <hr>
    <label for="filtro-data-1">Data de Abertura</label>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="filtro-data-1">Data Inicial</label>
            <input type="date" class="form-control" id="filtro-data-1" name="filtro-data-1"
                value="{{$dataAbertura1}}">

        </div>
        <div class="col-md-6 mb-3">
            <label for="filtro-data-2">Data Final</label>
            <input type="date" class="form-control" id="filtro-data-2" name="filtro-data-2"
                value="{{$dataAbertura2}}">

        </div>
    </div>

</form>
