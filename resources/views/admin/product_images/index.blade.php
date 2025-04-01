@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-images me-2"></i> Gestion des Images des Produits</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductImageModal">
            <i class="fas fa-plus me-2"></i> Ajouter une Image
        </button>
    </div>

    <!-- Tableau des images -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="fw-bold px-4 py-3">Produit</th>
                            <th class="fw-bold px-4 py-3">Image</th>
                            <th class="fw-bold px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productImageTable">
                        @foreach($productImages as $productImage)
                        <tr id="productImageRow-{{ $productImage->id }}">
                            <td class="px-4 py-3">{{ $productImage->product->name }}</td>
                            <td class="px-4 py-3">
                                <img src="{{ asset('storage/' . $productImage->image_path) }}" 
                                     alt="Image" 
                                     class="rounded" 
                                     style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            </td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-danger btn-sm deleteProductImageBtn me-2" 
                                        data-id="{{ $productImage->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="btn btn-info btn-sm viewProductImageBtn" 
                                        data-id="{{ $productImage->id }}">
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

    <!-- Modale Ajout Image -->
    <div class="modal fade" id="addProductImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i> Ajouter une Image</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addProductImageForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productImageProduct" class="form-label fw-bold">Produit</label>
                            <select class="form-control" id="productImageProduct" required>
                                <option value="" disabled selected>Choisissez un produit</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productImageFile" class="form-label fw-bold">Image</label>
                            <input type="file" class="form-control" id="productImageFile" accept="image/*" required>
                            <small class="text-muted">Formats acceptés : JPG, PNG (max 2 Mo)</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection