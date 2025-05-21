<div class="content-container">
    <h1 class="text-center">Détails de l'accessoire</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($accessoire->image)
                        <img src="{{ asset('storage/' . $accessoire->image) }}" class="img-fluid">
                    @else
                        <p>Pas d'image disponible</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3>{{ $accessoire->nom }}</h3>
                    <p><strong>Description:</strong> {{ $accessoire->description }}</p>
                    <p><strong>Prix:</strong> {{ number_format($accessoire->prix, 0, '', ' ') }} TND</p>
                    <p><strong>Stock:</strong> {{ $accessoire->stock }}</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('accessoires.edit', $accessoire->id) }}" class="btn btn-warning btn-edit">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('accessoires.index') }}" class="btn btn-secondary load-content" data-url="{{ route('accessoires.index') }}">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>