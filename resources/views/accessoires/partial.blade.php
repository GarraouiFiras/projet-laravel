<div class="content-container bg-white p-4 rounded shadow" style="color: black;">
    <h1 class="text-center mb-4">Liste des accessoires</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="filter-container mb-4">
        <form method="GET" action="{{ route('accessoires.index') }}" id="filter-form" class="filter-form" data-dynamic-form>
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" class="form-control" name="nom" value="{{ request('nom') }}">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label fw-bold">Prix min</label>
                    <input type="number" class="form-control" name="prix_min" value="{{ request('prix_min') }}" step="0.01">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label fw-bold">Prix max</label>
                    <input type="number" class="form-control" name="prix_max" value="{{ request('prix_max') }}" step="0.01">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label fw-bold">Stock min</label>
                    <input type="number" class="form-control" name="stock_min" value="{{ request('stock_min') }}">
                </div>
                
                 <div class="filter-buttons">
            <button type="submit" class="btn btn-primary me-2">
                <i class="fas fa-filter"></i> Filtrer
            </button>
            <a href="{{ route('accessoires.index') }}" class="btn btn-secondary load-content" data-url="{{ route('accessoires.index') }}">
                <i class="fas fa-times"></i> Réinitialiser
            </a>
        </div>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th class="fw-bold">Image</th>
                    <th class="fw-bold">Nom</th>
                    <th class="fw-bold">Description</th>
                    <th class="fw-bold">Prix</th>
                    <th class="fw-bold">Stock</th>
                    <th class="fw-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accessoires as $accessoire)
                    <tr>
                        <td>
                            @if($accessoire->image)
                                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" width="80" class="img-thumbnail">
                            @else
                                <span>Pas d'image</span>
                            @endif
                        </td>
                        <td>{{ $accessoire->nom }}</td>
                        <td>{{ Str::limit($accessoire->description, 50) }}</td>
                        <td>{{ number_format($accessoire->prix, 0, '', ' ') }} TND</td>
                        <td>{{ $accessoire->stock }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('accessoires.show', $accessoire->id) }}" class="btn btn-info btn-sm load-content" data-url="{{ route('accessoires.show', $accessoire->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::check() && (Auth::user()->role === 'gestionnaire' || Auth::user()->role === 'admin'))
                                    <a href="{{ route('accessoires.edit', $accessoire->id) }}" class="btn btn-warning btn-sm load-content" data-url="{{ route('accessoires.edit', $accessoire->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('accessoires.destroy', $accessoire->id) }}" method="POST" style="display: inline;" data-dynamic-form>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center mt-4">
            {!! $accessoires->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>