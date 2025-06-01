<div class="card">
    <div class="card-header bg-primary text-white">
        <h3>Rendez-vous #{{ $maintenance->id }}</h3>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Informations client</h5>
                <p><strong>Nom :</strong> {{ $maintenance->user->name ?? 'Ancien client' }}</p>
                <p><strong>Email :</strong> {{ $maintenance->user->email ?? 'Non disponible' }}</p>
                <p><strong>Téléphone :</strong> {{ $maintenance->user->telephone ?? 'Non disponible' }}</p>
            </div>
            
            <div class="col-md-6">
                <h5>Informations véhicule</h5>
                <p><strong>Voiture :</strong> {{ $maintenance->car->name }}</p>
                <p><strong>Modèle :</strong> {{ $maintenance->car->model }}</p>
                <p><strong>Année :</strong> {{ $maintenance->car->year ?? 'Non disponible' }}</p>
            </div>
        </div>
        
        <hr>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <p><strong>Date :</strong> {{ $maintenance->date->format('d/m/Y') }}</p>
                <p><strong>Heure :</strong> {{ $maintenance->time }}</p>
                <p><strong>Type :</strong>
                    <span class="badge badge-{{ $maintenance->appointment_type }}">
                        @switch($maintenance->appointment_type)
                            @case('diagnostic') Diagnostic @break
                            @case('oil_change') Vidange @break
                            @case('electrical') Électrique @break
                            @case('mechanical') Mécanique @break
                            @case('tires') Pneus @break
                            @case('brakes') Freinage @break
                            @default Autre
                        @endswitch
                    </span>
                </p>
            </div>
            
            <div class="col-md-6">
                <p><strong>Statut :</strong>
                    <span class="badge bg-{{ $maintenance->status == 'completed' ? 'success' : ($maintenance->status == 'pending' ? 'warning' : ($maintenance->status == 'canceled' ? 'danger' : 'info')) }}">
                        {{ $statuses[$maintenance->status] ?? $maintenance->status }}
                    </span>
                </p>
                <p><strong>Créé le :</strong> {{ $maintenance->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        
        <div class="mt-3">
            <h5>Description</h5>
            <div class="p-3 bg-light rounded">
                {{ $maintenance->description ?? 'Aucune description fournie' }}
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('maintenance.index') }}" 
               class="btn btn-secondary load-content" 
               data-url="{{ route('maintenance.index') }}">
               <i class="fas fa-arrow-left"></i> Retour
            </a>
            
            @can('update', $maintenance)
                <a href="{{ route('maintenance.edit', $maintenance->id) }}" 
                   class="btn btn-warning load-content" 
                   data-url="{{ route('maintenance.edit', $maintenance->id) }}">
                   <i class="fas fa-edit"></i> Modifier
                </a>
            @endcan
        </div>
    </div>
</div>