<div class="card">
    <div class="card-header bg-success text-white">
        <h3>Nouveau rendez-vous de maintenance</h3>
    </div>
    
    <div class="card-body">
        <form id="create-maintenance-form" action="{{ route('maintenance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Client</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Voiture</label>
                        <select name="car_id" class="form-control" required>
                            <option value="">Sélectionnez votre voiture</option>
                            @foreach(auth()->user()->commandes()
                                ->with(['commandeItems.car'])
                                ->where('statut', 'livrée')
                                ->get() as $commande)
                                @foreach($commande->commandeItems as $item)
                                    @if($item->car)
                                        <option value="{{ $item->car->id }}">
                                            {{ $item->car->name }} ({{ $item->car->model }})
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="appointment_type" class="form-control" required>
                            <option value="">Sélectionnez le type</option>
                            @foreach($appointmentTypes as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Heure</label>
                                <input type="time" name="time" class="form-control" min="08:00" max="18:00" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Décrivez le problème..." required></textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('maintenance.index') }}" 
                   class="btn btn-secondary load-content" 
                   data-url="{{ route('maintenance.index') }}">
                   <i class="fas fa-times"></i> Annuler
                </a>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Confirmer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('create-maintenance-form').addEventListener('submit', function(e) {
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
        if (data.redirect) {
            window.dispatchEvent(new CustomEvent('content-load', {
                detail: { url: data.redirect }
            }));
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>