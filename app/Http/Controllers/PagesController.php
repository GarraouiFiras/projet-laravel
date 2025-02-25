<?php

namespace App\Http\Controllers;
use App\Models\CarModel;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome';
        $models = CarModel::all(); // Récupérer les modèles depuis la base de données
    return view('welcome', compact('title', 'models')); 
        
    }

    public function about(){
        $title = 'About Us';
        return view('about')->with('title', $title);
    }

    public function contact(){
        $title = 'Contact Us';
        return view('contact')->with('title', $title);
    }

    public function services(){
        $title = 'Our Services';
        return view('services')->with('title', $title);
    }
    public function signup(){
        $title = 'signup';
        return view('signup')->with('title', $title);
    }
    public function produit(){
        $title = 'produit';
        return view('produit')->with('title', $title);
    }
    
}
