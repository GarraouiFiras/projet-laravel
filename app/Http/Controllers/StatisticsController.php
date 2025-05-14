<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\car;
use App\Models\Commande;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use DateTime;

class StatisticsController extends Controller
{
    public function statistics()
    {
        return view('statistiques');
    }

    public function dashboardStats()
    {
        $stats = [
            'total_cars' => car::count(),
            'car_growth' => $this->calculateCarGrowth(),
            'total_clients' => $this->countUniqueClients(),
            'client_growth' => $this->calculateClientGrowth(),
            'total_orders' => Commande::whereMonth('created_at', now()->month)->count(),
            'order_growth' => $this->calculateOrderGrowth(),
            'total_revenue' => OrderItem::whereMonth('created_at', now()->month)->sum('prix_unitaire'),
            'revenue_growth' => $this->calculateRevenueGrowth(),
        ];

        return view('dashboard', compact('stats'));
    }

    public function apiStatistics()
    {
        return response()->json([
            'monthly_sales' => $this->getMonthlySales(),
            'model_distribution' => $this->getModelDistribution(),
            'clients' => $this->getClientsData(),
            'top_cars' => $this->getTopCars(),
            'top_clients' => $this->getTopClients()
        ]);
    }

    private function calculateCarGrowth()
    {
        $currentMonth = Car::whereMonth('created_at', now()->month)->count();
        $lastMonth = Car::whereMonth('created_at', now()->subMonth()->month)->count();

        return $this->calculateGrowthPercentage($currentMonth, $lastMonth);
    }

    private function countUniqueClients()
    {
        return Commande::distinct('nom_client')->count('nom_client');
    }

    private function calculateClientGrowth()
    {
        $currentMonth = Commande::whereMonth('created_at', now()->month)
                        ->distinct('nom_client')->count('nom_client');
        $lastMonth = Commande::whereMonth('created_at', now()->subMonth()->month)
                     ->distinct('nom_client')->count('nom_client');

        return $this->calculateGrowthPercentage($currentMonth, $lastMonth);
    }

    private function calculateOrderGrowth()
    {
        $currentMonth = Commande::whereMonth('created_at', now()->month)->count();
        $lastMonth = Commande::whereMonth('created_at', now()->subMonth()->month)->count();

        return $this->calculateGrowthPercentage($currentMonth, $lastMonth);
    }

    private function calculateRevenueGrowth()
    {
        $currentMonth = OrderItem::whereMonth('created_at', now()->month)->sum('prix_unitaire');
        $lastMonth = OrderItem::whereMonth('created_at', now()->subMonth()->month)->sum('prix_unitaire');

        return $this->calculateGrowthPercentage($currentMonth, $lastMonth);
    }

    private function calculateGrowthPercentage($current, $last)
    {
        if ($last == 0) return $current > 0 ? 100 : 0;
        return round(($current - $last) / $last * 100, 2);
    }

   private function getMonthlySales()
{
    // Solution 1: Si le montant total est dans la table commandes
    $sales = Commande::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $labels = [];
    $data = [];

    foreach (range(1, 12) as $month) {
        $monthName = DateTime::createFromFormat('!m', $month)->format('F');
        $labels[] = $monthName;
        
        // Trouve les ventes pour ce mois
        $monthSales = $sales->firstWhere('month', $month);
        $data[] = $monthSales ? (float)$monthSales->total : 0;
    }

    return [
        'labels' => $labels,
        'data' => $data
    ];
}

    private function getModelDistribution()
    {
        $models = car::select(
                'name as model',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('name')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return [
            'labels' => $models->pluck('model'),
            'data' => $models->pluck('count')
        ];
    }

    private function getClientsData()
    {
        $clients = Commande::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(DISTINCT nom_client) as count')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach (range(1, 12) as $month) {
            $labels[] = DateTime::createFromFormat('!m', $month)->format('M');
            $client = $clients->firstWhere('month', $month);
            $data[] = $client ? $client->count : 0;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    private function getTopCars()
    {
        $cars = OrderItem::select(
                'id',
                DB::raw('COUNT(*) as count'),
                DB::raw('(SELECT name FROM car WHERE id = order_items.id) as model')
            )
            ->groupBy('id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return [
            'labels' => $cars->pluck('model'),
            'data' => $cars->pluck('count')
        ];
    }

    private function getTopClients()
    {
        return Commande::select(
                'nom_client as client',
                DB::raw('COUNT(*) as commandes'),
                DB::raw('SUM(total) as total_depense'),
                DB::raw('MAX(created_at) as last_order')
            )
            ->groupBy('nom_client')
            ->orderByDesc('commandes')
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'client' => $item->client,
                    'commandes' => $item->commandes,
                    'total_depense' => $item->total_depense,
                    'last_order' => $item->last_order
                ];
            });
    }
}