<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessoire;
use Illuminate\Support\Facades\Storage;


class AccessoireController extends Controller
{
    // Afficher la liste des accessoires
    public function index()
    {
        $accessoires = Accessoire::all();
        return view('accessoires.index', compact('accessoires'));
    }

    // Afficher le formulaire de création d'un accessoire
    public function create()
    {
        return view('accessoires.create');
    }

    // Enregistrer un nouvel accessoire
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
        ]);

        // Enregistrer l'image si elle est téléchargée
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accessoires', 'public');
        } else {
            $imagePath = null;
        }

        Accessoire::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('accessoires.index')->with('success', 'Accessoire ajouté avec succès.');
    }

    // Afficher les détails d'un accessoire
    public function show(Accessoire $accessoire)
    {
        return view('accessoires.show', compact('accessoire'));
    }

    // Afficher le formulaire de modification d'un accessoire
    public function edit(Accessoire $accessoire)
    {
        return view('accessoires.edit', compact('accessoire'));
    }

    // Mettre à jour un accessoire
    public function update(Request $request, Accessoire $accessoire)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
        ]);

        // Mettre à jour l'image si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($accessoire->image) {
                Storage::disk('public')->delete($accessoire->image);
            }
            $imagePath = $request->file('image')->store('accessoires', 'public');
        } else {
            $imagePath = $accessoire->image;
        }

        $accessoire->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('accessoires.index')->with('success', 'Accessoire mis à jour avec succès.');
    }

    // Supprimer un accessoire
    public function destroy(Accessoire $accessoire)
    {
        // Supprimer l'image si elle existe
        if ($accessoire->image) {
            Storage::disk('public')->delete($accessoire->image);
        }
        $accessoire->delete();
        return redirect()->route('accessoires.index')->with('success', 'Accessoire supprimé avec succès.');
    }
}
