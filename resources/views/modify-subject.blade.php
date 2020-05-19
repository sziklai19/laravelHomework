@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">Tantárgy módosítása</span>
        <form method="POST" action="{{ route('update-subject', $subject->id) }}">
            @csrf

            <div class="input-field">
                <input id="name" type="text" class="@error('name') validate @enderror" name="name"
                    value="{{$subject->name}}" required autofocus>
                <label for="name">Név</label>

                <div>
                    @error('name')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <input id="code" type="text" class="@error('code') validate @enderror" name="code"
                    value="{{$subject->code}}" required>
                <label for="code">Kód</label>

                <div>
                    @error('code')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="input-field">
                <textarea id="desc" class="materialize-textarea @error('desc') validate @enderror" name="desc">{{$subject->desc}}</textarea>
                <label for="desc">Leírás</label>
            </div>

            <div class="input-field">
                <input id="value" type="number" class="@error('value') validate @enderror" name="value"
                    value="{{$subject->value}}" required>
                <label for="value">Kredit érték</label>
                <div>
                    @error('value')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="section">
                <button type="submit" class="btn light-blue">
                    Módosítás
                </button>
            </div>
        </form>
    </div>
</div>
@endsection