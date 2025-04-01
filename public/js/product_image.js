$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Ajouter une image
    $('#addProductImageForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData();
        formData.append('product_id', $('#productImageProduct').val());
        formData.append('image', $('#productImageFile')[0].files[0]);

        $.ajax({
            url: "/admin/product-images",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#productImageTable').append(`
                    <tr id="productImageRow-${response.id}">
                        <td>${response.product_name}</td>
                        <td><img src="${response.image_path}" alt="Image" style="max-width: 100px;"></td>
                        <td>
                            <button class="btn btn-danger btn-sm deleteProductImageBtn" data-id="${response.id}">Supprimer</button>
                            <button class="btn btn-info btn-sm viewProductImageBtn" data-id="${response.id}">Voir</button>
                        </td>
                    </tr>
                `);
                $('#addProductImageModal').modal('hide');
                $('#addProductImageForm')[0].reset();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Supprimer une image
    $(document).on('click', '.deleteProductImageBtn', function () {
        let id = $(this).data('id');
        if (confirm("Voulez-vous supprimer cette image ?")) {
            $.ajax({
                url: `/admin/product-images/${id}`,
                type: "DELETE",
                success: function () {
                    $(`#productImageRow-${id}`).remove();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });

    // Voir une image
    $(document).on('click', '.viewProductImageBtn', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/product-images/${id}`,
            type: "GET",
            success: function (response) {
                alert(`Produit: ${response.product_name}\nImage: ${response.image_path}`);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});