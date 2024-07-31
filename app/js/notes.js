function guardarNota(nuevaNota) {
    var notas = localStorage.getItem("notas");
    if (!notas) {
        notas = [];
    } else {
        notas = JSON.parse(notas);
    }
    notas.push(nuevaNota);
    localStorage.setItem("notas", JSON.stringify(notas));

    // Guardar en la base de datos
    $.post('save_note.php', nuevaNota, function (data) {
        console.log(data);
    });

    cargarNotas(nuevaNota.tipo, '#notas', 'nota');
}

function cargarNotas(tipo, contenedor, claseNota) {
    var usuario_id = localStorage.getItem('activeSession');
    $.post('get_notes.php', {usuario_id: usuario_id}, function (data) {
        var recuperados_array = JSON.parse(data);
        $(contenedor).empty();
        $.each(recuperados_array, function (indice, valor) {
            if (valor.tipo === tipo) {
                var nota = $('<div></div>');
                nota.attr('class', claseNota)
                    .attr('data-cumplido', valor.cumplido ? 'si' : 'no')
                    .append('<a href="#" class="check"><img src="imagenes/a.png" alt="a"></a>')
                    .append('<a href="#" class="edit"><img src="imagenes/b.png" alt="b"></a>')
                    .append('<a href="#" class="delete"><img src="imagenes/c.png" alt="c"></a>')
                    .append('<h3>' + valor.titulo + '</h3>')
                    .append('<p>' + valor.contenido + '</p>');

                if (valor.cumplido) {
                    nota.css({ backgroundColor: "green", color: "white" });
                }

                $(contenedor).append(nota);
            }
        });
    });
}
