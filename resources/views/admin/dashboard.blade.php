@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 mb-4 fw-bold text-dark">Dashboard Admin</h1>

    <!-- Cartes de statistiques -->
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-primary text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Utilisateurs</h5>
                            <p class="card-text fs-4">{{ $usersCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-success text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-box fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Produits</h5>
                            <p class="card-text fs-4">{{ $productsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-warning text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tags fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Catégories</h5>
                            <p class="card-text fs-4">{{ $categoriesCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-info text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-images fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Images</h5>
                            <p class="card-text fs-4">{{ $productImageCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-secondary text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-camera fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Images par Produit</h5>
                            <p class="card-text fs-4">{{ $averageImagesPerProduct }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-dark text-white rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Utilisateurs Actifs</h5>
                            <p class="card-text fs-4">{{ $activeUsersCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Produits par Catégorie</h5>
                    <canvas id="productsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers produits ajoutés -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Derniers Produits Ajoutés</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ number_format($product->price, 2) }} €</td>
                                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun produit récent</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('productsChart').getContext('2d');
        const categoriesData = @json($categoriesData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(categoriesData),
                datasets: [{
                    label: 'Nombre de produits',
                    data: Object.values(categoriesData),
                    backgroundColor: 'rgba(26, 26, 46, 0.8)',
                    borderColor: 'rgba(26, 26, 46, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Produits'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Catégories'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection