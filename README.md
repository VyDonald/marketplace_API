# 🛒 Marketplace Backoffice API

API RESTful complète construite avec Laravel pour la gestion d'une marketplace e-commerce : produits, catégories, images et authentification administrateur.

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Flutter](https://img.shields.io/badge/Flutter-App-02569B?style=flat&logo=flutter&logoColor=white)](https://github.com/VyDonald/marketplace_flutter_app)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 🔗 Liens du projet

- 📱 **Application Mobile Flutter**: [marketplace_flutter_app](https://github.com/VyDonald/marketplace_flutter_app)
- 🔧 **Backoffice API**: Ce repository

## 📑 Table des matières

- [Fonctionnalités](#-fonctionnalités)
- [Architecture](#-architecture)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Documentation API](#-documentation-api)
- [Routes publiques](#-routes-publiques)
- [Routes administrateur](#-routes-administrateur)
- [Exemples d'utilisation](#-exemples-dutilisation)

## ✨ Fonctionnalités

### 🔓 Partie Publique (Sans authentification)
- 📋 **Consultation des catégories** avec hiérarchie
- 🛍️ **Catalogue de produits** avec pagination et filtres
- 🔍 **Détails des produits** complets avec images
- 🔎 **Recherche et filtrage** avancés
- 📊 **Pagination optimisée** pour les performances

### 🔐 Partie Administrateur (Protégée)
- 👤 **Authentification sécurisée** avec Laravel Sanctum
- 📁 **Gestion des catégories** (CRUD complet)
- 📦 **Gestion des produits** (CRUD complet)
- 🖼️ **Gestion des images** de produits
- 🛡️ **Middleware admin** pour la sécurité
- ✅ **Validation des données** stricte

## 🏗️ Architecture

### Stack Technique

**Backend**
- Laravel 10.x
- PHP 8.1+
- MySQL/PostgreSQL
- Laravel Sanctum (Authentification)
- RESTful API Design

**Mobile App**
- Flutter
- Repository: [marketplace_flutter_app](https://github.com/VyDonald/marketplace_flutter_app)

### Structure du projet

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── CategoryController.php
│   │   ├── ProductController.php
│   │   ├── ProductImageController.php
│   │   └── PublicController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── Category.php
│   ├── Product.php
│   └── ProductImage.php
└── ...
```

## 🔧 Prérequis

- PHP >= 8.1
- Composer
- MySQL >= 5.7 ou PostgreSQL
- Laravel 10.x
- Extension PHP GD ou Imagick (pour les images)

## 🚀 Installation

### 1. Cloner le repository

```bash
git clone <votre-repo-backoffice>
cd <nom-du-projet>
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configuration de l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurer la base de données

Modifiez le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_db
DB_USERNAME=votre_user
DB_PASSWORD=votre_password
```

### 5. Configuration du stockage des images

```bash
php artisan storage:link
```

Assurez-vous que le dossier `storage/app/public/products` existe :

```bash
mkdir -p storage/app/public/products
```

### 6. Exécuter les migrations

```bash
php artisan migrate --seed
```

Cela créera les tables et un compte administrateur par défaut :
- Email: `admin@marketplace.com`
- Password: `password`

### 7. Démarrer le serveur

```bash
php artisan serve
```

L'API sera accessible sur `http://localhost:8000/api`

## 📚 Documentation API

### Base URL
```
http://localhost:8000/api
```

---

## 🌐 Routes Publiques

> ✅ Ces routes sont **accessibles sans authentification**

### 📋 Catégories Publiques

#### Lister toutes les catégories
```http
GET /public/categories
```

**Query Parameters:**
- `search` (optionnel) - Recherche par nom

**Response:**
```json
[
  {
    "id": 1,
    "name": "Électronique",
    "slug": "electronique",
    "description": "Appareils électroniques et gadgets",
    "image": "https://example.com/storage/categories/electronics.jpg",
    "parent_id": null,
    "created_at": "2024-01-15T10:00:00.000000Z"
  },
  {
    "id": 2,
    "name": "Smartphones",
    "slug": "smartphones",
    "parent_id": 1,
    "created_at": "2024-01-15T10:05:00.000000Z"
  }
]
```

### 🛍️ Produits Publics

#### Lister les produits (avec filtres et pagination)
```http
GET /public/products
```

**Query Parameters:**
- `page` (optionnel) - Numéro de page (défaut: 1)
- `per_page` (optionnel) - Nombre d'éléments par page (défaut: 15)
- `category_id` (optionnel) - Filtrer par catégorie
- `search` (optionnel) - Recherche par nom ou description
- `min_price` (optionnel) - Prix minimum
- `max_price` (optionnel) - Prix maximum
- `sort` (optionnel) - Tri: `price_asc`, `price_desc`, `newest`, `popular`

**Exemples:**
```
GET /public/products?page=1&per_page=20
GET /public/products?category_id=1&sort=price_asc
GET /public/products?search=samsung&min_price=100&max_price=500
```

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "name": "Samsung Galaxy S24",
      "slug": "samsung-galaxy-s24",
      "description": "Dernier smartphone flagship de Samsung",
      "price": 899.99,
      "stock": 50,
      "category_id": 2,
      "category": {
        "id": 2,
        "name": "Smartphones"
      },
      "images": [
        {
          "id": 1,
          "url": "https://example.com/storage/products/s24-front.jpg",
          "is_primary": true
        },
        {
          "id": 2,
          "url": "https://example.com/storage/products/s24-back.jpg",
          "is_primary": false
        }
      ],
      "created_at": "2024-02-01T14:30:00.000000Z"
    }
  ],
  "first_page_url": "http://localhost:8000/api/public/products?page=1",
  "from": 1,
  "last_page": 5,
  "last_page_url": "http://localhost:8000/api/public/products?page=5",
  "next_page_url": "http://localhost:8000/api/public/products?page=2",
  "path": "http://localhost:8000/api/public/products",
  "per_page": 15,
  "prev_page_url": null,
  "to": 15,
  "total": 73
}
```

#### Détails d'un produit
```http
GET /public/products/{id}
```

**Response:**
```json
{
  "id": 1,
  "name": "Samsung Galaxy S24",
  "slug": "samsung-galaxy-s24",
  "description": "Dernier smartphone flagship de Samsung avec écran AMOLED 6.2 pouces, processeur Snapdragon 8 Gen 3...",
  "price": 899.99,
  "stock": 50,
  "sku": "SAMS24-BLK-256",
  "category_id": 2,
  "category": {
    "id": 2,
    "name": "Smartphones",
    "parent": {
      "id": 1,
      "name": "Électronique"
    }
  },
  "images": [
    {
      "id": 1,
      "url": "https://example.com/storage/products/s24-front.jpg",
      "is_primary": true,
      "order": 1
    },
    {
      "id": 2,
      "url": "https://example.com/storage/products/s24-back.jpg",
      "is_primary": false,
      "order": 2
    }
  ],
  "specifications": {
    "screen": "6.2\" AMOLED",
    "processor": "Snapdragon 8 Gen 3",
    "ram": "8GB",
    "storage": "256GB"
  },
  "created_at": "2024-02-01T14:30:00.000000Z",
  "updated_at": "2024-02-15T09:20:00.000000Z"
}
```

---

## 🔐 Authentification

### 🔑 Connexion Administrateur

```http
POST /login
```

**Body:**
```json
{
  "email": "admin@marketplace.com",
  "password": "password"
}
```

**Response:**
```json
{
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@marketplace.com",
    "is_admin": true
  },
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

> 🔒 **Toutes les routes admin suivantes nécessitent:**
> ```
> Authorization: Bearer {votre_token}
> ```

---

## 👑 Routes Administrateur

> ⚠️ **Toutes ces routes sont protégées et réservées aux administrateurs**

### 📁 Gestion des Catégories

#### Créer une catégorie
```http
POST /admin/categories
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Body:**
```json
{
  "name": "Électronique",
  "description": "Appareils et gadgets électroniques",
  "parent_id": null,
  "image": <file>
}
```

**Response:**
```json
{
  "id": 1,
  "name": "Électronique",
  "slug": "electronique",
  "description": "Appareils et gadgets électroniques",
  "image": "https://example.com/storage/categories/electronics.jpg",
  "parent_id": null,
  "created_at": "2024-01-15T10:00:00.000000Z"
}
```

#### Modifier une catégorie
```http
PUT /admin/categories/{id}
Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "Électronique & High-Tech",
  "description": "Nouvelle description",
  "image": <file>
}
```

#### Supprimer une catégorie
```http
DELETE /admin/categories/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Catégorie supprimée avec succès"
}
```

---

### 📦 Gestion des Produits

#### Créer un produit
```http
POST /admin/products
Authorization: Bearer {token}
Content-Type: application/json
```

**Body:**
```json
{
  "name": "iPhone 15 Pro",
  "description": "Le dernier iPhone avec puce A17 Pro",
  "price": 1199.99,
  "stock": 30,
  "sku": "APPL-IP15PRO-256",
  "category_id": 2,
  "specifications": {
    "screen": "6.1\" Super Retina XDR",
    "processor": "A17 Pro",
    "ram": "8GB",
    "storage": "256GB"
  }
}
```

**Response:**
```json
{
  "id": 15,
  "name": "iPhone 15 Pro",
  "slug": "iphone-15-pro",
  "description": "Le dernier iPhone avec puce A17 Pro",
  "price": 1199.99,
  "stock": 30,
  "sku": "APPL-IP15PRO-256",
  "category_id": 2,
  "specifications": {
    "screen": "6.1\" Super Retina XDR",
    "processor": "A17 Pro",
    "ram": "8GB",
    "storage": "256GB"
  },
  "created_at": "2024-03-01T11:45:00.000000Z"
}
```

#### Modifier un produit
```http
PUT /admin/products/{id}
Authorization: Bearer {token}
```

**Body:**
```json
{
  "name": "iPhone 15 Pro Max",
  "price": 1299.99,
  "stock": 25
}
```

#### Supprimer un produit
```http
DELETE /admin/products/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Produit supprimé avec succès"
}
```

---

### 🖼️ Gestion des Images de Produits

#### Lister toutes les images
```http
GET /product-images
```

**Response:**
```json
[
  {
    "id": 1,
    "product_id": 1,
    "url": "https://example.com/storage/products/image1.jpg",
    "is_primary": true,
    "order": 1
  }
]
```

#### Ajouter une image à un produit
```http
POST /admin/product-images
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Body:**
```json
{
  "product_id": 1,
  "image": <file>,
  "is_primary": false,
  "order": 2
}
```

**Response:**
```json
{
  "id": 5,
  "product_id": 1,
  "url": "https://example.com/storage/products/uuid-filename.jpg",
  "is_primary": false,
  "order": 2,
  "created_at": "2024-03-01T15:30:00.000000Z"
}
```

#### Supprimer une image
```http
DELETE /admin/product-images/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Image supprimée avec succès"
}
```

---

## 💡 Exemples d'utilisation

### Exemple avec cURL

```bash
# Connexion admin
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@marketplace.com","password":"password"}'

# Créer un produit
curl -X POST http://localhost:8000/api/admin/products \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "MacBook Pro 16",
    "description": "Ordinateur portable haute performance",
    "price": 2499.99,
    "stock": 15,
    "category_id": 3
  }'

# Rechercher des produits
curl -X GET "http://localhost:8000/api/public/products?search=macbook&sort=price_asc"

# Obtenir les détails d'un produit
curl -X GET http://localhost:8000/api/public/products/1
```

### Exemple avec JavaScript (Fetch)

```javascript
// Connexion
const login = async () => {
  const response = await fetch('http://localhost:8000/api/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      email: 'admin@marketplace.com',
      password: 'password'
    })
  });
  
  const data = await response.json();
  localStorage.setItem('token', data.token);
  return data.token;
};

// Récupérer les produits avec filtres
const getProducts = async (filters = {}) => {
  const params = new URLSearchParams(filters);
  
  const response = await fetch(`http://localhost:8000/api/public/products?${params}`);
  const data = await response.json();
  
  return data;
};

// Créer un produit (Admin)
const createProduct = async (productData) => {
  const token = localStorage.getItem('token');
  
  const response = await fetch('http://localhost:8000/api/admin/products', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(productData)
  });
  
  return await response.json();
};

