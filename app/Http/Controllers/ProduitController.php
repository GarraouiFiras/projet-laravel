<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\car; 
use Illuminate\Support\Facades\Storage;
use App\Models\Produit;
use Illuminate\Support\Facades\Log;
use App\Models\CarModel;



class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $models = CarModel::all(); // Pour alimenter la liste déroulante
    
        $query = Car::with('model'); // On charge la relation avec le modèle
    
        // Filtrage par modèle (ID du modèle)
        if ($request->filled('model_id')) {
            $query->where('model', $request->model_id);
        }
    
        // Filtrage par prix minimum
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
    
        // Filtrage par prix maximum
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        $cars = $query->get();
    
        return view('produit.index', compact('cars', 'models'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        car::create($validatedData); // Insertion dans la table 'car'

        Log::info('Car Data:', $validatedData);

        return redirect()->route('produit.index')->with('success', 'Voiture ajoutée avec succès.');
    }
    public function create()
{
    // Récupérer tous les modèles depuis la base de données
    $models = CarModel::all(); // Utiliser CarModel

    // Passer les modèles à la vue
    return view('welcome', compact('models'));
}
}

