@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col xl10 offset-xl1 s12">
        <div class="card-panel m10">
            <div>{{__('other.login')}}</div>

            <div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-field">
                        <label for="email">{{__('other.email')}}</label>
                        <input id="email" type="email" class="@error('email') validate @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        <div>
                            @error('email')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-field">
                        <label for="password">{{__('other.password')}}</label>
                        <input id="password" type="password" class="@error('password') validate @enderror"
                            name="password" required autocomplete="current-password">

                        <div>
                            @error('password')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label>
                            <input type="checkbox" class="filled-in" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>{{__('other.remember')}}</span>
                        </label>
                    </div>

                    <div class="section">
                        <button type="submit" class="btn light-blue">
                            {{__('other.login')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection