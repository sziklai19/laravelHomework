@extends('layouts.app')

@section('title', $subject->name)

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">{{$subject->name}}</span>
        <table>
            <tr>
                <th>Tárgy neve</th>
                <td>{{$subject->name}}</td>
            </tr>
            <tr>
                <th>Tárgy kódja</th>
                <td>{{$subject->code}}</td>
            </tr>
            <tr>
                <th>Tárgy kredit értéke</th>
                <td>{{$subject->value}}</td>
            </tr>
            <tr>
                <th>Leírás</th>
                <td>{{$subject->desc}}</td>
            </tr>
            <tr>
                <th>Létrehozva</th>
                <td>{{$subject->created_at}}</td>
            </tr>
            <tr>
                <th>Módosítva</th>
                <td>{{$subject->updated_at}}</td>
            </tr>
            <tr>
                <th>Jelentkezett halgatók száma</th>
                <td>{{count($students)}}</td>
            </tr>
            @if (!Auth::user()->teacher)
            <tr>
                <th>Tanár neve:</th>
                <td>{{$teacher->name}}</td>
            </tr>
            <tr>
                <th>Tanár e-mail címe:</th>
                <td>{{$teacher->email}}</td>
            </tr>
            @endif
        </table>
    </div>
    @if (Auth::user()->teacher)
    <div class="card-action">
        <a href="{{route('add-assignment', $subject->id)}}" class="light-blue-text">Új feladat</a>
        <a href="{{route('modify-subject', $subject->id)}}" class="light-blue-text">Módosítás</a>
        <a href="#" class="red-text" onclick="
            event.preventDefault();
            document.getElementById('delete-form').submit();
        ">Törlés</a>
        <form id="delete-form" method="POST" action="{{route('delete-subject', $subject->id)}}">
            @csrf
        </form>
    </div>
    @endif
</div>
    <div class="card">
        <div class="card-content">
            <span class="card-title">Feladatok</span>
            <table>
                <tr>
                    <th>Név</th>
                    <th>Elérhető pontszám</th>
                    <th>Határidő tól</th>
                    <th>Határidő ig</th>
                </tr>
                @foreach ($assignments as $assignment)
                <tr class="{{$assignment->deadline_to == null ? 'green-text' : (strtotime($assignment->deadline_to) < time() ? 'red-text' : (strtotime($assignment->deadline_from) < time() ? 'orange-text' : 'green-text'))}}">
                    <td>
                        <a href="{{route('assignment', ['subject' => $subject->id, 'id' => $assignment->id])}}" class="{{$assignment->deadline_to == null ? 'green-text' : (strtotime($assignment->deadline_to) < time() ? 'red-text' : (strtotime($assignment->deadline_from) < time() ? 'orange-text' : 'green-text'))}}">
                        {{$assignment->name}}</a>
                    </td>
                    <td>{{$assignment->value == null ? '-' : $assignment->value.' pont'}}</td>
                    <td>{{$assignment->deadline_from == null ? '-' : $assignment->deadline_from}}</td>
                    <td>{{$assignment->deadline_to == null ? '-' : $assignment->deadline_to}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
<div class="card">
    <div class="card-content">
        <span class="card-title">Jelentkezett tanulók</span>
        <table>
            <tr>
                <th>Név</th>
                <th>E-mail cím</th>
            </tr>
            @foreach ($students as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection