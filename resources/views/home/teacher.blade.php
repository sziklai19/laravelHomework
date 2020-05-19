@extends('layouts.app')

@section('content')
@if (Session::has("public"))
@if (Session::get('public') == 1)
<script>
    M.toast({html: 'Tárgy sikeresen publikálva', classes: 'green'});
</script>
@else
<script>
    M.toast({html: 'Tárgy sikeresen visszavonva', classes: 'green'});
</script>
@endif
@endif
<div class="card" style="width: 100%">
    <div class="card-content">
        <span class="card-title">Létrehozott tárgyak</span>
        <div class="collection">
            @foreach ($teacher_subjects as $item)
            <a href="{{route('subject-details', $item->id)}}" class="row black-text collection-item waves-effect">
                <div class="col s2 light-blue-text">
                    <div>Tárgykód:</div>
                    <div>Név:</div>
                    <div>Leírás:</div>
                    <div>Kredit érték:</div>
                </div>
                <div class="col s10">
                    <div class="truncate">{{$item->code}}</div>
                    <div class="truncate">{{$item->name}}</div>
                    <div class="truncate">{{$item->desc ?? '-'}}</div>
                    <div class="truncate">{{$item->value}}</div>
                </div>
                <div class="secondary-content">
                    <form action="{{route('publicate', ['id' => $item->id])}}" method="POST">
                        @csrf
                        <input name="public" type="hidden" value="{{$item->public?0:1}}">
                        <button
                            class="btn-small light-blue white-text">{{ ($item->public) ? 'Publikálás visszavonása' : 'Publikál' }}</button>
                    </form>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection