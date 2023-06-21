<select name="setor" id="select-setores">
    <option value="">Filtrar por Setor</option>
    @foreach ($divisions as $areaResponsavel)
        <option value="{{ $areaResponsavel->nome }}">{{ $areaResponsavel->nome }}</option>
    @endforeach
</select>
