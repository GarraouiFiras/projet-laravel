<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\car;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
   public function index()
{
    return view('dashboard');
}
}