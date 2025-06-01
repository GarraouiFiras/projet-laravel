<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Accessoire;
use App\Models\CarModel;
use Illuminate\Support\Facades\Log;

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
        
        // Filtrage des accessoires
        $accessoireQuery = Accessoire::query();
        
        // Filtre par prix (utilise le champ 'prix' de la base)
        if ($request->filled('min_accessory_price')) {
            $accessoireQuery->where('prix', '>=', $request->min_accessory_price);
        }
        
        if ($request->filled('max_accessory_price')) {
            $accessoireQuery->where('prix', '<=', $request->max_accessory_price);
        }
        
        // Filtre par nom
        if ($request->filled('accessory_nom')) {
            $accessoireQuery->where('nom', 'like', '%'.$request->accessory_nom.'%');
        }
        
        // Filtre par stock
        if ($request->filled('min_stock')) {
            $accessoireQuery->where('stock', '>=', $request->min_stock);
        }
        
        if ($request->filled('max_stock')) {
            $accessoireQuery->where('stock', '<=', $request->max_stock);
        }
        
        $accessoires = $accessoireQuery->get();
        
        return view('produit.index', compact('cars', 'models', 'accessoires'));
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

        Car::create($validatedData);

        Log::info('Car Data:', $validatedData);

        return redirect()->route('produit.index')->with('success', 'Voiture ajoutée avec succès.');
    }

    public function create()
    {
        $models = CarModel::all();
        return view('welcome', compact('models'));
    }
}