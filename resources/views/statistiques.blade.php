@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --light-color: #ecf0f1;
        --dark-color: #2c3e50;
        --success-color: #2ecc71;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('/assets/img/art.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
        min-height: 100vh;
    }
    
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: -1;
    }
    
    .content {
        margin-left: 280px;
        padding: 30px;
        position: relative;
    }
    
    .navbar {
        background-color: rgba(255, 255, 255, 0.95) !important;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 15px 25px;
        margin-bottom: 30px;
        backdrop-filter: blur(5px);
    }
    
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.95);
        overflow: hidden;
        backdrop-filter: blur(5px);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--accent-color), #2980b9);
        color: white;
        font-weight: 600;
        border-bottom: none;
        padding: 20px;
    }
    
    .logout-btn {
        background: linear-gradient(135deg, var(--danger-color), #c0392b);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
    }
    
    .chart-container {
        position: relative;
        height: 100%;
        min-height: 300px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
    }
    
    .tnd-price {
        font-weight: bold;
        color: #2c3e50;
    }
    
    @media (max-width: 992px) {
        .content {
            margin-left: 0;
            padding: 15px;
        }
    }
</style>

<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <h1 class="navbar-brand mb-0 h4 fw-bold text-primary">
                <i class="fas fa-chart-pie me-2"></i>Statistiques GF Showroom
            </h1>
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-md-inline text-muted">
                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </nav>

    <!-- Graphiques Principaux -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Ventes Mensuelles</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="salesDropdown" data-bs-toggle="dropdown">
                            {{ now()->year }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">{{ now()->year - 1 }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ now()->year - 2 }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Répartition des Modèles</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="modelDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques Détailées -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Clients par Mois</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="clientsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-car me-2"></i>Top Véhicules Vendus</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="topCarsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section Top Clients -->
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-crown me-2"></i>Top 5 Clients</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="topClientsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Commandes</th>
                                    <th>Total Dépensé</th>
                                    <th>Dernière Commande</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rempli par JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée des cartes
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
        
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
    });

    // Récupération des données de l'API
    fetch('/api/statistics')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            if (!data) {
                throw new Error('Aucune donnée reçue');
            }

            // Formatage des montants en TND
            const formatTND = (amount) => {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal',
                    maximumFractionDigits: 0
                }).format(amount) + ' TND';
            };

            // 1. Graphique des ventes mensuelles
            const monthlySalesChart = new Chart(
                document.getElementById('monthlySalesChart'), 
                {
                    type: 'line',
                    data: {
                        labels: data.monthly_sales.labels,
                        datasets: [{
                            label: 'Ventes (TND)',
                            data: data.monthly_sales.data,
                            backgroundColor: 'rgba(52, 152, 219, 0.2)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'white',
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + 
                                               formatTND(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatTND(value);
                                    }
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                }
            );

            // 2. Graphique de répartition des modèles
            const modelDistributionChart = new Chart(
                document.getElementById('modelDistributionChart'), 
                {
                    type: 'doughnut',
                    data: {
                        labels: data.model_distribution.labels,
                        datasets: [{
                            data: data.model_distribution.data,
                            backgroundColor: [
                                'rgba(52, 152, 219, 0.7)',
                                'rgba(155, 89, 182, 0.7)',
                                'rgba(46, 204, 113, 0.7)',
                                'rgba(241, 196, 15, 0.7)',
                                'rgba(231, 76, 60, 0.7)'
                            ],
                            borderWidth: 1,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 20
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((context.raw / total) * 100);
                                        return `${context.label}: ${formatTND(context.raw)} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                }
            );

            // 3. Graphique des clients par mois
            const clientsChart = new Chart(
                document.getElementById('clientsChart'), 
                {
                    type: 'bar',
                    data: {
                        labels: data.clients.labels,
                        datasets: [{
                            label: 'Nouveaux clients',
                            data: data.clients.data,
                            backgroundColor: 'rgba(46, 204, 113, 0.7)',
                            borderColor: 'rgba(46, 204, 113, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                }
            );

            // 4. Graphique des top véhicules vendus
            const topCarsChart = new Chart(
                document.getElementById('topCarsChart'), 
                {
                    type: 'bar',
                    data: {
                        labels: data.top_cars.labels,
                        datasets: [{
                            label: 'Quantité vendue',
                            data: data.top_cars.data,
                            backgroundColor: 'rgba(241, 196, 15, 0.7)',
                            borderColor: 'rgba(241, 196, 15, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            );

            // 5. Remplissage du tableau des top clients
           // 5. Remplissage du tableau des top clients avec tri
const topClientsTable = document.getElementById('topClientsTable').getElementsByTagName('tbody')[0];

// Vider le tableau au cas où
topClientsTable.innerHTML = '';

// Vérifier que data.top_clients existe et est un tableau
if (Array.isArray(data.top_clients)) {
    // Trier par total dépensé (descendant)
    data.top_clients.sort((a, b) => {
        // Gestion des valeurs manquantes
        const totalA = a.total_depense || 0;
        const totalB = b.total_depense || 0;
        return totalB - totalA;
    });

    // Remplir le tableau
    data.top_clients.forEach((client, index) => {
        const row = topClientsTable.insertRow();
        
        const cellIndex = row.insertCell(0);
        const cellClient = row.insertCell(1);
        const cellOrders = row.insertCell(2);
        const cellTotal = row.insertCell(3);
        const cellLastOrder = row.insertCell(4);
        
        cellIndex.innerHTML = `<span class="badge bg-primary">${index + 1}</span>`;
        cellClient.innerHTML = `<strong>${client.client || 'N/A'}</strong>`;
        cellOrders.innerHTML = `<span class="badge bg-info">${client.commandes || 0}</span>`;
        cellTotal.innerHTML = `<span class="tnd-price">${formatTND(client.total_depense || 0)}</span>`;
        cellLastOrder.innerHTML = client.last_order 
            ? new Date(client.last_order).toLocaleDateString('fr-FR') 
            : 'N/A';
    });
} else {
    console.error('data.top_clients n\'est pas un tableau', data.top_clients);
}
        })
        .catch(error => {
            console.error("Erreur lors du chargement des données:", error);
            alert("Une erreur est survenue lors du chargement des données statistiques.");
        });
});


</script>
@endsection