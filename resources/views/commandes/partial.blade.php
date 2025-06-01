<div class="content-container">
    <h1 class="text-center">
        @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
            Toutes les commandes
        @else
            Vos commandes
        @endif
    </h1>

    @if($commandes->isEmpty())
        <div class="alert alert-info text-center">
            @if(Auth::check())
                Aucune commande trouvée
            @else
                Vous n'avez pas encore passé de commande.
                <a href="{{ route('commandes.create') }}" class="btn btn-primary mt-2 load-content" data-url="{{ route('commandes.create') }}">Passer une commande</a>
            @endif
        </div>
    @else
        <div class="table-container">
            <!-- Filtres améliorés -->
            <div class="card filter-card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('commandes.index') }}" id="filter-form">
                        <div class="row align-items-end">
                            <!-- Champ de recherche -->
                            <div class="col-md-3 mb-2">
                                <label for="search" class="form-label small text-muted">Recherche</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Nom client, ID..." value="{{ request('search') }}">
                            </div>
                            
                            <!-- Filtre par statut -->
                            <div class="col-md-2 mb-2">
                                <label for="statut" class="form-label small text-muted">Statut</label>
                                <select name="statut" id="statut" class="form-select">
                                    <option value="">Tous</option>
                                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_traitement" {{ request('statut') == 'en_traitement' ? 'selected' : '' }}>En traitement</option>
                                    <option value="expediee" {{ request('statut') == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="livree" {{ request('statut') == 'livree' ? 'selected' : '' }}>Livrée</option>
                                    <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>
                            
                            <!-- Filtre par date -->
                            <div class="col-md-3 mb-2">
                                <label for="date_debut" class="form-label small text-muted">Date de début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" 
                                       value="{{ request('date_debut') }}">
                            </div>
                            
                            <div class="col-md-3 mb-2">
                                <label for="date_fin" class="form-label small text-muted">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" 
                                       value="{{ request('date_fin') }}">
                            </div>
                            
                            <!-- Boutons d'action -->
                            <div class="col-md-1 mb-2 d-flex">
                                <button type="submit" class="btn btn-primary me-2 flex-grow-1">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <a href="{{ route('commandes.index') }}" class="btn btn-secondary flex-grow-1">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                            <th>Client</th>
                        @endif
                        <th>Articles</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            
                            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                <td>{{ $commande->nom_client }}</td>
                            @endif
                            
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($commande->commandeItems as $item)
                                        <li>
                                            @if($item->type_produit == 'car')
                                                🚗 {{ optional($item->car)->name ?? 'Voiture non disponible' }}
                                            @else
                                                🛠️ {{ optional($item->accessoire)->nom ?? 'Accessoire non disponible' }} 
                                                <span class="badge bg-secondary">x{{ $item->quantite }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            
                            <td>{{ number_format($commande->total, 0, '', ' ') }} TND</td>
                            
                            <td>
                                <span class="badge" style="background-color: {{ $statutColors[$commande->statut] }}; color: white; padding: 5px 10px; border-radius: 10px;">
                                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                </span>
                            </td>
                            
                            <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                            
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('commandes.show', $commande->id) }}" 
                                       class="btn btn-info btn-sm load-content" data-url="{{ route('commandes.show', $commande->id) }}">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                        <a href="{{ route('commandes.edit', $commande->id) }}" 
                                           class="btn btn-warning btn-sm load-content" data-url="{{ route('commandes.edit', $commande->id) }}">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Supprimer cette commande ?')">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                @if($commandes->hasPages())
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{-- Previous Page --}}
                        <li class="page-item {{ $commandes->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $commandes->previousPageUrl() }}" aria-label="Previous">
                                <span>Previous</span>
                            </a>
                        </li>
                        
                        {{-- Next Page --}}
                        <li class="page-item {{ !$commandes->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $commandes->nextPageUrl() }}" aria-label="Next">
                                <span>Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    @endif
</div>

<script>
    // Réinitialise les écouteurs après le chargement dynamique
    document.querySelectorAll('.load-content').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            window.dispatchEvent(new CustomEvent('content-load', { detail: { url } }));
        });
    });

    // Animation des nouvelles cartes
    setTimeout(() => {
        document.querySelectorAll('.card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    }, 50);

    // Gestion dynamique des filtres
    document.getElementById('filter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const params = new URLSearchParams(formData).toString();
        window.location.href = `${this.action}?${params}`;
    });
</script>