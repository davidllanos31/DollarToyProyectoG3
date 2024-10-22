<style>
    .sidebar {
        background-color: #222222;
        flex-direction: column;
        padding: 20px;
        min-width: 16%;
        letter-spacing: 0.3px;
        height: 110vh;
    }

    .nav-link {
        display: flex;
        align-items: center;
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        transition: background-color 0.3s;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: rgb(135, 206, 250)
    }

    .nav-link img {
        margin-right: 10px;
        width: 20px;
        height: auto;
    }

    .logo {
        margin-bottom: 24px;
    }
</style>

<div class="sidebar">
    <div class="logo"><img src="/DollarToyProyectoG3/public/assets/images/logodollar-horizontal.png" width="150px"></div>
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
            <a href="<?= BASE_URI; ?>/iniciar-sesion" class="nav-link">
                <img src="<?= BASE_URI; ?>/public/assets/images/logout.png" alt="" style="width: 20px; height: 20px;"> Salir
            </a>
        </li>
    </ul>
</div>

<script>

window.onload = function() {
    const rol = localStorage.getItem('rol');

    if (rol === 'Vendedor') { // Suponiendo que 6 es el rol que debe ocultar los módulos
        const elementosAHacerOcultar = document.querySelectorAll('.nav-item:nth-child(2), .nav-item:nth-child(3), .nav-item:nth-child(5)'); // Usuarios, Categorías, Sedes
        elementosAHacerOcultar.forEach(elemento => {
            elemento.style.display = 'none'; // Ocultar elementos
        });
    }
};
</script>