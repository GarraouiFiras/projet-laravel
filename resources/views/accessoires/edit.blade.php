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
        padding: 30px;
        margin: 40px auto;
        width: 95%;
        max-width: 700px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Titre */
    .edit-title {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Formulaire */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2c3e50;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    /* Boutons */
    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn {
        padding: 10px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        margin-top: 15px;
        display: block;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    /* Upload */
    .file-upload {
        display: block;
        padding: 12px;
        background-color: rgba(52, 152, 219, 0.1);
        border: 2px dashed #3498db;
        border-radius: 6px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 15px;
    }

    .file-upload:hover {
        background-color: rgba(52, 152, 219, 0.2);
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
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $accessoire->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="prix">Prix (€)</label>
            <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" value="{{ $accessoire->prix }}" required>
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
                <p>Aucune image disponible</p>
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