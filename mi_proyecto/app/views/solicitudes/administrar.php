<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/menu.php';

$solicitudes = [

    [
        "mascota" => "Max",
        "imagen" => "/mi_proyecto/public/img/placeholder-mascota.jpg",
        "mensaje" => "Me gustaría adoptar a Max porque tengo experiencia cuidando perros.",
        "fecha" => "10/07/2026",
        "estado" => "Pendiente"
    ],

    [
        "mascota" => "Luna",
        "imagen" => "/mi_proyecto/public/img/placeholder-mascota.jpg",
        "mensaje" => "Tengo un hogar amplio y mucho tiempo para cuidarla.",
        "fecha" => "05/07/2026",
        "estado" => "Aprobada"
    ],

    [
        "mascota" => "Rocky",
        "imagen" => "/mi_proyecto/public/img/placeholder-mascota.jpg",
        "mensaje" => "Siempre he querido adoptar un pastor alemán.",
        "fecha" => "28/06/2026",
        "estado" => "Rechazada"
    ]

];
?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <span class="eyebrow-dark">
                Solicitudes
            </span>

            <h1>
                Mis solicitudes
            </h1>

            <p class="page-subtitle">
                Consultá el estado de las solicitudes de adopción realizadas.
            </p>

        </div>

    </div>

    <div class="request-list">

        <?php foreach($solicitudes as $solicitud){ ?>

            <div class="request-card">

                <div class="request-card-img"
                    style="background-image:url('<?php echo $solicitud["imagen"]; ?>')">
                </div>

                <div class="request-card-body">

                    <h3>
                        <?php echo $solicitud["mascota"]; ?>
                    </h3>

                    <p class="request-msg">
                        "<?php echo $solicitud["mensaje"]; ?>"
                    </p>

                    <span class="request-date">
                        Fecha de solicitud:
                        <?php echo $solicitud["fecha"]; ?>
                    </span>

                </div>

                <div>

                    <?php
                    if($solicitud["estado"]=="Pendiente"){
                    ?>

                        <span class="pet-badge pet-badge-pendiente">
                            Pendiente
                        </span>

                    <?php
                    }

                    if($solicitud["estado"]=="Aprobada"){
                    ?>

                        <span class="pet-badge pet-badge-aprobada">
                            Aprobada
                        </span>

                    <?php
                    }

                    if($solicitud["estado"]=="Rechazada"){
                    ?>

                        <span class="pet-badge pet-badge-rechazada">
                            Rechazada
                        </span>

                    <?php
                    }
                    ?>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>