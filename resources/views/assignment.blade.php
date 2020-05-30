@extends('layouts/app')

@section('title', $assignment->name)

@section('content')
@if (Auth::user()->teacher)
<div class="card">
    <div class="card-content">
        <span class="card-title">{{$assignment->name}}</span>
        <table>
            <tr>
                <th>Név:</th><td>{{$assignment->name}}</td>
            </tr>
            <tr>
                <th>Leírás:</th><td>{!!nl2br($assignment->desc)!!}</td>
            </tr>
            <tr>
                <th>Pontérték:</th><td>{{$assignment->value == null ? '-' : $assignment->value.' pont'}}</td>
            </tr>
            <tr>
                <th>Határidő:</th><td>{{$assignment->deadline_from.' - '.$assignment->deadline_to}}</td>
            </tr>
            <tr>
                <th>Beadott:</th><td></td>
            </tr>
            <tr>
                <th>Értékelt:</th><td></td>
            </tr>
        </table>
    </div>
    <div class="card-action">
        <a href="{{route('modify-assignment', ['subject' => $subject, 'id' => $assignment->id])}}" class="light-blue-text">Módosítás</a>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <span class="card-title">Megoldások</span>
        <table>
            <tr>
                <th>Beadás dátuma</th>
                <th>Diák neve</th>
                <th>Diák e-mail címe</th>
                <th>Adott pontszám</th>
                <th>Értékelés időpontja</th>
                <th></th>
            </tr>
            @foreach ($solutions as $solution)
                <tr style="{{$solution->rated_at != null ? 'border-left: 5px solid green;' : 'border-left: 5px solid transparent;'}}">
                    <td>{{$solution->updated_at}}</td>
                    <td>{{App\User::find($solution->student)->name}}</td>
                    <td>{{App\User::find($solution->student)->email}}</td>
                    <td>{{$solution->result}}</td>
                    <td>{{$solution->rated_at}}</td>
                    @if ($solution->rated_at == null)
                    <td><a href="{{route('solution', $solution->id)}}">Értékel</a></td>
                    @else
                    <td></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</div>
@else
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
        <form method="POST" action="{{route('store-solution')}}">
            @csrf
            <input type="hidden" value="{{Auth::user()->id}}" name="student">
            <input type="hidden" value="{{$assignment->id}}" name="assignment">
            <div class="input-field">
                <textarea id="desc" class="materialize-textarea"
                    name="solution" required>{{old('solution')}}</textarea>
                <label for="desc">Megoldás</label>
                <div>
                    @error('desc')
                        <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="file-field input-field">
                <div class="btn light-blue">
                  <span>Fájl feltöltése</span>
                  <input type="file">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" name="file">
                </div>
              </div>
            <button type="submit" class="btn light-blue">Bead</button>
        </form>
    </div>
</div>
@endif
    
@endsection

