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
    require_once __DIR__ . '/classPojo/cNino.php';
    require_once __DIR__ . '/funcionCrud/fNinos.php';
    require_once __DIR__ . '/funcionCrud/fRegalos.php';
    require_once __DIR__ . '/funcionCrud/fBusqueda.php';

    $fNino = new FNinos();
    $fRegalo = new FRegalos();
    $fPiden = new FPiden();

    $listaNinos = $fNino->obtenerNinos();
    $listaRegalos = $fRegalo->obtenerRegalos();

    $idNinoSeleccionado = $_GET['idSeleccionado'] ?? "";
    $idRegaloSeleccionado = $_GET['idRegaloSeleccionado'] ?? "";
    $accion = $_GET['accion'] ?? "";

    $regalosNino = [];
    $nombre = "";

    if ($idNinoSeleccionado !== "") {
        foreach ($listaNinos as $nino) {
            if ($nino->getId() == $idNinoSeleccionado) {
                $nombre = $nino->getNombre();
            }
        }
        $regalosNino = $fPiden->regalosDeNino($idNinoSeleccionado);
    }
    if ($accion === "Agregar" && $idNinoSeleccionado !== "" && $idRegaloSeleccionado !== "") {

        // Evitar repetidos
        if ($fPiden->existeRelacion($idNinoSeleccionado, $idRegaloSeleccionado)) {
            echo "<div class='alert alert-warning text-center'>⚠️ Este niño ya tiene ese regalo.</div>";
        } else {
            $fPiden->agregarRegalo($idNinoSeleccionado, $idRegaloSeleccionado);
            echo "<div class='alert alert-success text-center'>🎁 Regalo agregado correctamente.</div>";
        }

        // Recargar lista actualizada
        $regalosNino = $fPiden->regalosDeNino($idNinoSeleccionado);
    }elseif ($accion === "Agregar") {
        echo "<div class='alert alert-danger text-center'>❌ Debes seleccionar un niño y un regalo.</div>";
    }
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
            <div class="col-lg-3">
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <h6 class="bg-success text-white p-2 rounded text-center">Pide Regalos:</h6>
                    <form method="get">
                        <select class="form-select" name="idSeleccionado" onchange="this.form.submit()" aria-label="Default select example">
                            <option value="" selected>Selecciona niño</option>
                            <?php
                            foreach ($listaNinos as $nino) {
                                $selected = (isset($idNinoSeleccionado) && $idNinoSeleccionado == $nino->getId()) ? 'selected' : '';
                                echo "<option value='" . $nino->getId() . "' $selected>" . $nino->getNombre() . "</option>";
                            }
                            ?>
                        </select>

                    </form>
                </div>
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <h6 class="bg-success text-white p-2 rounded text-center">Regalos</h6>
                    <form method="get">
                         <input type="hidden" name="idSeleccionado" value="<?php echo $idNinoSeleccionado; ?>">
                        <select class="form-select" name="idRegaloSeleccionado" onchange="this.form.submit()" aria-label="Default select example">
                            <option value="" selected>Nuevo regalo</option>
                            <?php
                            foreach ($listaRegalos as $regalo) {
                                $selected = (isset($idRegaloSeleccionado) && $idRegaloSeleccionado == $regalo->getId()) ? 'selected' : '';
                                echo "<option value='" . $regalo->getId() . "' $selected>" . $regalo->getNombreRegalo() . "</option>";
                            }
                            ?>
                        </select>

                        <button class="btn btn-primary mt-1" type="submit" name="accion" value="Agregar">Agregar</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-9">
                <h2 class="mb-4 text-center ">Regalos de <?php echo htmlspecialchars($nombre); ?></h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-primary">

                            <th class="text-center">Foto</th>
                            <th class="text-center">Artículo</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Lo reparte</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        foreach ($regalosNino as $regalo) {
                            echo "<tr>";
                            // echo "<td class='text-center'>" . $regalo->getId() . "</td>";
                            echo "<td class='text-center'><img src='" . $regalo->getFoto() . "' width='80'></td>";
                            echo "<td class='text-center align-content-center'>" . $regalo->getNombreRegalo() . "</td>";
                            echo "<td class='text-center align-content-center'>" . $regalo->getPrecio() . "</td>";
                            echo "<td class='text-center align-content-center'>" . $regalo->getReparteRey() . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
</body>

</html>




</body>

</html>