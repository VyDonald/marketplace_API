@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-tags me-2"></i> Gestion des Catégories</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Ajouter une Catégorie
        </button>
    </div>

    <!-- Tableau des catégories -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="fw-bold px-4 py-3">Nom</th>
                            <th class="fw-bold px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTable">
                        @foreach($categories as $category)
                        <tr id="categoryRow-{{ $category->id }}">
                            <td class="px-4 py-3">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-warning btn-sm editCategoryBtn me-2" 
                                        data-id="{{ $category->id }}" 
                                        data-name="{{ $category->name }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCategoryModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm deleteCategoryBtn me-2" 
                                        data-id="{{ $category->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="btn btn-info btn-sm viewCategoryBtn" 
                                        data-id="{{ $category->id }}">
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

    <!-- Modale Ajout Catégorie -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i> Ajouter une Catégorie</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label fw-bold">Nom de la catégorie</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="Entrez le nom" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale Édition Catégorie -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Modifier la Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editCategoryForm">
                        <input type="hidden" id="editCategoryId">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label fw-bold">Nom</label>
                            <input type="text" class="form-control" id="editCategoryName" placeholder="Entrez le nom" required>
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