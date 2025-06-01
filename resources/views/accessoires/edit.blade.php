@extends('layouts.app')

@section('content')
<style>
    /* Background artistique */
    body {
        background-image: url('/assets/img/art.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    /* Conteneur principal */
    .edit-container {
        background-color: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(6px);
        border-radius: 12px;
        padding: 25px;
        margin: 30px auto;
        width: 95%;
        max-width: 600px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Titre */
    .edit-title {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        font-size: 1.5rem;
    }

    /* Formulaire */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    /* Style spécial pour le prix */
    .price-input-container {
        position: relative;
    }

    .price-input {
        padding-left: 40px !important;
    }

    .price-currency {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: bold;
        color: #2c3e50;
    }

    /* Boutons */
    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
    }

    .btn {
        padding: 8px 20px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: #7f8c8d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #6c7a7d;
        transform: translateY(-2px);
    }

    /* Image */
    .image-preview {
        max-width: 180px;
        height: auto;
        border-radius: 6px;
        margin-top: 12px;
        display: block;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Upload */
    .file-upload {
        display: block;
        padding: 10px;
        background-color: rgba(52, 152, 219, 0.1);
        border: 2px dashed #3498db;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .file-upload:hover {
        background-color: rgba(52, 152, 219, 0.2);
    }

    .no-image {
        color: #6c757d;
        font-style: italic;
        font-size: 0.9rem;
    }
</style>

<div class="edit-container">
    <h1 class="edit-title">Modifier l'accessoire</h1>

    <form action="{{ route('accessoires.update', $accessoire->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom de l'accessoire</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $accessoire->nom }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $accessoire->description }}</textarea>
        </div>

        <div class="form-group price-input-container">
            <label for="prix">Prix</label>
            <span class="price-currency">TND</span>
            <input type="number" class="form-control price-input" id="prix" name="prix" step="0.01" min="0" value="{{ $accessoire->prix }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Quantité en stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ $accessoire->stock }}" required>
        </div>

        <div class="form-group">
            <label>Image actuelle</label>
            @if($accessoire->image)
                <img src="{{ asset('storage/' . $accessoire->image) }}" class="image-preview" alt="Image actuelle">
            @else
                <p class="no-image">Aucune image disponible</p>
            @endif
        </div>

        <div class="form-group">
            <label>Changer l'image</label>
            <label for="image" class="file-upload">
                <i class="fas fa-cloud-upload-alt"></i> Sélectionner une nouvelle image
                <input type="file" id="image" name="image" class="d-none" onchange="previewImage(this)">
            </label>
            <img id="new-image-preview" class="image-preview d-none" alt="Nouvelle image">
        </div>

        <div class="btn-group">
            <a href="{{ route('accessoires.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('new-image-preview');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection