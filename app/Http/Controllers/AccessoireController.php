<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessoire;
use Illuminate\Support\Facades\Storage;

class AccessoireController extends Controller
{
    // Afficher la liste des accessoires
    public function index(Request $request)
    {
        $query = Accessoire::query();

        // Filtre par nom
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%'.$request->nom.'%');
        }

        // Filtre par prix minimum
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }

        // Filtre par prix maximum
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        // Filtre par stock minimum
        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', $request->stock_min);
        }

        // Tri des colonnes
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        } else {
            $query->orderBy('nom'); // Tri par défaut
        }

        $accessoires = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('accessoires.partial', compact('accessoires'))->render()
            ]);
        }

        return view('accessoires.index', compact('accessoires'));
    }

    // Afficher le formulaire de création d'un accessoire
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('accessoires.create_partial')->render()
            ]);
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accessoires', 'public');
        }

        $accessoire = Accessoire::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('accessoires.show', $accessoire->id),
                'message' => 'Accessoire ajouté avec succès.',
                'is_ajax' => true
            ]);
        }

        return redirect()->route('accessoires.show', $accessoire->id)
                        ->with('success', 'Accessoire ajouté avec succès.');
    }

    // Afficher les détails d'un accessoire
    public function show(Request $request, Accessoire $accessoire)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('accessoires.show_partial', compact('accessoire'))->render()
            ]);
        }

        return view('accessoires.show', compact('accessoire'));
    }

    // Afficher le formulaire de modification d'un accessoire
    public function edit(Request $request, Accessoire $accessoire)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('accessoires.edit_partial', compact('accessoire'))->render()
            ]);
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $accessoire->image;
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($accessoire->image) {
                Storage::disk('public')->delete($accessoire->image);
            }
            $imagePath = $request->file('image')->store('accessoires', 'public');
        }

        $accessoire->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('accessoires.show', $accessoire->id),
                'message' => 'Accessoire mis à jour avec succès.'
            ]);
        }

        return redirect()->route('accessoires.show', $accessoire->id)
                        ->with('success', 'Accessoire mis à jour avec succès.');
    }

    // Supprimer un accessoire
    public function destroy(Request $request, Accessoire $accessoire)
    {
        if ($accessoire->image) {
            Storage::disk('public')->delete($accessoire->image);
        }
        $accessoire->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('accessoires.index'),
                'message' => 'Accessoire supprimé avec succès.'
            ]);
        }

        return redirect()->route('accessoires.index')
                        ->with('success', 'Accessoire supprimé avec succès.');
    }
}