<?php

namespace App\Http\Controllers;
use App\Models\Maintenance; // Importer le modèle Maintenance
use App\Models\Car; // Importer le modèle Car si nécessaire
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher la liste des rendez-vous
    public function index()
    {
        $maintenances = Maintenance::with('car')->get(); // Récupérer les rendez-vous avec les voitures associées
        return view('maintenance.index', compact('maintenances'));
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
}
