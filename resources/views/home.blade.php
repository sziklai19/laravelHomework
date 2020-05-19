@extends('layouts.app')

@section('title', 'Főoldal')

@section('content')
<div class="card">
    <div class="card-content">
        <h2>Eddig regisztált adatok:</h2>
        <div class="divider"></div>
        <h5>Tanárok száma: <span>{{App\User::where('teacher', true)->count()}}</span></h5>
        <div class="divider"></div>
        <h5>Diákok száma: <span>{{App\User::where('teacher', false)->count()}}</span></h5>
        <div class="divider"></div>
        <h5>Feladatok száma: 0</h5>
        <div class="divider"></div>
        <h5>Megoldások száma: 0</h5>
        <div class="divider"></div>
    </div>
</div>
@endsection