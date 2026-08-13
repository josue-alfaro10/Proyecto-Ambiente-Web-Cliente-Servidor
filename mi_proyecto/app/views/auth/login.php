<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="login-wrapper">
    <div class="login-hero">
        <span class="eyebrow">PawFinder</span>
        <h1>Cada refugio<br>merece ser encontrado.</h1>
        <p>Conectamos rescatistas, refugios y personas que buscan adoptar,
            en un solo lugar organizado.</p>
    </div>


    <div class="login-form-side">
        <div class="login-card">
            <h2>Iniciar sesión</h2>
            <p class="subtitle">Ingresá tus datos para continuar.</p>


            <form action="/mi_proyecto/app/views/usuarios/dashboard.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-pawfinder">Entrar</button>

                <div class="form-links">
                    <a href="/mi_proyecto/app/views/auth/recuperar.php">¿Olvidaste tu contraseña?</a>
                    <a href="/mi_proyecto/app/views/auth/register.php">Crear cuenta</a>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>