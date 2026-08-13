<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

$mascotas = $mascotas ?? [];
$filtroEspecie = $filtroEspecie ?? '';
$filtroTamano = $filtroTamano ?? '';
$filtroLugar = $filtroLugar ?? '';
?>

<div class="page-wrapper">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Adopciones</span>
            <h1>Catálogo de mascotas</h1>
            <p class="page-subtitle">Encontrá a tu próximo compañero.</p>
        </div>
    </div>

    <!--
    En esta parte vamso a filtrar 
    por el tipo de especie que queremos ya sean perros, gatos o otros
     -->
    <form method="GET" action="/mi_proyecto/app/controllers/MascotaController.php" class="filter-bar">
        <input type="hidden" name="accion" value="catalogo">

        <select name="especie" class="form-select">
            <option value="">Todas las especies</option>
            <option value="perro" <?= $filtroEspecie === 'perro' ? 'selected' : '' ?>>Perro</option>
            <option value="gato" <?= $filtroEspecie === 'gato' ? 'selected' : '' ?>>Gato</option>
            <option value="otro" <?= $filtroEspecie === 'otro' ? 'selected' : '' ?>>Otro</option>
        </select>

        <!--
    En esta parte vamso a filtrar 
    por el size del animal 
    -->

        <select name="tamano" class="form-select">
            <option value="">Cualquier tamaño</option>
            <option value="pequeno" <?= $filtroTamano === 'pequeno' ? 'selected' : '' ?>>Pequeño</option>
            <option value="mediano" <?= $filtroTamano === 'mediano' ? 'selected' : '' ?>>Mediano</option>
            <option value="grande" <?= $filtroTamano === 'grande' ? 'selected' : '' ?>>Grande</option>
        </select>

        <!--
    En esta parte vamso a filtrar 
    por el lugar donde el usuario
    quiera encontrar a su mascota 
    este filtro va por busquedas en las provincias
    de nuestro pais.
    -->
        <select name="ubicacion" class="form-select">
            <option value="">Todas las ubicaciones</option>
            <option value="alajuela" <?= $filtroLugar === 'alajuela' ? 'selected' : '' ?>>Alajuela</option>
            <option value="heredia" <?= $filtroLugar === 'heredia' ? 'selected' : '' ?>>Heredia</option>
            <option value="san jose" <?= $filtroLugar === 'san jose' ? 'selected' : '' ?>>San Jose</option>
            <option value="cartago" <?= $filtroLugar === 'cartago' ? 'selected' : '' ?>>Cartago</option>
            <option value="guanacaste" <?= $filtroLugar === 'guanacaste' ? 'selected' : '' ?>>Guanacaste</option>
            <option value="puntarenas" <?= $filtroLugar === 'puntarenas' ? 'selected' : '' ?>>Puntarenas</option>
            <option value="limon" <?= $filtroLugar === 'limon' ? 'selected' : '' ?>>Limon</option>

        </select>

        <button type="submit" class="btn btn-pawfinder btn-inline">Filtrar</button>
    </form>

    <div class="pet-grid">
        <?php if (empty($mascotas)): ?>
            <p class="empty-state">No hay mascotas disponibles con esos filtros.</p>
        <?php else: ?>
            <?php foreach ($mascotas as $mascota): ?>
                <a href="/mi_proyecto/app/controllers/MascotaController.php?accion=detalle&id=<?= (int)$mascota['id'] ?>" class="pet-card">
                    <div class="pet-card-img" style="background-image: url('<?= htmlspecialchars($mascota['imagen'] ?? '/mi_proyecto/public/img/placeholder-mascota.jpg') ?>')"></div>
                    <span class="pet-badge pet-badge-<?= htmlspecialchars($mascota['estado'] ?? 'disponible') ?>">
                        <?= htmlspecialchars(ucfirst($mascota['estado'] ?? 'disponible')) ?>
                    </span>
    </div>
    <div class="pet-card-body">
        <h3><?= htmlspecialchars($mascota['nombre']) ?></h3>
        <p><?= htmlspecialchars($mascota['raza'] ?? $mascota['especie'] ?? '') ?></p>
        <span class="pet-card-meta">
            <?= htmlspecialchars($mascota['edad'] ?? '') ?> · <?= htmlspecialchars(ucfirst($mascota['tamano'] ?? '')) ?>
        </span>
        <span class="pet-card-meta">
            <?= htmlspecialchars($mascota['lugar'] ?? '') ?> · <?= htmlspecialchars(ucfirst($mascota['ubicacion'] ?? '')) ?>
        </span>
    </div>
    </a>
<?php endforeach; ?>
<?php endif; ?>
</div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>