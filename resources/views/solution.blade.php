@extends('layouts/app')

@section('content')
    <details class="collapsible">
        <summary class="">Részletek</summary>
        <div class="">{!!nl2br($assignment->desc)!!}</div>
    </details>
    <div class="card">
        <div class="card-content">
            @if($solution->file == null)
            <span class="card-title">Megoldás</span>
            <div>
                {{nl2br($solution->solution)}}
            </div>
            @else
            <a href="#" onclick="event.preventDefault();
              document.getElementById('download-{{$assignment->id}}').submit();">Letöltés</a>
            <form id="download-{{$assignment->id}}" method="GET" action="{{route('download-solution', $solution->id)}}"></form>
            @endif
        </div>
    </div>
    <form class="card" method="POST" action="{{route('rate-solution')}}">
        @csrf
        <input type="hidden" value="{{$assignment->id}}" name="assignmentId">
        <input type="hidden" value="{{$solution->id}}" name="solutionId">
        <div class="card-content">
            <span class="card-title">Értékelés</span>
            <div class="input-field">
                <input id="result" type="number" name="result"
                    value="{{old('result')}}" min="0" max="{{$assignment->value}}">
                <label for="result">Pont érték</label>
                <div>
                    @error('result')
                        <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="input-field">
                <textarea id="comment" class="materialize-textarea" name="comment">{{old('comment')}}</textarea>
                <label for="comment">Textarea</label>
                <div>
                    @error('comment')
                        <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-action">
            <button class="btn light-blue right-align" type="submit">Értékel</button>
        </div>
    </form>
@endsection