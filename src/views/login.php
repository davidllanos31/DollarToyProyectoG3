<!DOCTYPE html>
<html lang="es">
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-image: url('public/assets/images/fondologin.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
    }

    .login-container {
        width: 400px;
        padding: 20px;
        background: rgba(0, 0, 0, 0.8) !important;
        border-radius: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .login-container h1 {
        color: white;
    }

    h1 {
        text-align: center;
    }

    .input-group {
        margin-bottom: 15px;
        width: 100%;
        color: white;
    }

    .input-group label {
        color: white;
    }

    .login-btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .login-btn:hover {
        background-color: #45a049;
    }

    .logo {
        max-width: 50%;
        height: auto;
        margin-bottom: 20px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Login - Proyecto DollarToy
    </title>
    <link rel="stylesheet" href="/DollarToyProyectoG3/public/assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <img src="public/assets/images/logodollar.png" alt="Logo" class="logo">
        <h1>Iniciar Sesión</h1>
        <form id="loginForm">
            <div class="input-group">
                <label for="email">Correo:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Entrar</button>
        </form>
    </div>
</body>

</html>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('https://api-rest-dollar-toy.vercel.app/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: email,
            password: password
        })
    })
    .then(response => {
        if (!response.ok) {
            // return response.json().then(err => {
            //     throw new Error(err.message || 'Credenciales incorrectas');
            // });
            throw new Error('Credenciales incorrectas');
        }
        return response.json();
    })
    .then(data => {
        // Guardar el token y el rol en localStorage
        localStorage.setItem('token', data.token);
        localStorage.setItem('rol', data.usuario.rol);

        // Redirigir
        window.location.href = "/DollarToyProyectoG3/home";
    })
    .catch(error => {
        // alert(error.message);
        alert("Credenciales Incorrectas");
    });
});
</script>