<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Marketplace</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS personnalisé -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
            background: linear-gradient(180deg, #1a1a2e, #16213e);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .list-group-item {
            background: transparent;
            border: none;
            padding: 15px 20px;
            color: #e0e0e0;
            transition: all 0.3s;
        }
        .list-group-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .list-group-item i {
            margin-right: 10px;
            width: 20px;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -250px;
        }
        #page-content-wrapper {
            margin-left: 250px;
            transition: all 0.3s;
        }
        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
        }
        .navbar .btn-toggle {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .navbar .btn-toggle:hover {
            background: #16213e;
        }
        .logout-btn {
            background: #dc3545;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .container-fluid {
            padding: 30px;
        }
        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px;
            }
            #page-content-wrapper {
                margin-left: 0;
            }
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personnalisés -->
    <script src="{{ asset('js/category.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('js/product_image.js') }}"></script>
    <script src="{{ asset('js/admin_auth.js') }}"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="fas fa-shopping-cart"></i> Marketplace Admin
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-tachometer-alt"></i> Tableau de bord
                </a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-box"></i> Produits
                </a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-tags"></i> Catégories
                </a>
                <a href="{{ route('admin.product-images.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-images"></i> Images des Produits
                </a>
            </div>
        </div>

        <!-- Contenu principal -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-toggle" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    @if(Auth::check())
                        <form action="{{ route('admin.logout') }}" method="POST" class="ms-auto">
                            @csrf
                            <button type="submit" class="btn logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    @endif
                </div>
            </nav>
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Toggle du menu latéral
        $("#menu-toggle").click(function() {
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>