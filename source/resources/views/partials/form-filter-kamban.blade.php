
    <div class="card-header pb-4 mb-4 font-italic">
        Painel Kamban
        <select name="setor" id="select-setores">
            <option value="">Filtrar por Setor</option>
            @foreach ($divisions as $areaResponsavel)
                <option value="{{ $areaResponsavel->id }}">{{ $areaResponsavel->nome }}</option>
            @endforeach
        </select>
        <button id="btn-expandir-tela" type="button"
            class="float-right btn ml-3 btn-warning btn-circle btn-lg collapsed"><i
                class="fa fa-expand icone-maior"></i></button>
    </div>
