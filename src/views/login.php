<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - Proyecto DollarToy
    </title>
    <link rel="stylesheet" href="/DollarToyProyectoG3/public/assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="/DollarToyProyectoG3/login" method="POST">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
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