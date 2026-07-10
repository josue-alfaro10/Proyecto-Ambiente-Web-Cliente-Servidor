<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

/*
    Variables que asume esta vista:
    - $solicitudes -> array ['id','mascota_nombre','usuario_nombre','mensaje','fecha','estado']
*/
$solicitudes = $solicitudes ?? [];
?>

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Administración</span>
            <h1>Solicitudes de adopción</h1>
            <p class="page-subtitle">Revisá y respondé las solicitudes recibidas.</p>
        </div>
    </div>

    <div class="pf-table-wrapper">
        <table class="pf-table">
            <thead>
                <tr>
                    <th>Mascota</th>
                    <th>Solicitante</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($solicitudes)): ?>
                    <tr><td colspan="6" class="empty-state">No hay solicitudes registradas.</td></tr>
                <?php else: ?>
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <tr>
                            <td><?= htmlspecialchars($solicitud['mascota_nombre']) ?></td>
                            <td><?= htmlspecialchars($solicitud['usuario_nombre']) ?></td>
                            <td class="pf-table-msg"><?= htmlspecialchars($solicitud['mensaje'] ?? '') ?></td>
                            <td><?= htmlspecialchars($solicitud['fecha'] ?? '') ?></td>
                            <td>
                                <span class="pet-badge pet-badge-<?= htmlspecialchars($solicitud['estado'] ?? 'pendiente') ?>">
                                    <?= htmlspecialchars(ucfirst($solicitud['estado'] ?? 'pendiente')) ?>
                                </span>
                            </td>
                            <td class="text-end pf-table-actions">
                                <?php if (($solicitud['estado'] ?? 'pendiente') === 'pendiente'): ?>
                                    <!-- MODO DEMO: recarga la misma tabla. Cuando conectes SolicitudController.php,
                                         regresá el action a: action="/app/controllers/SolicitudController.php" -->
                                    <form action="/mi_proyecto/app/views/solicitudes/administrar.php" method="POST" class="pf-inline-form">
                                        <input type="hidden" name="accion" value="aprobar">
                                        <input type="hidden" name="id" value="<?= (int)$solicitud['id'] ?>">
                                        <button type="submit" class="pf-action-link">Aprobar</button>
                                    </form>
                                    <!-- MODO DEMO: recarga la misma tabla. Cuando conectes SolicitudController.php,
                                         regresá el action a: action="/mi_proyecto/app/controllers/SolicitudController.php" -->
                                    <form action="/mi_proyecto/app/views/solicitudes/administrar.php" method="POST" class="pf-inline-form">
                                        <input type="hidden" name="accion" value="rechazar">
                                        <input type="hidden" name="id" value="<?= (int)$solicitud['id'] ?>">
                                        <button type="submit" class="pf-action-link pf-action-danger">Rechazar</button>
                                    </form>
                                <?php else: ?>
                                    <span class="pf-table-done">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
