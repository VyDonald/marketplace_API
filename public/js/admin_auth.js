$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#loginForm').submit(function (e) {
        e.preventDefault();
        let email = $('#email').val();
        let password = $('#password').val();

        $.ajax({
            url: '/admin/login',
            type: 'POST',
            data: { email, password },
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $('#errorMessage').text(response.message).show();
                }
            },
            error: function (xhr) {
                $('#errorMessage').text('Une erreur est survenue.').show();
            }
        });
    });
});