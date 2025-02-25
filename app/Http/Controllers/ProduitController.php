<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\car; // Ensure the model name is capitalized
use Illuminate\Support\Facades\Storage;
use App\Models\Produit;
use Illuminate\Support\Facades\Log;
use App\Models\CarModel;



class ProduitController extends Controller
{
    public function index()
    {
        $cars = car::all(); // Utilisation correcte du modèle 'car'
        return view('produit.index', compact('cars'));
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

        car::create($validatedData); // Insertion dans la table 'cars'

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

