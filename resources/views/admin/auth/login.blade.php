<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Marketplace</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS personnalisé -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f4f6f9 0%, #e0e6ed 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 0 15px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(90deg, #1a1a2e, #16213e);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-bottom: none;
        }
        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-body {
            padding: 30px;
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #1a1a2e;
            box-shadow: 0 0 5px rgba(26, 26, 46, 0.3);
        }
        .btn-login {
            background: #1a1a2e;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #16213e;
        }
        #errorMessage {
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script personnalisé -->
    <script src="{{ asset('js/admin_auth.js') }}"></script>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-lock me-2"></i> Connexion Admin</h2>
            </div>
            <div class="card-body">
                <form id="loginForm">
                    <div class="mb-3 position-relative">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" placeholder="donald1457@gmail.com" required>
                        </div>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login w-100 text-white">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </button>
                </form>
                <div id="errorMessage" class="text-danger mt-3" style="display: none;"></div>
            </div>
        </div>
    </div>
</body>
</html>