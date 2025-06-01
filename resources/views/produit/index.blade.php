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
            font-family: 'Montserrat', sans-serif;
            color: #333;
            background-image: url('assets/img/art.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            margin: 0;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }
        
        .main-content {
            background-color: transparent;
            padding: 40px;
            border-radius: 15px;
            margin: 40px auto;
            max-width: 1400px;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        /* Filtres */
        .filter-container {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .filter-section {
            margin-bottom: 25px;
        }
        
        .filter-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }
        
        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }
        
        .filter-group {
            margin-bottom: 0;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: white;
        }
        
        .filter-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .filter-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            height: 44px;
        }
        
        .reset-btn {
            background-color: rgba(248, 249, 250, 0.8);
            color: var(--secondary-color);
            border: 1px solid rgba(224, 224, 224, 0.5);
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            height: 44px;
        }
        
        /* Grille de produits */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        
        /* Carte de produit */
        .product-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .product-image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }
        
        .product-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        
        .product-details {
            padding: 20px;
            flex-grow: 1;
        }
        
        .product-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }
        
        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 15px;
        }
        
        .product-description {
            color: #666;
            line-height: 1.5;
            font-size: 0.9rem;
        }
        
        .section-title {
            color: black;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }
        
        /* Styles pour le stock */
        .stock-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .in-stock {
            background-color: #e6f7ee;
            color: #28a745;
        }
        
        .low-stock {
            background-color: #fff3e0;
            color: #fd7e14;
        }
        
        .out-of-stock {
            background-color: #fdecea;
            color: #dc3545;
        }
        
        .stock-quantity {
            font-size: 0.8rem;
            color: #6c757d;
            margin-left: 5px;
        }
        
        /* Alignement des boutons */
       .filter-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            grid-column: 1 / -1; /* Prend toute la largeur disponible */
            margin-top: 10px;
        }

        /* Correction spécifique pour les filtres d'accessoires */
        #accessory-filters .filter-form {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        /* Assure que les boutons restent sur la même ligne */
        .filter-btn, .reset-btn {
            white-space: nowrap;
            flex-shrink: 0; /* Empêche le rétrécissement */
        }

        /* Ajustement responsive */
        @media (max-width: 768px) {
            .filter-actions {
                flex-direction: row; /* Garde les boutons côte à côte */
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
@section('content')
<div class="main-content">
    <h1 class="page-title">Nos Produits</h1>

    <!-- Filtres -->
    <div class="filter-container">
        <!-- Filtres Voitures -->
        <div class="filter-section">
            <h3 class="filter-section-title">Filtrer les Voitures</h3>
            <form method="GET" action="{{ route('produit.index') }}" class="filter-form">
                <div class="filter-group">
                    <label for="car_model_id">Modèle</label>
                    <select name="model_id" class="filter-control">
                        <option value="">Tous les modèles</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id }}" {{ request('model_id') == $model->id ? 'selected' : '' }}>
                                {{ $model->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="min_car_price">Prix minimum</label>
                    <input type="number" id="min_car_price" name="min_car_price" class="filter-control" 
                           placeholder="0 TND" value="{{ request('min_car_price') }}">
                </div>
                
                <div class="filter-group">
                    <label for="max_car_price">Prix maximum</label>
                    <input type="number" id="max_car_price" name="max_car_price" class="filter-control" 
                           placeholder="Max TND" value="{{ request('max_car_price') }}">
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i> Appliquer
                    </button>
                    
                    @if(request()->filled('model_id') || request()->filled('min_car_price') || request()->filled('max_car_price'))
                        <a href="{{ route('produit.index') }}" class="reset-btn">
                            <i class="fas fa-sync-alt"></i> Réinitialiser
                        </a>
                    @endif
                </div>
            </form>
        </div>
        
       <!-- Filtres Accessoires -->
    <div class="filter-section" id="accessory-filters">
        <h3 class="filter-section-title">Filtrer les Accessoires</h3>
        <form method="GET" action="{{ route('produit.index') }}" class="filter-form">
            <div class="filter-group">
                <label for="accessory_name">Nom</label>
                <input type="text" id="accessory_nom" name="accessory_nom" class="filter-control" 
                       placeholder="Nom de l'accessoire" value="{{ request('accessory_nom') }}">
            </div>

            <div class="filter-group">
                <label for="min_accessory_price">Prix minimum</label>
                <input type="number" id="min_accessory_price" name="min_accessory_price" class="filter-control" 
                       placeholder="0 TND" value="{{ request('min_accessory_price') }}">
            </div>
            
            <div class="filter-group">
                <label for="max_accessory_price">Prix maximum</label>
                <input type="number" id="max_accessory_price" name="max_accessory_price" class="filter-control" 
                       placeholder="Max TND" value="{{ request('max_accessory_price') }}">
            </div>

            <div class="filter-group">
                <label for="min_stock">Stock minimum</label>
                <input type="number" id="min_stock" name="min_stock" class="filter-control" 
                       placeholder="0" value="{{ request('min_stock') }}">
            </div>
            
            <div class="filter-group">
                <label for="max_stock">Stock maximum</label>
                <input type="number" id="max_stock" name="max_stock" class="filter-control" 
                       placeholder="Max" value="{{ request('max_stock') }}">
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i> Appliquer
                </button>
                
                @if(request()->anyFilled(['accessory_nom', 'min_accessory_price', 'max_accessory_price', 'min_stock', 'max_stock']))
                    <a href="{{ route('produit.index') }}" class="reset-btn">
                        <i class="fas fa-sync-alt"></i> Réinitialiser
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Liste des voitures -->
    <h2 class="section-title">Nos Voitures</h2>
    <div class="products-grid">
        @foreach ($cars as $car)
            <div class="product-card">
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="product-image">
                </div>
                
                <div class="product-details">
                    <h3 class="product-title">{{ $car->name }}</h3>
                    <div class="product-price">{{ number_format($car->price, 0, ',', ' ') }} TND</div>
                    
                    <p class="product-description">
                        {{ Str::limit($car->description, 120) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Liste des accessoires -->
    <h2 class="section-title">Nos Accessoires</h2>
    <div class="products-grid">
        @foreach ($accessoires as $accessoire)
            <div class="product-card">
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->name }}" class="product-image">
                </div>
                
                <div class="product-details">
                    <h3 class="product-title">{{ $accessoire->name }}</h3>
                    <div class="product-price">{{ number_format($accessoire->prix, 0, ',', ' ') }} TND</div>
                    <div class="product-stock">
                        @if($accessoire->stock > 5)
                            <span class="stock-badge in-stock">
                                <i class="fas fa-check"></i> Disponible
                            </span>
                        @elseif($accessoire->stock > 0)
                            <span class="stock-badge low-stock">
                                <i class="fas fa-exclamation"></i> Bientôt épuisé
                            </span>
                        @else
                            <span class="stock-badge out-of-stock">
                                <i class="fas fa-times"></i> Épuisé
                            </span>
                        @endif
                        <span class="stock-quantity">({{ $accessoire->stock }} unités)</span>
                    </div>
                    <p class="product-description">
                        {{ Str::limit($accessoire->description, 100) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!-- Scripts JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au chargement
    const cards = document.querySelectorAll('.product-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease ' + (index * 0.1) + 's';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
});
</script>
</body>
</html>