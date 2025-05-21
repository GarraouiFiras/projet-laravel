<div class="commande-details-container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Détails de la commande #{{ $commande->id }}</h3>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informations client</h5>
                    <p><strong>Nom :</strong> {{ $commande->nom_client }}</p>
                    @if($commande->user)
                        <p><strong>Email :</strong> {{ $commande->user->email }}</p>
                    @endif
                    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    <p>
                        <strong>Statut :</strong>
                        <span class="badge" style="background-color: {{ $statutColors[$commande->statut] ?? '#6c757d' }}; color: white;">
                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                        </span>
                    </p>
                </div>
                
                <div class="col-md-6">
                    <h5>Total</h5>
                    <p class="display-4">{{ number_format($commande->total, 2, ',', ' ') }} TND</p>
                </div>
            </div>
            
            <hr>
            
            <h5 class="mt-4">Articles commandés</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande->commandeItems as $item)
                        <tr>
                            <td>{{ $item->type_produit == 'car' ? 'Voiture' : 'Accessoire' }}</td>
                            <td>
                                @if($item->type_produit == 'car')
                                    {{ $item->car->name ?? 'Produit supprimé' }}
                                @else
                                    {{ $item->accessoire->nom ?? 'Produit supprimé' }}
                                @endif
                            </td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ number_format($item->prix_unitaire, 2, ',', ' ') }} TND</td>
                            <td>{{ number_format($item->prix_unitaire * $item->quantite, 2, ',', ' ') }} TND</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary load-content" data-url="{{ route('commandes.index') }}">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
                
                @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'vendeur']))
                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning load-content" data-url="{{ route('commandes.edit', $commande->id) }}">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .commande-details-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    .table th {
        background-color: #f8f9fa;
    }
</style>
