@extends('layouts.app')

@section('title', 'Új feladat')

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">Új feladat</span>
        <form method="POST" action="{{ route('store-assignment', $subject) }}">
            @csrf

            <div class="input-field">
                <input id="name" type="text" name="name"
                    value="{{old('name')}}" required autofocus>
                <label for="name">Név</label>
                <div>
                    @error('name')
                    <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <textarea id="desc" class="materialize-textarea"
                    name="desc" required>{{old('desc')}}</textarea>
                <label for="desc">Leírás</label>
                <div>
                    @error('desc')
                        <span class="red-text"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <input id="value" type="number" name="value"
                    value="{{old('value')}}">
                <label for="value">Pont érték</label>
                <div>
                    @error('value')
                    <span class="red-text">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <input type="datetime-local" name="deadline_from" value="{{old('deadline_from')}}">
                <label for="deadline_from" class="active">Határidő tól</label>
                <div>
                    @error('deadline_from')
                    <span class="red-text">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <input type="datetime-local" name="deadline_to" value="{{old('deadline_to')}}">
                <label for="deadline_from" class="active">Határidő ig</label>
                <div>
                    @error('deadline_to')
                    <span class="red-text">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="section">
                <button type="submit" class="btn light-blue">
                    Létrehoz
                </button>
            </div>
        </form>
    </div>
</div>
@endsection