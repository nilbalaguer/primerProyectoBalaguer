document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const usuario = document.getElementById('usuario').value;
    const contrasenya = document.getElementById('contrasenya').value;

    const data = {
        usuario: usuario,
        contrasenya: contrasenya
    };

    fetch('/api/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.estado === 'Exito') {
            alert(data.mensaje);
            // Aquí puedes redirigir o realizar acciones después de iniciar sesión
        } else {
            alert('Error: ' + data.mensaje);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema al procesar la solicitud');
    });
});
