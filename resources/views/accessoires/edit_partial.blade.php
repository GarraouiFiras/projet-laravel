<div class="content-container">
    <h1 class="text-center">Modifier l'accessoire</h1>

    <form action="{{ route('accessoires.update', $accessoire->id) }}" method="POST" enctype="multipart/form-data" data-dynamic-form>
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $accessoire->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $accessoire->description) }}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix (TND)</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="{{ old('prix', $accessoire->prix) }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $accessoire->stock) }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($accessoire->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $accessoire->image) }}" width="100" class="img-thumbnail">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            <a href="{{ route('accessoires.show', $accessoire->id) }}" class="btn btn-secondary load-content" data-url="{{ route('accessoires.show', $accessoire->id) }}">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>