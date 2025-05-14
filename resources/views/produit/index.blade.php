<!DOCTYPE html>
<html lang="fr">
<head>
    @extends('layouts.app')
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 0;
            margin: 0;
            background-image: url('assets/img/art.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        
        .main-content {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            padding: 30px;
            border-radius: 15px;
            margin: 30px auto;
            max-width: 1200px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .filter-container {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .filter-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .filter-form select,
        .filter-form input {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            min-width: 150px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .filter-form button {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-form button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .reset-btn {
            padding: 10px 20px;
            background-color: rgba(241, 241, 241, 0.8);
            color: #333;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .reset-btn:hover {
            background-color: #ddd;
            transform: translateY(-2px);
        }
        
        h1 {
            text-align: center;
            margin: 0 0 30px 0;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            font-size: 2.2rem;
        }
        
        .car-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .car-card {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(3px);
        }
        
        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .car-details {
            padding: 20px;
        }
        
        .car-type {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--secondary-color);
        }
        
        .car-price {
            color: var(--accent-color);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .car-description {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .alert {
            background-color: rgba(248, 215, 218, 0.8);
            color: #721c24;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid rgba(245, 198, 203, 0.5);
        }
        
        @media (max-width: 768px) {
            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-form select,
            .filter-form input,
            .filter-form button,
            .reset-btn {
                width: 100%;
            }
            
            .main-content {
                padding: 15px;
                margin: 15px;
            }
        }
    </style>
</head>
<body>
@section('content')
<div class="main-content">
    <h1>Nos Voitures</h1>

    <div class="filter-container">
        <form method="GET" action="{{ route('produit.index') }}" class="filter-form">
            <select name="model_id">
                <option value="">Tous les modèles</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}" {{ request('model_id') == $model->id ? 'selected' : '' }}>
                        {{ $model->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="min_price" placeholder="Prix minimum" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Prix maximum" value="{{ request('max_price') }}">
            
            <button type="submit">Filtrer</button>
            
            @if(request()->hasAny(['model_id', 'min_price', 'max_price']))
                <a href="{{ route('produit.index') }}" class="reset-btn">Réinitialiser</a>
            @endif
        </form>
    </div>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="car-container">
        @foreach ($cars as $car)
            <div class="car-card">
                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="car-image">
                <div class="car-details">
                    <div class="car-type">
                        {{ $car->name }} 
                    </div>
                    <div class="car-price">{{ number_format($car->price, 0, ',', ' ') }} TND</div>
                    <div class="car-description">{{ $car->description }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
</body>
</html>