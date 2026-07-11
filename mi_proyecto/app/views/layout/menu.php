<nav class="pf-navbar">

    <div class="pf-navbar-inner">

        <a href="/mi_proyecto/app/views/usuarios/dashboard.php" class="pf-brand">
            <span class="pf-brand-icon">🐾</span>
            PawFinder
        </a>

        <button class="pf-navbar-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="pf-navbar-links" id="menu">

            <a href="/mi_proyecto/app/views/usuarios/dashboard.php">
                Inicio
            </a>

            <a href="/mi_proyecto/app/views/mascotas/catalogo.php">
                Catálogo
            </a>

            <a href="/mi_proyecto/app/views/mascotas/agregar.php">
                Publicar mascota
            </a>

            <a href="/mi_proyecto/app/views/solicitudes/mis_solicitudes.php">
                Mis solicitudes
            </a>

            <a href="/mi_proyecto/app/views/usuarios/perfil.php">
                Mi perfil
            </a>

            <div class="pf-navbar-user">

                <a href="/mi_proyecto/app/views/usuarios/perfil.php" class="pf-user-chip">

                    <div class="pf-user-avatar">
                        U
                    </div>

                    Usuario

                </a>

                <a href="/mi_proyecto/app/views/auth/login.php" class="pf-logout">
                    Cerrar sesión
                </a>

            </div>

        </div>

    </div>

</nav>

<script>

function toggleMenu(){

    var menu = document.getElementById("menu");

    if(menu.classList.contains("open")){

        menu.classList.remove("open");

    }else{

        menu.classList.add("open");

    }

}

</script>