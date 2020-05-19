@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col xl10 offset-xl1 s12">
        <div class="card-panel m10">
            <div>{{ __('other.register') }}</div>

            <div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf



                    <div class="input-field">
                        <input id="name" type="text" class="@error('name') invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <label for="name">{{ __('other.name') }}</label>

                        <div>
                            @error('name')
                            <strong class="red-text">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="input-field">
                        <input id="email" type="email" class="@error('email') invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                        <label for="email">{{ __('other.email') }}</label>

                        <div>
                            @error('email')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-field">
                        <input id="password" type="password" class="@error('password') invalid @enderror"
                            name="password" required autocomplete="new-password">
                        <label for="password">{{ __('other.password') }}</label>

                        <div>
                            @error('password')
                            <span class="red-text">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-field">
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password">
                        <label for="password-confirm">{{ __('other.Confirm Password') }}</label>
                    </div>

                    <div class="row grey-text invalid">
                        <div class="col">Miként regfisztál?</div>
                        <label class="col">
                            <input name="teacher" type="radio" value="1" />
                            <span>Tanár</span>
                        </label>
                        <label class="col">
                            <input name="teacher" type="radio" value="0" />
                            <span>Diák</span>
                        </label>
                    </div>
                    <div>
                        <span>
                        @error('teacher')
                        <strong class="red-text">{{$message}}</strong>
                        @enderror
                        </span>
                    </div>


                    <div class="section">
                        <button type="submit" class="btn light-blue">
                            {{ __('other.register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection