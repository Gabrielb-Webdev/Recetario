$('#register-form').on('submit', function (e) {
    e.preventDefault();
    var username = $('#register-username').val();
    var password = $('#register-password').val();

    $.post('register.php', {username: username, password: password}, function (data) {
        alert(data);
        if (data === "Registro exitoso") {
            $.mobile.changePage("#login");
        }
    });
});
