document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.querySelector('.auth-form');
    const accion     = formulario.dataset.accion;

    formulario.addEventListener('submit', async function (evento) {
        evento.preventDefault();

        const boton = formulario.querySelector('.btn-submit');
        boton.disabled = true;

        const datos = { accion };

        if (accion === 'registro') {
            datos.nombre    = document.getElementById('name').value.trim();
            datos.correo    = document.getElementById('email').value.trim();
            datos.contrasena = document.getElementById('password').value;
            datos.confirmar  = document.getElementById('password-confirm').value;
        }

        if (accion === 'login') {
            datos.correo    = document.getElementById('email').value.trim();
            datos.contrasena = document.getElementById('password').value;
        }

        try {
            const resultado = await apiRequest('/backend/api/auth.php', datos);
            mostrarMensaje(resultado.mensaje, 'exito');

            setTimeout(function () {
                window.location.href = '/frontend/pages/dashboard.php';
            }, 1000);

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            boton.disabled = false;
        }
    });

    function mostrarMensaje(texto, tipo) {
        let mensaje = document.querySelector('.auth-mensaje');

        if (!mensaje) {
            mensaje = document.createElement('p');
            mensaje.classList.add('auth-mensaje');
            formulario.prepend(mensaje);
        }

        mensaje.textContent = texto;
        mensaje.className   = 'auth-mensaje auth-mensaje--' + tipo;
    }
});