@extends('layouts/app')

@section('content')
<div class="card">
    <div class="card-content">
        <div class="row">
            <div class="col s6">
                <strong>Tárgy:</strong> {{App\Subject::find($subject)->name}}
            </div>
            <div class="col s6">
                <strong>Tanár:</strong> {{App\User::find(App\Subject::find($subject)->teacher)->name}}
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <strong>Elérhető pontszám:</strong> {{$assignment->value}} pont
            </div>
            <div class="col s6">
                <strong>Határidő:</strong> {{$assignment->deadline_from.' - '.$assignment->deadline_to}}
            </div>
        </div>
        <div class="row">
        </div>
        <details open>
            <summary><strong>Feladat leírása</strong></summary>
            <div>
                {!!nl2br($assignment->desc)!!}
            </div>
        </details>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <span class="card-title">Beadás</span>
        <form method="POST" action="{{route('store-solution')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{Auth::id()}}" name="student">
            <input type="hidden" value="{{$assignment->id}}" name="assignment">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Fájl</span>
                    <input type="file" name="file" value="{{old('file')}}">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" name="file_path" value="{{old('file_path')}}">
                </div>
            </div>
            <div class="input-field">
                <textarea id="desc" class="materialize-textarea"
                    name="solution">{{old('solution')}}</textarea>
                <label for="desc">Megoldás</label>
                <div>
                    @error('desc')
                        <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn light-blue">Bead</button>
        </form>
    </div>
</div>
@endsection