@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%">
    <div class="card-content">
        <span class="card-title">Elérhető tárgyak</span>
        <div class="collection">
            @foreach ($subjects as $item)
            <div class="row collection-item">
                <div class="col s2 light-blue-text">
                    <div>Tárgykód:</div>
                    <div>Név:</div>
                    <div>Leírás:</div>
                    <div>Kredit érték:</div>
                    <div>Tanár neve:</div>
                </div>
                <div class="col s10">
                    <div class="truncate">{{$item->code}}</div>
                    <div class="truncate">{{$item->name}}</div>
                    <div class="truncate">{{$item->desc ?? '-'}}</div>
                    <div class="truncate">{{$item->value}}</div>
                    <div class="truncate">{{$item->teacher}}</div>
                </div>
                <div class="secondary-content">
                    <a type="submit" href="{{route('add-subject', $item->id)}}" class="btn-small light-blue waves-effect">Felvesz</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection