<?php

namespace App\Http\Controllers;
use App\Models\Maintenance; // Importer le modèle Maintenance
use App\Models\Car; // Importer le modèle Car si nécessaire
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher la liste des rendez-vous
   public function index(Request $request)
{
    $query = Maintenance::with('car');
    
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
    $cars = Car::all(); // Pour la liste déroulante des voitures
    
       return view('maintenance.index', [
        'maintenances' => $maintenances,
        'cars' => $cars,
        'statuses' => ['pending' => 'En attente', 'confirmed' => 'Confirmé', 'completed' => 'Terminé', 'canceled' => 'Annulé']
    ]);
}

    // Afficher le formulaire de création d'un rendez-vous
    public function create()
    {
        $cars = Car::all(); // Récupérer toutes les voitures
        return view('maintenance.create', compact('cars'));
    }

    // Enregistrer un nouveau rendez-vous
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'car_id' => 'required|exists:car,id',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable|string',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Rendez-vous enregistré avec succès.');
    }

    // Afficher les détails d'un rendez-vous
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', compact('maintenance'));
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
        'status' => 'required|in:pending,confirmed,completed,canceled',
        'date' => 'required|date',
        'time' => 'required',
        'description' => 'nullable|string',
    ]);

    $maintenance->update($validated);

    return redirect()->route('maintenance.index')
        ->with('success', 'Rendez-vous mis à jour avec succès');
    }


    public function edit(Maintenance $maintenance)
    {
    return view('maintenance.edit', [
        'maintenance' => $maintenance,
        'statuses' => ['pending' => 'En attente', 'confirmed' => 'Confirmé', 'completed' => 'Terminé', 'canceled' => 'Annulé']
    ]);
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
