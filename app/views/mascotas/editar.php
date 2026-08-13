<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';
?>

<div class="page-wrapper page-wrapper-narrow">

    <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=administrar" class="back-link">
        ← Volver a administrar mascotas
    </a>

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Adopciones</span>
            <h1>Editar mascota</h1>
            <p class="page-subtitle">
                Actualizá la información de la mascota.
            </p>
        </div>
    </div>

    <div class="pf-form-card">

        <form action="/mi_proyecto/app/controllers/MascotaController.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="accion" value="editar">
            <input type="hidden" name="id" value="<?= (int)$mascota["id"] ?>">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    value="<?= $mascota["nombre"] ?>"
                    required>
            </div>

            <div class="form-row">

                <div class="mb-3">
                    <label class="form-label">Especie</label>

                    <select class="form-select" name="especie">

                        <option value="perro" <?= $mascota["especie"] == "perro" ? "selected" : "" ?>>
                            Perro
                        </option>

                        <option value="gato" <?= $mascota["especie"] == "gato" ? "selected" : "" ?>>
                            Gato
                        </option>

                        <option value="otro" <?= $mascota["especie"] == "otro" ? "selected" : "" ?>>
                            Otro
                        </option>

                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label">Raza</label>
                    <input
                        type="text"
                        class="form-control"
                        name="raza"
                        value="<?= $mascota["raza"] ?>">
                </div>

            </div>

            <div class="form-row">

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input
                        type="text"
                        class="form-control"
                        name="edad"
                        value="<?= $mascota["edad"] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexo</label>

                    <select class="form-select" name="sexo">

                        <option value="macho" <?= $mascota["sexo"] == "macho" ? "selected" : "" ?>>
                            Macho
                        </option>

                        <option value="hembra" <?= $mascota["sexo"] == "hembra" ? "selected" : "" ?>>
                            Hembra
                        </option>

                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label">Tamaño</label>

                    <select class="form-select" name="tamano">

                        <option value="pequeno" <?= $mascota["tamano"] == "pequeno" ? "selected" : "" ?>>
                            Pequeño
                        </option>

                        <option value="mediano" <?= $mascota["tamano"] == "mediano" ? "selected" : "" ?>>
                            Mediano
                        </option>

                        <option value="grande" <?= $mascota["tamano"] == "grande" ? "selected" : "" ?>>
                            Grande
                        </option>

                    </select>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">Ubicación</label>

                <select class="form-select" name="ubicacion">

                    <option value="alajuela" <?= $mascota["ubicacion"] == "alajuela" ? "selected" : "" ?>>Alajuela</option>
                    <option value="heredia" <?= $mascota["ubicacion"] == "heredia" ? "selected" : "" ?>>Heredia</option>
                    <option value="san jose" <?= $mascota["ubicacion"] == "san jose" ? "selected" : "" ?>>San José</option>
                    <option value="cartago" <?= $mascota["ubicacion"] == "cartago" ? "selected" : "" ?>>Cartago</option>
                    <option value="guanacaste" <?= $mascota["ubicacion"] == "guanacaste" ? "selected" : "" ?>>Guanacaste</option>
                    <option value="puntarenas" <?= $mascota["ubicacion"] == "puntarenas" ? "selected" : "" ?>>Puntarenas</option>
                    <option value="limon" <?= $mascota["ubicacion"] == "limon" ? "selected" : "" ?>>Limón</option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Descripción</label>

                <textarea
                    class="form-control"
                    name="descripcion"
                    rows="4"><?= $mascota["descripcion"] ?></textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Cambiar fotografía
                </label>

                <input
                    type="file"
                    class="form-control"
                    name="imagen"
                    accept="image/*">

            </div>

            <div class="form-actions">

                <button
                    type="submit"
                    class="btn btn-pawfinder">

                    Guardar cambios

                </button>

                <a
                    href="/mi_proyecto/app/controllers/MascotaController.php?accion=administrar"
                    class="btn btn-outline-pf">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>