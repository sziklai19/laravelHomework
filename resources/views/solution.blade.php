@extends('layouts/app')

@section('content')
    <details class="collapsible">
        <summary class="">Részletek</summary>
        <div class="">{!!nl2br($assignment->desc)!!}</div>
    </details>
    <div class="card">
        <div class="card-content">
            <span class="card-title">Megoldás</span>
            <div>
                {{nl2br($solution->solution)}}
            </div>
            <form class="row">
                <div class="input-field col s4 m2 l2 xl2">
                    <input id="value" type="number" name="value"
                        value="{{old('value')}}">
                    <label for="value">Pont érték</label>
                    <button class="btn light-blue" type="submit">Értékel</button>
                </div>
            </form>
        </div>
    </div>
@endsection