// Upload d'image
const uploadProductImage = async (productId, imageFile) => {
  const token = localStorage.getItem('token');
  const formData = new FormData();
  formData.append('product_id', productId);
  formData.append('image', imageFile);
  formData.append('is_primary', false);
  
  const response = await fetch('http://localhost:8000/api/admin/product-images', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`
    },
    body: formData
  });
  
  return await response.json();
};
```

### Exemple Dart/Flutter

```dart
import 'package:http/http.dart' as http;
import 'dart:convert';

class MarketplaceAPI {
  static const String baseUrl = 'http://localhost:8000/api';
  
  // Récupérer les produits
  static Future<Map<String, dynamic>> getProducts({
    int page = 1,
    String? categoryId,
    String? search,
  }) async {
    final params = {
      'page': page.toString(),
      if (categoryId != null) 'category_id': categoryId,
      if (search != null) 'search': search,
    };
    
    final uri = Uri.parse('$baseUrl/public/products')
        .replace(queryParameters: params);
    
    final response = await http.get(uri);
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Erreur de chargement des produits');
    }
  }
  
  // Détails d'un produit
  static Future<Map<String, dynamic>> getProductDetail(int productId) async {
    final response = await http.get(
      Uri.parse('$baseUrl/public/products/$productId'),
    );
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Produit non trouvé');
    }
  }
  
  // Login Admin
  static Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/login'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({
        'email': email,
        'password': password,
      }),
    );
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Identifiants invalides');
    }
  }
}
```

---

## 📊 Fonctionnalités de filtrage et pagination

### Filtres disponibles sur `/public/products`

| Paramètre | Type | Description | Exemple |
|-----------|------|-------------|---------|
| `page` | integer | Numéro de page | `page=2` |
| `per_page` | integer | Éléments par page (max: 100) | `per_page=20` |
| `category_id` | integer | ID de catégorie | `category_id=5` |
| `search` | string | Recherche textuelle | `search=samsung` |
| `min_price` | decimal | Prix minimum | `min_price=100` |
| `max_price` | decimal | Prix maximum | `max_price=500` |
| `sort` | string | Tri des résultats | `sort=price_asc` |

### Options de tri (`sort`)

- `price_asc` - Prix croissant
- `price_desc` - Prix décroissant
- `newest` - Plus récents en premier
- `oldest` - Plus anciens en premier
- `name_asc` - Nom A-Z
- `name_desc` - Nom Z-A

### Exemples de requêtes

```
# Smartphones de 100€ à 500€, triés par prix croissant
GET /public/products?category_id=2&min_price=100&max_price=500&sort=price_asc

# Recherche "samsung", 20 par page
GET /public/products?search=samsung&per_page=20

# Page 3 des produits, triés par nouveauté
GET /public/products?page=3&sort=newest
```

---

## 📝 Codes de statut HTTP

| Code | Description |
|------|-------------|
| `200` | ✅ Succès |
| `201` | ✅ Ressource créée |
| `204` | ✅ Suppression réussie |
| `400` | ❌ Requête invalide |
| `401` | ❌ Non authentifié |
| `403` | ❌ Accès refusé (non admin) |
| `404` | ❌ Ressource non trouvée |
| `422` | ❌ Erreur de validation |
| `500` | ❌ Erreur serveur |

---

## 🔒 Sécurité

- ✅ Authentification Laravel Sanctum
- ✅ Middleware admin pour routes protégées
- ✅ Validation stricte des données
- ✅ Protection CSRF
- ✅ Sanitization des uploads d'images
- ✅ Rate limiting sur API publique
- ✅ Hashage sécurisé des mots de passe

---

## 🖼️ Gestion des images

### Configuration recommandée

```php
// config/filesystems.php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### Types d'images acceptés

- JPEG (.jpg, .jpeg)
- PNG (.png)
- WebP (.webp)
- Taille maximale: 5MB

### Optimisation automatique

L'API redimensionne automatiquement les images :
- Produits: 800x800px
- Catégories: 400x400px
- Thumbnails: 200x200px

---

## 🧪 Tests

```bash
# Lancer tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter ProductTest
php artisan test --filter CategoryTest
```

---

## 📦 Dépendances principales

```json
{
  "require": {
    "php": "^8.1",
    "laravel/framework": "^10.0",
    "laravel/sanctum": "^3.0",
    "intervention/image": "^2.7"
  }
}
```

---

## 🚀 Déploiement

### Configuration de production

```bash
# Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
php artisan migrate --force

# Permissions storage
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Variables d'environnement

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.votre-marketplace.com

# Images
FILESYSTEM_DISK=public
```

---

## 📈 Roadmap

- [ ] 🛒 Gestion du panier (Cart API)
- [ ] 💳 Intégration paiement (Stripe, PayPal)
- [ ] 👤 Gestion des clients
- [ ] 📦 Gestion des commandes
- [ ] ⭐ Système d'avis et notes
- [ ] 🏷️ Système de promotions/coupons
- [ ] 📊 Dashboard analytics
- [ ] 📧 Notifications email
- [ ] 🔔 Push notifications
- [ ] 📱 Deep linking avec l'app mobile

---

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

---

## 👥 Équipe

**Backoffice API**: Ce repository  
**Application Mobile**: [VyDonald/marketplace_flutter_app](https://github.com/VyDonald/marketplace_flutter_app)

Développé avec ❤️ par **VyDonald**

---

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---

## 📞 Contact

- 🌐 GitHub: [@VyDonald](https://github.com/VyDonald)
- 📧 Email: contact@marketplace.com

---

**Développé avec 💙 pour faciliter le e-commerce**
