<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="login-wrapper">

    <div class="login-hero">
        <span class="eyebrow">PawFinder</span>
        <h1>Elegí tu nueva<br>contraseña</h1>
        <p>Ingresá tu nueva contraseña para recuperar el acceso a tu cuenta.</p>
    </div>

    <div class="login-form-side">
        <div class="login-card">
            <h2>Nueva contraseña</h2>

            <form action="/mi_proyecto/app/controllers/AuthController.php" method="POST">
                <input type="hidden" name="accion" value="reset_password">
                <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

                <div class="mb-3">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>

                <button type="submit" class="btn btn-pawfinder">Cambiar contraseña</button>
            </form>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>