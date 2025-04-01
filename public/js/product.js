$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Ajouter un produit
    $('#addProductForm').submit(function (e) {
        e.preventDefault();
        let name = $('#productName').val();
        let description = $('#productDescription').val();
        let price = $('#productPrice').val();
        let category_id = $('#productCategory').val();

        $.ajax({
            url: "/admin/products",
            type: "POST",
            data: { name, description, price, category_id },
            success: function (response) {
                $('#productTable').append(`
                    <tr id="productRow-${response.id}">
                        <td>${response.name}</td>
                        <td>${response.description}</td>
                        <td>${response.price}</td>
                        <td>${response.category_name}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editProductBtn" 
                                    data-id="${response.id}" 
                                    data-name="${response.name}" 
                                    data-description="${response.description}" 
                                    data-price="${response.price}" 
                                    data-category-id="${response.category_id}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editProductModal">Modifier</button>
                            <button class="btn btn-danger btn-sm deleteProductBtn" data-id="${response.id}">Supprimer</button>
                            <button class="btn btn-info btn-sm viewProductBtn" data-id="${response.id}">Voir</button>
                        </td>
                    </tr>
                `);
                $('#addProductModal').modal('hide');
                $('#addProductForm')[0].reset();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Remplir les données pour modifier un produit
    $(document).on('click', '.editProductBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let price = $(this).data('price');
        let category_id = $(this).data('category-id');
        
        $('#editProductId').val(id);
        $('#editProductName').val(name);
        $('#editProductDescription').val(description);
        $('#editProductPrice').val(price);
        $('#editProductCategory').val(category_id);
    });

    // Modifier un produit
    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        let id = $('#editProductId').val();
        let name = $('#editProductName').val();
        let description = $('#editProductDescription').val();
        let price = $('#editProductPrice').val();
        let category_id = $('#editProductCategory').val();

        $.ajax({
            url: `/admin/products/${id}`,
            type: "PUT",
            data: { name, description, price, category_id },
            success: function (response) {
                $(`#productRow-${id}`).html(`
                    <td>${response.name}</td>
                    <td>${response.description}</td>
                    <td>${response.price}</td>
                    <td>${response.category_name}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editProductBtn" 
                                data-id="${response.id}" 
                                data-name="${response.name}" 
                                data-description="${response.description}" 
                                data-price="${response.price}" 
                                data-category-id="${response.category_id}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editProductModal">Modifier</button>
                        <button class="btn btn-danger btn-sm deleteProductBtn" data-id="${response.id}">Supprimer</button>
                        <button class="btn btn-info btn-sm viewProductBtn" data-id="${response.id}">Voir</button>
                    </td>
                `);
                $('#editProductModal').modal('hide');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Supprimer un produit
    $(document).on('click', '.deleteProductBtn', function () {
        let id = $(this).data('id');
        if (confirm("Voulez-vous supprimer ce produit ?")) {
            $.ajax({
                url: `/admin/products/${id}`,
                type: "DELETE",
                success: function () {
                    $(`#productRow-${id}`).remove();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });

    // Voir un produit
    $(document).on('click', '.viewProductBtn', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/products/${id}`,
            type: "GET",
            success: function (response) {
                alert(`Nom: ${response.name}\nDescription: ${response.description}\nPrix: ${response.price}\nCatégorie: ${response.category.name}`);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});