@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">Tantárgy meghirdetése</span>
        <form method="POST" action="{{ route('store-subject') }}">
            @csrf

            <div class="input-field">
                <input id="name" type="text" class="@error('name') validate @enderror" name="name"
                    value="{{old('name')}}" required autofocus>
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
                    value="{{old('code')}}" required>
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
                <textarea id="desc" class="materialize-textarea @error('desc') validate @enderror"
                    name="desc">{{old('desc')}}</textarea>
                <label for="desc">Leírás</label>
            </div>

            <div class="input-field">
                <input id="value" type="number" class="@error('value') validate @enderror" name="value"
                    value="{{old('value')}}" required>
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
                    Meghirdetés
                </button>
            </div>
        </form>
    </div>
</div>
@endsection