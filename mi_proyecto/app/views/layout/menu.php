<?php

$rolActual = $_SESSION['usuario_rol'] ?? 'usuario';
$nombreActual = $_SESSION['usuario_nombre'] ?? 'Invitado';

// Resalta el link activo según el archivo actual
$paginaActual = basename($_SERVER['PHP_SELF']);
?>
<nav class="pf-navbar">
    <div class="pf-navbar-inner">
        <a href="/mi_proyecto/app/views/usuarios/dashboard.php" class="pf-brand">
            <span class="pf-brand-icon"></span>
            PawFinder
        </a>

        <button class="pf-navbar-toggle" type="button" aria-label="Abrir menú" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </button>

        <div class="pf-navbar-links" id="menu">
            <a href="/mi_proyecto/app/views/usuarios/dashboard.php" class="<?= $paginaActual === 'dashboard.php' ? 'active' : '' ?>">Inicio</a>
            <a href="/mi_proyecto/app/views/mascotas/catalogo.php" class="<?= $paginaActual === 'catalogo.php' ? 'active' : '' ?>">Catálogo</a>
            <a href="/mi_proyecto/app/views/mascotas/agregar.php" class="<?= $paginaActual === 'agregar.php' ? 'active' : '' ?>">Publicar mascota</a>
            <a href="/mi_proyecto/app/views/solicitudes/mis_solicitudes.php" class="<?= $paginaActual === 'mis_solicitudes.php' ? 'active' : '' ?>">Mis solicitudes</a>
            <a href="/mi_proyecto/app/views/usuarios/perfil.php" class="<?= $paginaActual === 'perfil.php' ? 'active' : '' ?>">Mi perfil</a>

            <?php if ($rolActual === 'admin'): ?>
                <a href="/mi_proyecto/app/views/mascotas/administrar.php" class="<?= ($paginaActual === 'administrar.php' && str_contains($_SERVER['REQUEST_URI'], 'mascotas')) ? 'active' : '' ?>">Administrar mascotas</a>
                <a href="/mi_proyecto/app/views/solicitudes/administrar.php" class="<?= ($paginaActual === 'administrar.php' && str_contains($_SERVER['REQUEST_URI'], 'solicitudes')) ? 'active' : '' ?>">Administrar solicitudes</a>
            <?php endif; ?>

            <div class="pf-navbar-user">
                <a href="/mi_proyecto/app/views/usuarios/perfil.php" class="pf-user-chip">
                    <span class="pf-user-avatar"><?= strtoupper(substr($nombreActual, 0, 1)) ?></span>
                    <?= htmlspecialchars($nombreActual) ?>
                </a>

                <a href="/mi_proyecto/app/views/auth/login.php" class="pf-logout">Cerrar sesión</a>
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