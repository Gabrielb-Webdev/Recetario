$('#login-form').on('submit', function (e) {
    e.preventDefault();
    var username = $('#login-username').val();
    var password = $('#login-password').val();

    $.post('login.php', {username: username, password: password}, function (data) {
        var response = JSON.parse(data);
        if (response.status === "success") {
            localStorage.setItem('activeSession', response.user_id);
            alert('Login exitoso.');
            $.mobile.changePage("#home");
            cargarNotas('desayuno', '#notas', 'nota');
            cargarNotas('almuerzo', '#notas2', 'nota2');
            cargarNotas('merienda', '#notas3', 'nota3');
            cargarNotas('cena', '#notas4', 'nota4');
        } else {
            alert(response.message);
        }
    });
});
