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
            <!-- Ajout d'un champ de recherche pour les utilisateurs admin/vendeur -->
            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                <div class="mb-4">
                    <input type="text" id="commande-search" class="form-control" placeholder="Rechercher par nom client..." data-url="{{ route('commandes.index') }}">
                </div>
            @endif

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
            @if($commandes->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $commandes->links() }}
                </div>
            @endif
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
</script>