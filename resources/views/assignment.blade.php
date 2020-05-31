@extends('layouts/app')

@section('title', $assignment->name)

@section('content')
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
            @if (Auth::user()->teacher)
            <tr>
                <th>Beadott:</th><td></td>
            </tr>
            <tr>
                <th>Értékelt:</th><td></td>
            </tr>
            @endif
        </table>
    </div>
    @if (Auth::user()->teacher)    
    <div class="card-action">
        <a href="{{route('modify-assignment', ['subject' => $subject, 'id' => $assignment->id])}}" class="light-blue-text">Módosítás</a>
    </div>
    @endif
</div>
@if (Auth::user()->teacher)
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
        <span class="card-title">Beadott megoldások</span>
        <table>
            <tr>
                <th>Beadás dátuma</th>
                <th>Kapott pontszám</th>
                <th>Értékelés időpontja</th>
            </tr>
            @foreach ($solutions as $solution)
                <tr style="{{$solution->rated_at != null ? 'border-left: 5px solid green;' : 'border-left: 5px solid transparent;'}}">
                    <td>{{$solution->created_at}}</td>
                    <td>{{$solution->result}}</td>
                    <td>{{$solution->rated_at}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endif
    
@endsection

