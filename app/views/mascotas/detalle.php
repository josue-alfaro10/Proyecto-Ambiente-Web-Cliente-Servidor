<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';
?>

<div class="page-wrapper">

    <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=catalogo" class="back-link">
        ← Volver al catálogo
    </a>

    <div class="pet-detail">

        <div class="pet-detail-img"
            style="background-image:url('<?= $mascota["imagen"] ?>')">

            <span class="pet-badge pet-badge-disponible">
                <?= $mascota["estado"] ?>
            </span>

        </div>

        <div class="pet-detail-info">

            <h1><?= $mascota["nombre"] ?></h1>

            <div class="pet-detail-tags">

                <span class="pf-tag"><?= $mascota["especie"] ?></span>

                <span class="pf-tag"><?= $mascota["raza"] ?></span>

                <span class="pf-tag"><?= $mascota["edad"] ?></span>

                <span class="pf-tag"><?= $mascota["tamano"] ?></span>

                <span class="pf-tag"><?= $mascota["sexo"] ?></span>

                <span class="pf-tag"><?= $mascota["ubicacion"] ?></span>

            </div>

            <p class="pet-detail-desc">
                <?= $mascota["descripcion"] ?>
            </p>

            <?php if ($mascota["estado"] === "Disponible"): ?>
                <form class="pet-detail-form" action="/mi_proyecto/app/controllers/SolicitudController.php" method="POST">
                    <input type="hidden" name="accion" value="crear">
                    <input type="hidden" name="id_mascota" value="<?= (int)$mascota["id"] ?>">

                    <div class="mb-3">

                        <label class="form-label">
                            ¿Por qué deseas adoptar esta mascota?
                        </label>

                        <textarea
                            class="form-control"
                            name="mensaje"
                            rows="5"
                            placeholder="Escribí aquí tu mensaje..."
                            required></textarea>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-pawfinder">

                        Enviar solicitud de adopción

                    </button>

                </form>
            <?php else: ?>
                <p class="empty-state">Esta mascota ya no está disponible para adopción.</p>
            <?php endif; ?>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>