<?php

namespace App\Http\Controllers;
use App\Models\Maintenance; 
use App\Models\car; 
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher la liste des rendez-vous
  public function index(Request $request)
{
     $query = Maintenance::with(['car', 'user']);
    
    if ($request->has('appointment_type') && $request->appointment_type) {
            $query->where('appointment_type', $request->appointment_type);
        }
        
    // Filtre par nom de client
    if ($request->has('client')) {
        $query->where('client_name', 'like', '%'.$request->client.'%');
    }
    
    // Filtre par voiture
    if ($request->has('car_id') && $request->car_id) {
        $query->where('car_id', $request->car_id);
    }
    
    // Filtre par date
    if ($request->has('date') && $request->date) {
        $query->whereDate('date', $request->date);
    }
    
    if ($request->has('status') && $request->status) {
        $query->where('status', $request->status);
    }
    
    $maintenances = $query->paginate(10);
    $cars = Car::all();

    $statuses = [
        'pending' => 'En attente', 
        'confirmed' => 'Confirmé', 
        'completed' => 'Terminé', 
        'canceled' => 'Annulé'
    ];

    // Retour différent pour les requêtes AJAX
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'content' => view('maintenance.partial', [
                'maintenances' => $maintenances,
                'cars' => $cars,
                'statuses' => $statuses,
                'is_ajax' => true
            ])->render()
        ]);
    }

    return view('maintenance.index', [
        'maintenances' => $maintenances,
        'cars' => $cars,
        'statuses' => $statuses
    ]);
}

    // Afficher le formulaire de création d'un rendez-vous
    public function create()
    {
        $cars = Car::all(); // Récupérer toutes les voitures
        return view('maintenance.create', compact('cars'));
        if ($request->ajax())
    {
    return response()->json([
        'html' => view('maintenance.create_partial', [
            'cars' => $cars,
            'appointmentTypes' => $this->getAppointmentTypes()
        ])->render()
    ]);
    }
    }

    // Enregistrer un nouveau rendez-vous
  public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'car_id' => 'required|exists:car,id',
        'appointment_type' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
        'description' => 'nullable|string',
    ]);

    $maintenance = new Maintenance();
    $maintenance->user_id = $request->user_id;
    $maintenance->car_id = $request->car_id;
    $maintenance->appointment_type = $request->appointment_type;
    $maintenance->date = $request->date;
    $maintenance->time = $request->time;
    $maintenance->description = $request->description;
    $maintenance->save();

    return redirect()->route('clients.dashboard')
           ->with('success', 'Rendez-vous enregistré avec succès.');
}

private function getAppointmentTypes()
{
    return [
        'diagnostic' => 'Diagnostic',
        'oil_change' => 'Vidange',
        'electrical' => 'Problème électrique',
        'mechanical' => 'Problème mécanique',
        'tires' => 'Pneus/Alignement',
        'brakes' => 'Freinage',
        'other' => 'Autre',
    ];
}

    // Afficher les détails d'un rendez-vous
    public function show(Request $request, Maintenance $maintenance)
{
    $maintenance->load(['car', 'user']);
    $statuses = [
        'pending' => 'En attente',
        'confirmed' => 'Confirmé',
        'completed' => 'Terminé',
        'canceled' => 'Annulé'
    ];

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'content' => view('maintenance.show_partial', [
                'maintenance' => $maintenance,
                'statuses' => $statuses
            ])->render()
        ]);
    }

    return view('maintenance.show', compact('maintenance', 'statuses'));
}

    // Supprimer un rendez-vous
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenance.index')->with('success', 'Rendez-vous supprimé avec succès.');
    } 

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'appointment_type' => 'required|in:diagnostic,oil_change,electrical,mechanical,tires,brakes,other',
            'status' => 'required|in:pending,confirmed,completed,canceled',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required',
        ]);

        $maintenance->update($validated);

        return redirect()->route('maintenance.index')
            ->with('success', 'Rendez-vous mis à jour avec succès');
    }


   public function edit(Request $request, Maintenance $maintenance)
{
    $statuses = [
        'pending' => 'En attente',
        'confirmed' => 'Confirmé',
        'completed' => 'Terminé',
        'canceled' => 'Annulé'
    ];
    $appointmentTypes = $this->getAppointmentTypes();

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'content' => view('maintenance.edit_partial', [
                'maintenance' => $maintenance,
                'statuses' => $statuses,
                'appointmentTypes' => $appointmentTypes
            ])->render()
        ]);
    }

    return view('maintenance.edit', compact('maintenance', 'statuses', 'appointmentTypes'));
}

    public function updateStatus(Request $request, Maintenance $maintenance)
    {
    $validStatuses = ['pending', 'confirmed', 'completed', 'canceled'];
    
    if (!in_array($request->status, $validStatuses)) {
        return back()->with('error', 'Statut invalide');
    }
    
    $maintenance->update(['status' => $request->status]);
    
    return back()->with('success', 'Statut mis à jour avec succès');
    }
}
