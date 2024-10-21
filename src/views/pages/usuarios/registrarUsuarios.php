<h2 class="mb-4">Usuarios</h2>
<div id="navbar" class="mb-4">
    <a href="#" onclick="window.location.href='<?= BASE_URI; ?>/usuarios'" class="nav-usuarios btn btn-secondary" data-url="<?= BASE_URI; ?>/usuarios">Listar Usuarios</a>
    <a href="#" onclick="window.location.href='<?= BASE_URI; ?>/usuarios/crear'" class="nav-usuarios btn btn-primary me-2 link-nav-interno-activo" data-url="<?= BASE_URI; ?>/usuarios/crear">Registrar Nuevo Usuario</a>
</div>
<form id="usuarioForm" method="POST" action="<?= BASE_URI; ?>/usuarios/registrar" class="mb-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="celular" class="form-label">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="contraseña" class="form-label">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="id_usuario_rol" class="form-label">Rol de Usuario:</label>
            <select id="id_usuario_rol" name="id_usuario_rol" class="form-select" required>
                <option value="">Seleccione un rol</option>
                <option value="1">Administrador</option>
                <option value="2">Usuario Regular</option>
                <!-- Añadir más opciones de roles según sea necesario -->
            </select>
        </div>
    </div>
    <div class="row mb-3 align-items-end">
        <div class="col-md-6">
            <label for="fecha_registro" class="form-label">Fecha de Registro:</label>
            <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>
        <div class="col-md-6 text-start">
            <button type="submit" class="btn btn-success">Guardar Usuario</button>
        </div>
    </div>
</form>