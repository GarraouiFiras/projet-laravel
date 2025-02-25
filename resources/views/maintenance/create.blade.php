@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Créer un rendez-vous de maintenance</h1>

    <form action="{{ route('maintenance.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="client_name">Nom complet du client</label>
        <input type="text" name="client_name" id="client_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="car_id">Voiture</label>
        <select name="car_id" id="car_id" class="form-control" required>
            <option value="">Sélectionnez une voiture</option>
            @foreach($cars as $car)
                <option value="{{ $car->id }}">{{ $car->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="time">Heure</label>
        <input type="time" name="time" id="time" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn {
        margin-right: 10px;
    }
</style>
@endsection