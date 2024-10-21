<style>    
.sidebar {
    background-color: #222222; 
    flex-direction: column; 
    padding: 20px;
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
}

.nav-link img {
    margin-right: 10px;
    width: 20px; 
    height: auto; 
}
</style>  

<div class="sidebar">
    <h4><img src="public/assets/images/logodollar.png" alt="Logo" class="logo"></h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/home" class="nav-link active">
                <img src="<?= BASE_URI; ?>/public/assets/images/dashboard.png" alt="" style="width: 20px; height: 20px;"> DASHBOARD
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/usuarios" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/usuarios.png" alt="" style="width: 20px; height: 20px;"> USUARIOS
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/categorias" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/categorias.png" alt="" style="width: 20px; height: 20px;"> CATEGORIAS
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/ventas" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/ventas.png" alt="" style="width: 20px; height: 20px;"> VENTAS
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/sedes" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/sedes.png" alt="" style="width: 20px; height: 20px;"> SEDES
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URI; ?>/productos" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/productos.png" alt="" style="width: 20px; height: 20px;"> PRODUCTOS
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" >
            <img src="<?= BASE_URI; ?>/public/assets/images/logout.png" alt="" style="width: 20px; height: 20px;"> LOGOUT
            </a>
        </li>
    </ul>
</div>