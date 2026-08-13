<?php

$rolActual = $_SESSION['usuario_rol'] ?? 'usuario';
$nombreActual = $_SESSION['usuario_nombre'] ?? 'Invitado';

// Resalta el link activo según la acción del controlador actual
$accionActual = $_GET['accion'] ?? '';
?>
<nav class="pf-navbar">
    <div class="pf-navbar-inner">
        <a href="/mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard" class="pf-brand">
            <span class="pf-brand-icon"></span>
            PawFinder
        </a>

        <button class="pf-navbar-toggle" type="button" aria-label="Abrir menú" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </button>

        <div class="pf-navbar-links" id="menu">
            <a href="/mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard" class="<?= $accionActual === 'dashboard' ? 'active' : '' ?>">Inicio</a>
            <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=catalogo" class="<?= $accionActual === 'catalogo' ? 'active' : '' ?>">Catálogo</a>
            <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=agregar" class="<?= $accionActual === 'agregar' ? 'active' : '' ?>">Publicar mascota</a>
            <a href="/mi_proyecto/app/controllers/SolicitudController.php?accion=mis_solicitudes" class="<?= $accionActual === 'mis_solicitudes' ? 'active' : '' ?>">Mis solicitudes</a>
            <a href="/mi_proyecto/app/controllers/UsuarioController.php?accion=perfil" class="<?= $accionActual === 'perfil' ? 'active' : '' ?>">Mi perfil</a>

            <?php if ($rolActual === 'admin'): ?>
                <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=administrar" class="<?= ($accionActual === 'administrar' && str_contains($_SERVER['REQUEST_URI'], 'MascotaController')) ? 'active' : '' ?>">Administrar mascotas</a>
                <a href="/mi_proyecto/app/controllers/SolicitudController.php?accion=administrar" class="<?= ($accionActual === 'administrar' && str_contains($_SERVER['REQUEST_URI'], 'SolicitudController')) ? 'active' : '' ?>">Administrar solicitudes</a>
            <?php endif; ?>

            <div class="pf-navbar-user">
                <a href="/mi_proyecto/app/controllers/UsuarioController.php?accion=perfil" class="pf-user-chip">
                    <span class="pf-user-avatar"><?= strtoupper(substr($nombreActual, 0, 1)) ?></span>
                    <?= htmlspecialchars($nombreActual) ?>
                </a>

                <a href="/mi_proyecto/app/controllers/AuthController.php?accion=logout" class="pf-logout">Cerrar sesión</a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        if (menu.classList.contains("open")) {
            menu.classList.remove("open");
        } else {
            menu.classList.add("open");
        }
    }
</script>