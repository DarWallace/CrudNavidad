<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regalos de Reyes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body class="bg-light">
    <?php
    require_once 'classPojo/cReyRegaloNino.php';
    require_once 'funcionCrud/fReyes.php';
    $fReyes = new fReyes();
    $listaRegaloNinosMelchor = $fReyes->obtenerRegaloNinoPorRey(1);
    $listaRegaloNinosGaspar = $fReyes->obtenerRegaloNinoPorRey(2);
    $listaRegaloNinosBaltasar = $fReyes->obtenerRegaloNinoPorRey(3);
    $totalMelchor = $fReyes->totalRegalosPorRey(1);
    $totalGaspar = $fReyes->totalRegalosPorRey(2);
    $totalBaltasar = $fReyes->totalRegalosPorRey(3);
    

    ?>
    <div class="container mt-4">

        <header class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0 b-4 rounded">
                <div class="container-fluid">
                    <a class="navbar-brand" href=""> 👑 Navidad</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="ninos.php">Niños</a></li>
                            <li class="nav-item"><a class="nav-link" href="regalos.php">Regalos</a></li>
                            <li class="nav-item"><a class="nav-link" href="reyes.php">Reyes</a></li>
                            <li class="nav-item"><a class="nav-link" href="busqueda.php">Búsqueda</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="row ">
            <img src="assets/img/niños.png" alt="imagen de niños sentados" class="mx-auto" style="width: 150px; height: auto;">
        </div>
        <div class="row">
            
            <div class="col-lg-4">
                <h3 class="mb-4 text-center bg-danger rounded text-light ">Melchor</h3>
                <div class="card shadow-sm p-3  bg-body rounded">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Regalos</th>
                                <th class="text-center">Niños</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            foreach ($listaRegaloNinosMelchor as $regaloNinoM) {
                                $clase = ($regaloNinoM->getBueno() == 0) ? "table-danger" : "";
                                echo "<tr class='$clase'>";
                                echo "<td class='text-center'>" . $regaloNinoM->getNombreRegalo() . "</td>";
                                echo "<td class='text-center align-content-center'>" . $regaloNinoM->getNombreNino() . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row bg-danger rounded m-1 text-light">
                        <div class="col-6 text-center ">Total:</div>
                         <div class="col-6 text-left"><?php echo $totalMelchor; ?></div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h3 class="mb-4 text-center bg-success rounded text-light">Gaspar</h3>
                <div class="card shadow-sm p-3  bg-body rounded">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Regalos</th>
                                <th class="text-center">Niños</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            foreach ($listaRegaloNinosGaspar as $regaloNinoG) {
                                $clase = ($regaloNinoG->getBueno() == 0) ? "table-danger" : "";
                                echo "<tr class='$clase'>";
                                echo "<td class='text-center'>" . $regaloNinoG->getNombreRegalo() . "</td>";
                                echo "<td class='text-center align-content-center'>" . $regaloNinoG->getNombreNino() . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row bg-success rounded m-1 text-light">
                        <div class="col-6 text-center">Total:</div>
                         <div class="col-6 text-left"><?php echo $totalGaspar; ?></div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h3 class="mb-4 text-center bg-warning rounded text-light">Baltasar</h3>
                <div class="card shadow-sm p-3  bg-body rounded">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Regalos</th>
                                <th class="text-center">Niños</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            foreach ($listaRegaloNinosBaltasar as $regaloNinoB) {
                                $clase = ($regaloNinoB->getBueno() == 0) ? "table-danger" : "";
                                echo "<tr class='$clase'>";
                                echo "<td class='text-center '>" . $regaloNinoB->getNombreRegalo() . "</td>";
                                echo "<td class='text-center align-content-center'>" . $regaloNinoB->getNombreNino() . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row bg-warning rounded m-1 text-light">
                        <div class="col-6 text-center">Total:</div>
                         <div class="col-6 text-left"><?php echo $totalBaltasar; ?></div> 
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class='alert alert-danger text-center fixed-bottom'>⚠️ Los niños en rojo se han portado mal y no tendrán regalos.</div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>