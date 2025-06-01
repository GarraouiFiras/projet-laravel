@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mon Espace Client</h2>
    
    @if($commandes->isNotEmpty())
        <div class="alert alert-info">
            Bonjour <strong>{{ $commandes->first()->nom_client }}</strong>, voici vos activités
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
                                            <span class="badge 
                                                @if($commande->statut == 'en_attente') bg-warning
                                                @elseif($commande->statut == 'annulee') bg-danger
                                                @else bg-success @endif">
                                                {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($commande->total, 2) }} TND</td>
                                        <td>
    <a href="{{ route('commandes.show', $commande->id) }}" 
       class="btn btn-sm btn-info" title="Voir">
       <i class="fas fa-eye"></i>
    </a>
    @if($commande->statut == 'en_attente')
    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    @endif
</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rendezvous as $rdv)
                            <tr>
                                <td>{{ $rdv->date ? \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $rdv->time ? \Carbon\Carbon::parse($rdv->time)->format('H:i') : 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($rdv->status == 'pending') bg-warning
                                        @elseif($rdv->status == 'cancelled') bg-danger
                                        @else bg-success @endif">
                                        {{ ucfirst($rdv->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('maintenance.show', $rdv->id) }}" 
                                       class="btn btn-sm btn-info" title="Voir">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                   @if($rdv->status == 'pending')
 <form action="{{ route('client.rendezvous.destroy', $rdv->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer ce rendez-vous ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
        </button>
    </form>

@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
    </div>
</div>

<!-- Modal pour modifier RDV -->
<div class="modal fade" id="editRdvModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editRdvForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date_rdv" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure</label>
                        <input type="time" name="heure_rdv" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
function supprimerCommande(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
        fetch(`/commandes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.status === 403) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Action non autorisée');
                });
            }
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Une erreur est survenue');
        });
    }
}

// Suppression des rendez-vous
   /* document.querySelectorAll('.delete-rdv-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const rdvId = this.getAttribute('data-id');
            if (confirm('Supprimer ce rendez-vous ?')) {
                fetch(`/rendezvous/${rdvId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) location.reload();
                    else alert(data.message || 'Erreur');
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur réseau');
                });
            }
        });
    });*/




</script>
@endsection
@endsection