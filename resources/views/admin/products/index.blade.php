@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-box me-2"></i> Gestion des Produits</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-2"></i> Ajouter un Produit
        </button>
    </div>

    <!-- Tableau des produits -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="fw-bold px-4 py-3">Nom</th>
                            <th class="fw-bold px-4 py-3">Description</th>
                            <th class="fw-bold px-4 py-3">Prix</th>
                            <th class="fw-bold px-4 py-3">Catégorie</th>
                            <th class="fw-bold px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        @foreach($products as $product)
                        <tr id="productRow-{{ $product->id }}">
                            <td class="px-4 py-3">{{ $product->name }}</td>
                            <td class="px-4 py-3">{{ Str::limit($product->description, 50) }}</td>
                            <td class="px-4 py-3">{{ number_format($product->price, 2) }} €</td>
                            <td class="px-4 py-3">{{ $product->category->name }}</td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-warning btn-sm editProductBtn me-2" 
                                        data-id="{{ $product->id }}" 
                                        data-name="{{ $product->name }}" 
                                        data-description="{{ $product->description }}" 
                                        data-price="{{ $product->price }}" 
                                        data-category-id="{{ $product->category_id }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editProductModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm deleteProductBtn me-2" 
                                        data-id="{{ $product->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="btn btn-info btn-sm viewProductBtn" 
                                        data-id="{{ $product->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modale Ajout Produit -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i> Ajouter un Produit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="productName" placeholder="Entrez le nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="productDescription" rows="3" placeholder="Entrez la description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label fw-bold">Prix (€)</label>
                            <input type="number" step="0.01" class="form-control" id="productPrice" placeholder="0.00" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label fw-bold">Catégorie</label>
                            <select class="form-control" id="productCategory" required>
                                <option value="" disabled selected>Choisissez une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale Édition Produit -->
    <div class="modal fade" id="editProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Modifier le Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editProductForm">
                        <input type="hidden" id="editProductId">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="editProductName" placeholder="Entrez le nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="editProductDescription" rows="3" placeholder="Entrez la description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label fw-bold">Prix (€)</label>
                            <input type="number" step="0.01" class="form-control" id="editProductPrice" placeholder="0.00" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label fw-bold">Catégorie</label>
                            <select class="form-control" id="editProductCategory" required>
                                <option value="" disabled>Choisissez une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-sync-alt me-2"></i> Mettre à Jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection