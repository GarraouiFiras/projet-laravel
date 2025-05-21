<div class="commande-create-container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Nouvelle commande</h3>
        </div>
        
        <div class="card-body">
            <form id="create-commande-form" action="{{ route('commandes.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom_client">Nom du client</label>
                            <input type="text" class="form-control" id="nom_client" name="nom_client" required>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Sélectionnez une voiture</h5>
                        <div class="form-group">
                            <select class="form-control" id="car_id" name="car_id" required>
                                <option value="">-- Choisir une voiture --</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" data-price="{{ $car->price }}">
                                        {{ $car->name }} - {{ number_format($car->price, 2, ',', ' ') }} TND
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Accessoires</h5>
                        <div id="accessoires-container">
                            @foreach($accessoires as $accessoire)
                                <div class="form-group row align-items-center mb-2">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input accessoire-check" 
                                                   type="checkbox" 
                                                   id="accessoire_{{ $accessoire->id }}" 
                                                   name="accessoires[{{ $loop->index }}][id]" 
                                                   value="{{ $accessoire->id }}">
                                            <label class="form-check-label" for="accessoire_{{ $accessoire->id }}">
                                                {{ $accessoire->nom }} ({{ number_format($accessoire->prix, 2, ',', ' ') }} TND)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control accessoire-qte" 
                                               name="accessoires[{{ $loop->index }}][quantite]" 
                                               min="0" 
                                               value="0" 
                                               disabled>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <h4>Total: <span id="total-commande">0.00</span> TND</h4>
                    </div>
                </div>
                
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('commandes.index') }}" class="btn btn-secondary load-content" data-url="{{ route('commandes.index') }}">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Valider la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .commande-create-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    #accessoires-container {
        max-height: 300px;
        overflow-y: auto;
    }
    
    #total-commande {
        color: #28a745;
        font-weight: bold;
    }
</style>

<script>
// Gestion des accessoires
document.querySelectorAll('.accessoire-check').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const qteInput = this.closest('.row').querySelector('.accessoire-qte');
        qteInput.disabled = !this.checked;
        if (!this.checked) qteInput.value = 0;
        calculateTotal();
    });
});

document.querySelectorAll('.accessoire-qte').forEach(input => {
    input.addEventListener('input', calculateTotal);
});

document.getElementById('car_id').addEventListener('change', calculateTotal);

function calculateTotal() {
    let total = 0;
    
    // Prix de la voiture
    const carSelect = document.getElementById('car_id');
    if (carSelect.value) {
        const selectedOption = carSelect.options[carSelect.selectedIndex];
        total += parseFloat(selectedOption.dataset.price);
    }
    
    // Prix des accessoires
    document.querySelectorAll('.accessoire-check:checked').forEach(checkbox => {
        const qteInput = checkbox.closest('.row').querySelector('.accessoire-qte');
        const accessoireId = checkbox.value;
        const qte = parseInt(qteInput.value) || 0;
        const prix = parseFloat(checkbox.parentElement.textContent.match(/\(([0-9.,]+) TND\)/)[1].replace(',', '.'));
        
        total += prix * qte;
    });
    
    document.getElementById('total-commande').textContent = total.toFixed(2).replace('.', ',');
}

// Gestion du formulaire
document.getElementById('create-commande-form').addEventListener('submit', function(e) {
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