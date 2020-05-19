@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%">
    <div class="card-content">
        <span class="card-title">Felvett tárgyak</span>
        <div class="collection">
            @foreach ($student_subjects as $item)
            <a href="{{route('subject-details', $item->id)}}" class="row black-text collection-item waves-effect">
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
                    <form action="{{route('quit-subject', $item->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn-small light-blue waves-effect">Lead</button>
                    </form>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection