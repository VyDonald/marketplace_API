$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    


    // Ajouter une catégorie
    $('#addCategoryForm').submit(function (e) {
        e.preventDefault();
        let name = $('#categoryName').val();
    
        $.ajax({
            url: "/admin/categories",
            type: "POST",
            data: { name: name },
            success: function (response) {
                $('#categoryTable').append(`
                    <tr id="categoryRow-${response.id}">
                        <td>${response.name}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editCategoryBtn" data-id="${response.id}" data-name="${response.name}" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Modifier</button>
                            <button class="btn btn-danger btn-sm deleteCategoryBtn" data-id="${response.id}">Supprimer</button>
                            <button class="btn btn-info btn-sm viewCategoryBtn" data-id="${response.id}">Voir</button>
                        </td>
                    </tr>
                `);
                $('#addCategoryModal').modal('hide');
                $('#addCategoryForm')[0].reset();
            }
        });        
    });
    

    // Remplir les données pour modifier une catégorie
    $(document).on('click', '.editCategoryBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        $('#editCategoryId').val(id);
        $('#editCategoryName').val(name);
    });

    // Modifier une catégorie
    $('#editCategoryForm').submit(function (e) {
        e.preventDefault();
        let id = $('#editCategoryId').val();
        let name = $('#editCategoryName').val();
    
        $.ajax({
            url: `/admin/categories/${id}`,
            type: "PUT",
            data: { name: name },
            success: function (response) {
                $(`#categoryRow-${id} td:first`).text(response.name);
                $('#editCategoryModal').modal('hide');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });        
    });
    

    // Supprimer une catégorie
    $(document).on('click', '.deleteCategoryBtn', function () {
        let id = $(this).data('id');
    
        if (confirm("Voulez-vous supprimer cette catégorie ?")) {
            $.ajax({
                url: `/admin/categories/${id}`,
                type: "DELETE",
                success: function () {
                    $(`#categoryRow-${id}`).remove();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
    
    $(document).on('click', '.viewCategoryBtn', function () {
        let id = $(this).data('id');
    
        $.ajax({
            url: `/admin/categories/${id}`,
            type: "GET",
            success: function (response) {
                alert("Nom de la catégorie : " + response.name);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });    
    
});
