@extends('layouts/app')

@section('content')
@if (count($subjects) != 0)
<div class="card-panel">
  <h5>Feladatok</h5>
</div>
<ul class="collapsible">
  @foreach ($subjects as $subject)
  <li>
    <div class="collapsible-header">{{$subject->name}}</div>
    <div class="collapsible-body">
      <table>
        <tr>
          <th>Név</th>
          <th>Pont érték</th>
          <th>Határidő tól-ig</th>
          <th>Beadott fájl</th>
        </tr>
        @foreach ($assignments as $assignment)
        @if ($assignment->subject == $subject->id)
        <tr>
          <td><a href="{{route('add-solution', $assignment->id)}}">{{$assignment->name}}</a></td>
          <td>{{$assignment->value}}</td>
          <td>{{$assignment->deadline_from.' - '.$assignment->deadline_to}}</td>
          <td>
            @if(App\Solution::where('assignment', $assignment->id)->where('student', Auth::id())->where('file', '<>', null)->count() > 0)
            <a href="#" onclick="event.preventDefault();
              document.getElementById('download-{{$assignment->id}}').submit();">Letöltés</a>
            <form id="download-{{$assignment->id}}" method="GET" action="{{route('download-solution', App\Solution::where('assignment', $assignment->id)->where('student', Auth::id())->where('file', '<>', null)->first()->id)}}"></form>
            @endif
          </td>
        </tr>
        @endif
        @endforeach
      </table>
    </div>
  </li>  
  @endforeach
</ul>
@else
<div class="card">
  <div class="card-content">
    <span class="card-title">Nincs aktív feladat</span>
  </div>
</div>
@endif
@endsection