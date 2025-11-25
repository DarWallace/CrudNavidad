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
    require_once 'classPojo/cNino.php';
    require_once 'funcionCrud/fNinos.php';
    $fninos = new FNinos();
    $listaNinos = $fninos->obtenerNinos();
    $idSeleccionado = $_GET['idSeleccionado'] ?? "";
    $datosNino = null;

    if ($idSeleccionado !== "") {
        foreach ($listaNinos as $nino) {
            if ($nino->getId() == $idSeleccionado) {
                $datosNino = $nino;
                break;
            }
        }
    }
    $idNino   = $datosNino ? $datosNino->getId()      : "";
    $nombre   = $datosNino ? $datosNino->getNombre()   : "";
    $apellido = $datosNino ? $datosNino->getApellido() : "";
    $fecha    = $datosNino ? $datosNino->getFecha()    : "";
    $bueno    = $datosNino ? $datosNino->getBueno()    : "";

    $fechaForm = "";
    if ($datosNino) {
        $fechaBD = $datosNino->getFecha();
        $partes = explode("/", $fechaBD);

        $fechaForm = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
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
            <h2 class="mb-4 text-center">🎄Lista de Niños🎄</h2>
            <div class="card shadow-sm p-3  bg-body rounded">
                <!-- Tabla con los niños ordenados alfabéticamente por nombre. -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Apellido</th>
                            <th class="text-center">Fecha de Nacimiento</th>
                            <th class="text-center">¿Es Bueno?</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        foreach ($listaNinos as $nino) {
                            echo "<tr>";
                            echo "<td class='text-center'>" . $nino->getNombre() . "</td>";
                            echo "<td class='text-center'>" . $nino->getApellido() . "</td>";
                            echo "<td class='text-center'>" . $nino->getFecha() . "</td>";
                            echo "<td class='text-center'>" . ($nino->getBueno() ? 'Sí' : 'No') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-lg-3">
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <!-- cuadro para seleccionar niño o añadirlo -->
                    <h6 class="bg-success text-white p-2 rounded text-center">Introducir o modificar niños</h6>
                    <form method="get">
                        <select class="form-select" name="idSeleccionado" onchange="this.form.submit()" aria-label="Default select example">
                            <option value="" selected>Introducir nuevo niño</option>
                            <?php
                            foreach ($listaNinos as $nino) {
                                $selected = (isset($idSeleccionado) && $idSeleccionado == $nino->getId()) ? 'selected' : '';
                                echo "<option value='" . $nino->getId() . "' $selected>" . $nino->getNombre() . "</option>";
                            }
                            ?>
                        </select>
                    </form>
                </div>
            </div>

            <div class="col-lg-9 ">
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <!-- formulario para ingresar o modificar niño -->
                    <form class="row g-3" method="post" action="funcionCrud/fNinos.php">
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationNombre" class="form-label">Nombre</label>
                            <input type="hidden" name="idNino" value="<?php echo $idNino; ?>">
                            <input type="text" class="form-control" id="validationNombre" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationApellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="validationApellido" name="apellido" value="<?php echo $apellido; ?>" required>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationFecha" class="form-label">Fecha de cumple</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">🎂</span>
                                <input type="date" class="form-control" id="validationFecha" name="fecha" value="<?php echo $fechaForm; ?>" aria-describedby="inputGroupPrepend2" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <label for="validationBueno" class="form-label">Bueno</label>
                            <select class="form-select" id="validationBueno" name="bueno" required>
                                <option <?php echo ($bueno == 1) ? 'selected' : ''; ?> value="1">Sí</option>
                                <option <?php echo ($bueno == 0) ? 'selected' : ''; ?> value="0">No</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                    Los datos son correctos
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" name="accion" value="guardar">Aceptar</button>
                            <button class="btn btn-danger" type="submit" name="accion" value="borrar"
                                onclick="return confirm('¿Seguro que quieres borrar este niño?');">
                                Borrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>