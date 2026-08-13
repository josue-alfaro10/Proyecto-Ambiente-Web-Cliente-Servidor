<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

$mascota = [
    "nombre" => "Max",
    "especie" => "Perro",
    "raza" => "Labrador",
    "edad" => "2 años",
    "sexo" => "Macho",
    "tamano" => "Grande",
    "ubicacion" => "Heredia",
    "estado" => "Disponible",
    "descripcion" => "Max es un perro muy cariñoso, juguetón y sociable. Le encanta salir a caminar y convivir con personas y otros animales. Busca una familia que pueda brindarle mucho amor y un hogar definitivo.",
    "imagen" => "/mi_proyecto/public/img/placeholder-mascota.jpg"
];
?>

<div class="page-wrapper">

    <a href="/mi_proyecto/app/views/mascotas/catalogo.php" class="back-link">
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

            <form class="pet-detail-form">

                <div class="mb-3">

                    <label class="form-label">
                        ¿Por qué deseas adoptar esta mascota?
                    </label>

                    <textarea
                        class="form-control"
                        rows="5"
                        placeholder="Escribí aquí tu mensaje..."></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-pawfinder">

                    Enviar solicitud de adopción

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>