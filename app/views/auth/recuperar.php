<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="login-wrapper">

    <div class="login-hero">
        <span class="eyebrow">PawFinder</span>
        <h1>¿Olvidaste tu<br>contraseña?</h1>
        <p>Ingresá el correo con el que te registraste y te
           enviaremos instrucciones para recuperar el acceso.</p>
    </div>

    <div class="login-form-side">
        <div class="login-card">
            <h2>Recuperar contraseña</h2>
            <p class="subtitle">Te enviaremos un enlace de recuperación.</p>

            <form action="/mi_proyecto/app/views/auth/login.php" method="POST">
                <input type="hidden" name="accion" value="recuperar">

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <button type="submit" class="btn btn-pawfinder">Enviar enlace</button>

                <div class="form-links">
                    <a href="/mi_proyecto/app/views/auth/login.php">Volver a iniciar sesión</a>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
