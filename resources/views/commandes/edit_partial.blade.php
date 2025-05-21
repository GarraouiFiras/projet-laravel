<div class="commande-edit-container">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0">Modifier la commande #{{ $commande->id }}</h3>
        </div>
        
        <div class="card-body">
            <form id="edit-commande-form" action="{{ route('commandes.update', $commande->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informations client</h5>
                        <p><strong>Nom :</strong> {{ $commande->nom_client }}</p>
                        <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="statut"><strong>Statut de la commande</strong></label>
                            <select name="statut" id="statut" class="form-control">
                                @foreach($statuts as $key => $value)
                                    <option value="{{ $key }}" {{ $commande->statut == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
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
                
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info load-content" data-url="{{ route('commandes.show', $commande->id) }}">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .commande-edit-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    .form-control {
        background-color: white;
    }
</style>

<script>
document.getElementById('edit-commande-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Recharger le contenu de la commande
            window.dispatchEvent(new CustomEvent('content-load', {
                detail: { url: "{{ route('commandes.show', $commande->id) }}" }
            ));
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>