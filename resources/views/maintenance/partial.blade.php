<style>
    .badge-diagnostic { background-color: #6f42c1; color: white; }
.badge-oil_change { background-color: #fd7e14; color: white; }
.badge-electrical { background-color: #20c997; color: white; }
.badge-mechanical { background-color: #17a2b8; color: white; }
.badge-tires { background-color: #ffc107; color: #212529; }
.badge-brakes { background-color: #dc3545; color: white; }
.badge-other { background-color: #6c757d; color: white; }
</style>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Client</th>
            <th>Voiture</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Type</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($maintenances as $maintenance)
        <tr>
            <td>{{ $maintenance->user->name ?? 'Ancien client' }}</td>
            <td>{{ $maintenance->car->name }}</td>
            <td>{{ $maintenance->date }}</td>
            <td>{{ $maintenance->time }}</td>
            <td>
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
            </td>
            <td>
                <span class="badge bg-{{ $maintenance->status == 'completed' ? 'success' : ($maintenance->status == 'pending' ? 'warning' : ($maintenance->status == 'canceled' ? 'danger' : 'info')) }}">
                    {{ $statuses[$maintenance->status] ?? $maintenance->status }}
                </span>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('maintenance.show', $maintenance->id) }}" 
                       class="btn btn-info btn-sm load-content"
                       data-url="{{ route('maintenance.show', $maintenance->id) }}">
                       <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('maintenance.edit', $maintenance->id) }}" 
                       class="btn btn-warning btn-sm load-content"
                       data-url="{{ route('maintenance.edit', $maintenance->id) }}">
                       <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Supprimer ce rendez-vous ?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Aucun rendez-vous trouvé</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($maintenances->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $maintenances->appends(request()->query())->links() }}
    </div>
@endif