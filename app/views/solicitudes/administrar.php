<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

$solicitudes = $solicitudes ?? [];
?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <span class="eyebrow-dark">
                Administración
            </span>

            <h1>
                Administrar solicitudes
            </h1>

            <p class="page-subtitle">
                Aprobá o rechazá las solicitudes de adopción recibidas.
            </p>

        </div>

    </div>

    <div class="request-list">

        <?php if (empty($solicitudes)): ?>
            <p class="empty-state">Todavía no hay solicitudes registradas.</p>
        <?php else: ?>

            <?php foreach ($solicitudes as $solicitud) { ?>

                <div class="request-card">

                    <div class="request-card-img"
                        style="background-image:url('<?php echo htmlspecialchars($solicitud["imagen"] ?? '/mi_proyecto/public/img/placeholder-mascota.jpg'); ?>')">
                    </div>

                    <div class="request-card-body">

                        <h3>
                            <?php echo htmlspecialchars($solicitud["mascota"]); ?>
                        </h3>

                        <p class="request-msg">
                            "<?php echo htmlspecialchars($solicitud["mensaje"]); ?>"
                        </p>

                        <span class="request-date">
                            Solicitante: <?php echo htmlspecialchars($solicitud["solicitante"]); ?>
                            · <?php echo htmlspecialchars(date("d/m/Y", strtotime($solicitud["fecha"]))); ?>
                        </span>

                    </div>

                    <div class="pf-table-actions">

                        <?php if ($solicitud["estado"] == "Pendiente") { ?>

                            <span class="pet-badge pet-badge-pendiente">
                                Pendiente
                            </span>

                            <a
                                href="/mi_proyecto/app/controllers/SolicitudController.php?accion=aprobar&id=<?= (int)$solicitud["id_solicitud"] ?>"
                                class="pf-action-link"
                                onclick="return confirm('¿Aprobar esta solicitud? La mascota quedará marcada como adoptada.');">

                                Aprobar

                            </a>

                            <a
                                href="/mi_proyecto/app/controllers/SolicitudController.php?accion=rechazar&id=<?= (int)$solicitud["id_solicitud"] ?>"
                                class="pf-action-link pf-action-danger"
                                onclick="return confirm('¿Rechazar esta solicitud?');">

                                Rechazar

                            </a>

                        <?php } elseif ($solicitud["estado"] == "Aprobada") { ?>

                            <span class="pet-badge pet-badge-aprobada">
                                Aprobada
                            </span>

                        <?php } elseif ($solicitud["estado"] == "Rechazada") { ?>

                            <span class="pet-badge pet-badge-rechazada">
                                Rechazada
                            </span>

                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

        <?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
