
    
<div class="container">
    <h2 class="mb-4">Mon Espace Client</h2>
    
    @if($commandes->isNotEmpty())
        <div class="alert alert-info">
            Bonjour <strong>{{ $user->name }}</strong>, voici vos activités
        </div>
    @endif

    <div class="row">
        <!-- Commandes -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Mes Commandes</h5>
                </div>
                <div class="card-body">
                    @if($commandes->isEmpty())
                        <p>Aucune commande trouvée</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commandes as $commande)
                                    <tr>
                                        <td>{{ $commande->id }}</td>
                                        <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $statutColors[$commande->statut] ?? '#6c757d' }};">
                                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($commande->total, 2) }} TND</td>
                                        <td>
                                            <a href="{{ route('commandes.show', $commande->id) }}" 
                                               class="btn btn-sm btn-info load-content"
                                               data-url="{{ route('commandes.show', $commande->id) }}">
                                               <i class="fas fa-eye"></i>
                                            </a>
                                            @if(in_array($commande->statut, ['en_attente', 'pending']))
                                            <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Supprimer cette commande ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $commandes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rendez-vous -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5>Mes Rendez-vous</h5>
                </div>
                <div class="card-body">
                    @if($rendezvous->isEmpty())
                        <p>Aucun rendez-vous programmé</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Véhicule</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rendezvous as $rdv)
                                    <tr>
                                        <td>{{ $rdv->date->format('d/m/Y') }}</td>
                                        <td>{{ $rdv->heure }}</td>
                                        <td>{{ $rdv->car->name ?? 'Véhicule non spécifié' }}</td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $statutColors[$rdv->statut] ?? '#6c757d' }};">
                                                {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('client.rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Supprimer ce rendez-vous ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $rendezvous->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
</script>