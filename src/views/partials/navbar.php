<style>
    .sidebar {
        background-color: #222222;
        height: 100vh;
        width: 250px;
        display: flex;
        flex-direction: column;
        padding: 10px 5px;
        height: 100vh;
        min-width: 18%;
    }

    .nav-link {
        display: flex;
        align-items: center;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        margin-bottom: 15px;
        transition: background-color 0.3s;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .nav-link img {
        margin-right: 10px;
        width: 20px;
        height: auto;
    }

    .img-container {
        margin-left: 0.8em;
        margin-bottom: 20px;
    }

    .nav {
        margin-left: 0.8em;
    }

    .sidebar {
        padding: 10px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 1.1em;
    }
</style>

<div class="sidebar">
    <div class="img-container"><img src="public/assets/images/logodollar-horizontal.png" width="150px" alt="Logo" class="logo"></div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/home" class="nav-link active">
                <img src="<?= BASE_URI; ?>/public/assets/images/dashboard.png" alt="" style="width: 20px; height: 20px;"> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/usuarios" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/usuarios.png" alt="" style="width: 20px; height: 20px;"> Usuarios
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/categorias" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/categorias.png" alt="" style="width: 20px; height: 20px;"> Categorias
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/ventas" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/ventas.png" alt="" style="width: 20px; height: 20px;"> Ventas
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/sedes" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/sedes.png" alt="" style="width: 20px; height: 20px;"> Sedes
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/productos" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/productos.png" alt="" style="width: 20px; height: 20px;"> Productos
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/logout.png" alt="" style="width: 20px; height: 20px;"> LOGOUT
            </a>
        </li>
    </ul>
</div>