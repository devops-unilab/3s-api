@php
    $checkedLiberdade = '';
    $checkedAuroras = '';
    $checkedPalmares = '';
    $checkedMales = '';
    if (isset($_GET['campus'])) {
        $listaCampus = explode(',', $_GET['campus']);
        foreach ($listaCampus as $campus) {
            switch ($campus) {
                case 'liberdade':
                    $checkedLiberdade = 'checked';
                    break;
                case 'auroras':
                    $checkedAuroras = 'checked';
                    break;
                case 'palmares':
                    $checkedPalmares = 'checked';
                    break;
                case 'males':
                    $checkedMales = 'checked';
                    break;
            }
        }
    }
@endphp

<form id="form-filtro-campus">
    <hr>
    <label for="filtro-data-1">Campus</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value=""
            id="filtro-campus-liberdade" {{$checkedLiberdade}}>
        <label class="form-check-label" for="filtro-campus-liberdade">
            Liberdade
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value=""
            id="filtro-campus-palmares" {{$checkedPalmares}}>
        <label class="form-check-label" for="filtro-campus-palmares">
            Palmares
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value=""
            id="filtro-campus-auroras" {{$checkedAuroras}}>
        <label class="form-check-label" for="filtro-campus-auroras">
            Auroras
        </label>
    </div>


    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="filtro-campus-males" {{$checkedMales}}>
        <label class=""font-weight-normal" for="filtro-campus-males">
            Malês
        </label>
    </div>


</form>
