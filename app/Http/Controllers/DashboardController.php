<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        
        return view('dashboard');  // Affiche la vue dashboard si l'utilisateur est authentifié
    }
    
}
