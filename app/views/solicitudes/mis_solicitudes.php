<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

/*
    Variables que asume esta vista:
    - $solicitudes -> array ['id','mascota_nombre','mascota_imagen','fecha','estado','mensaje']
*/
$solicitudes = $solicitudes ?? [];
?>

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Adopciones</span>
            <h1>Mis solicitudes</h1>
            <p class="page-subtitle">Seguí el estado de tus solicitudes de adopción.</p>
        </div>
    </div>

    <div class="request-list">
        <?php if (empty($solicitudes)): ?>
            <p class="empty-state">Todavía no enviaste ninguna solicitud. <a href="/mi_proyecto/app/views/mascotas/catalogo.php">Explorá el catálogo</a>.</p>
        <?php else: ?>
            <?php foreach ($solicitudes as $solicitud): ?>
                <div class="request-card">
                    <div class="request-card-img" style="background-image: url('<?= htmlspecialchars($solicitud['mascota_imagen'] ?? '/mi_proyecto/public/img/placeholder-mascota.jpg') ?>')"></div>
                    <div class="request-card-body">
                        <h3><?= htmlspecialchars($solicitud['mascota_nombre']) ?></h3>
                        <p class="request-msg">"<?= htmlspecialchars($solicitud['mensaje'] ?? '') ?>"</p>
                        <span class="request-date"><?= htmlspecialchars($solicitud['fecha'] ?? '') ?></span>
                    </div>
                    <span class="pet-badge pet-badge-<?= htmlspecialchars($solicitud['estado'] ?? 'pendiente') ?>">
                        <?= htmlspecialchars(ucfirst($solicitud['estado'] ?? 'pendiente')) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
