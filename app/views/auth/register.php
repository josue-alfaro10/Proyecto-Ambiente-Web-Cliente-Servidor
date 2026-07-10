<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="login-wrapper">

    <div class="login-hero">
        <span class="eyebrow">PawFinder</span>
        <h1>Sumate a la<br>comunidad rescatista.</h1>
        <p>Creá tu cuenta para publicar mascotas en adopción
           o encontrar a tu próximo compañero.</p>
    </div>

    <div class="login-form-side">
        <div class="login-card">
            <h2>Crear cuenta</h2>
            <p class="subtitle">Completá tus datos para empezar.</p>

            <form action="/mi_proyecto/app/views/usuarios/dashboard.php" method="POST">
                <input type="hidden" name="accion" value="registro">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>

                <button type="submit" class="btn btn-pawfinder">Crear cuenta</button>

                <div class="form-links">
                    <a href="/mi_proyecto/app/views/auth/login.php">Ya tengo cuenta</a>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
