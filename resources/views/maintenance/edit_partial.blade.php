<div class="card">
    <div class="card-header bg-warning text-white">
        <h3>Modifier le rendez-vous #{{ $maintenance->id }}</h3>
    </div>
    
    <div class="card-body">
        <form id="edit-maintenance-form" action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-control">
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ $maintenance->status == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $maintenance->date->format('Y-m-d') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Heure</label>
                        <input type="time" name="time" class="form-control" value="{{ $maintenance->time }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="appointment_type" class="form-control">
                            @foreach($appointmentTypes as $key => $value)
                                <option value="{{ $key }}" {{ $maintenance->appointment_type == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ $maintenance->description }}</textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('maintenance.show', $maintenance->id) }}" 
                   class="btn btn-secondary load-content" 
                   data-url="{{ route('maintenance.show', $maintenance->id) }}">
                   <i class="fas fa-times"></i> Annuler
                </a>
                
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('edit-maintenance-form').addEventListener('submit', function(e) {
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
            window.dispatchEvent(new CustomEvent('content-load', {
                detail: { url: "{{ route('maintenance.show', $maintenance->id) }}" }
            }));
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>