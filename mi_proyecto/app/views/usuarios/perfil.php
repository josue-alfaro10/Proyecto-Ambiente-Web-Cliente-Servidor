<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';


$usuario = $usuario ?? [
    'nombre'   => $nombreActual ?? '',
    'email'    => '',
    'telefono' => '',
];
?>

<div class="page-wrapper page-wrapper-narrow">

    <div class="page-header">
        <div>
            <span class="eyebrow-dark">Mi cuenta</span>
            <h1>Editar perfil</h1>
            <p class="page-subtitle">Actualizá tus datos de contacto.</p>
        </div>
    </div>

    <div class="pf-form-card">

        <form action="/mi_proyecto/app/views/usuarios/perfil.php" method="POST">
            <input type="hidden" name="accion" value="actualizar_perfil">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                    value="<?= htmlspecialchars($usuario['telefono']) ?>">
            </div>

            <hr class="pf-divider">

            <p class="form-section-label">Cambiar contraseña (opcional)</p>

            <div class="mb-3">
                <label for="password_actual" class="form-label">Contraseña actual</label>
                <input type="password" class="form-control" id="password_actual" name="password_actual">
            </div>

            <div class="mb-3">
                <label for="password_nueva" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" id="password_nueva" name="password_nueva">
            </div>

            <button type="submit" class="btn btn-pawfinder">Guardar cambios</button>
        </form>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>