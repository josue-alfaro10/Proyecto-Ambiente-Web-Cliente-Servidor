<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

$mascotas = [

    [
        "id" => 1,
        "nombre" => "Max",
        "especie" => "Perro",
        "raza" => "Labrador",
        "estado" => "Disponible"
    ],

    [
        "id" => 2,
        "nombre" => "Luna",
        "especie" => "Gato",
        "raza" => "Siamés",
        "estado" => "Adoptada"
    ],

    [
        "id" => 3,
        "nombre" => "Rocky",
        "especie" => "Perro",
        "raza" => "Pastor Alemán",
        "estado" => "Disponible"
    ]

];
?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <span class="eyebrow-dark">
                Administración
            </span>

            <h1>
                Administrar mascotas
            </h1>

            <p class="page-subtitle">
                Gestioná las publicaciones registradas en la plataforma.
            </p>

        </div>

        <a href="/mi_proyecto/app/views/mascotas/agregar.php"
            class="btn btn-pawfinder btn-inline">

            Nueva mascota

        </a>

    </div>

    <div class="pf-table-wrapper">

        <table class="pf-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach($mascotas as $mascota){ ?>

                    <tr>

                        <td>
                            <?php echo $mascota["id"]; ?>
                        </td>

                        <td>
                            <?php echo $mascota["nombre"]; ?>
                        </td>

                        <td>
                            <?php echo $mascota["especie"]; ?>
                        </td>

                        <td>
                            <?php echo $mascota["raza"]; ?>
                        </td>

                        <td>

                            <?php
                            if($mascota["estado"]=="Disponible"){
                            ?>

                                <span class="pet-badge pet-badge-disponible">
                                    Disponible
                                </span>

                            <?php
                            }else{
                            ?>

                                <span class="pet-badge pet-badge-adoptada">
                                    Adoptada
                                </span>

                            <?php
                            }
                            ?>

                        </td>

                        <td>

                            <div class="pf-table-actions">

                                <a
                                    href="/mi_proyecto/app/views/mascotas/editar.php"
                                    class="pf-action-link">

                                    Editar

                                </a>

                                <a
                                    href="#"
                                    class="pf-action-link pf-action-danger">

                                    Eliminar

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>