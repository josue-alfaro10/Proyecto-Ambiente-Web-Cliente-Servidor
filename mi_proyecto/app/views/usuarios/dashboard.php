<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';


$totalMascotas = $totalMascotas ?? 12;
$totalSolicitudes = $totalSolicitudes ?? 3;
$solicitudesPendientes = $solicitudesPendientes ?? 1;
$mascotasRecientes = $mascotasRecientes ?? [];
?>

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Panel</span>
            <h1>Hola, <?= htmlspecialchars($nombreActual) ?> </h1>
            <p class="page-subtitle">Este es el resumen de tu actividad en PawFinder.</p>
        </div>
        <?php if ($rolActual !== 'admin'): ?>
            <a href="/mi_proyecto/app/views/mascotas/agregar.php" class="btn btn-pawfinder btn-inline">+ Publicar mascota</a>
        <?php endif; ?>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-icon">🐾</span>
            <div>
                <span class="stat-number"><?= (int)$totalMascotas ?></span>
                <span class="stat-label"><?= $rolActual === 'admin' ? 'Mascotas en el sistema' : 'Mascotas publicadas' ?></span>
            </div>
        </div>
        <div class="stat-card">

            <div>
                <span class="stat-number"><?= (int)$totalSolicitudes ?></span>
                <span class="stat-label"><?= $rolActual === 'admin' ? 'Solicitudes totales' : 'Mis solicitudes' ?></span>
            </div>
        </div>
        <div class="stat-card stat-card-accent">

            <div>
                <span class="stat-number"><?= (int)$solicitudesPendientes ?></span>
                <span class="stat-label">Pendientes de revisión</span>
            </div>
        </div>
    </div>

    <div class="section-title-row">
        <h2>Mascotas recientes</h2>
        <a href="/mi_proyecto/app/views/mascotas/catalogo.php">Ver catálogo completo →</a>
    </div>

    <div class="pet-grid">
        <?php if (empty($mascotasRecientes)): ?>
            <p class="empty-state">Todavía no hay mascotas registradas.</p>
        <?php else: ?>
            <?php foreach ($mascotasRecientes as $mascota): ?>
                <a href="/mi_proyecto/app/views/mascotas/detalle.php?id=<?= (int)$mascota['id'] ?>" class="pet-card">
                    <div class="pet-card-img" style="background-image: url('<?= htmlspecialchars($mascota['imagen'] ?? '/mi_proyecto/public/img/placeholder-mascota.jpg') ?>')">
                        <span class="pet-badge pet-badge-<?= htmlspecialchars($mascota['estado'] ?? 'disponible') ?>">
                            <?= htmlspecialchars(ucfirst($mascota['estado'] ?? 'disponible')) ?>
                        </span>
                    </div>
                    <div class="pet-card-body">
                        <h3><?= htmlspecialchars($mascota['nombre']) ?></h3>
                        <p><?= htmlspecialchars($mascota['especie'] ?? '') ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>