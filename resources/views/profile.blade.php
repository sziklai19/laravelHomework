@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">Profil</span>
        <table class="striped">
            <tr>
                <th>Név:</th>
                <td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <th>E-mail:</th>
                <td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <th>Típus</th>
                <td>
                    @if (Auth::user()->teacher)
                    Tanár
                    @else
                    Tanuló
                    @endif
                </td>
                <br>
        </table>
    </div>
</div>
@endsection