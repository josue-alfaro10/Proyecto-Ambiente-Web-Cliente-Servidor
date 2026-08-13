<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';
?>

<div class="page-wrapper page-wrapper-narrow">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Adopciones</span>
            <h1>Publicar mascota</h1>
            <p class="page-subtitle">Completá los datos para publicar la mascota.</p>
        </div>
    </div>

    <div class="pf-form-card">

        <form action="/mi_proyecto/app/controllers/MascotaController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="accion" value="crear">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <label for="especie" class="form-label">Especie</label>
                    <select class="form-select" id="especie" name="especie" required>
                        <option value="">Seleccioná...</option>
                        <option value="perro">Perro</option>
                        <option value="gato">Gato</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" id="raza" name="raza">
                </div>
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="text" class="form-control" id="edad" name="edad" placeholder="Ej: 2 años">
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" id="sexo" name="sexo">
                        <option value="macho">Macho</option>
                        <option value="hembra">Hembra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tamano" class="form-label">Tamaño</label>
                    <select class="form-select" id="tamano" name="tamano">
                        <option value="pequeno">Pequeño</option>
                        <option value="mediano">Mediano</option>
                        <option value="grande">Grande</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="tamano" class="form-label">Ubicacion</label>
                <select class="form-select" id="ubicacion" name="ubicacion">
                    <option value="alajuela">Alajuela</option>
                    <option value="heredia">Heredia</option>
                    <option value="san jose">San Jose</option>
                    <option value="cartago">Cartago</option>
                    <option value="guanacaste">Guanacaste</option>
                    <option value="puntarenas">Puntarenas</option>
                    <option value="limon">Limon</option>

                </select>
            </div>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">Foto</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
    </div>

    <button type="submit" class="btn btn-pawfinder">Publicar mascota</button>
    </form>
</div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>