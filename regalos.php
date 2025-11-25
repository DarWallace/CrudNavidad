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
    require_once 'classPojo/cRegalo.php';
    require_once 'funcionCrud/fRegalos.php';
    $fRegalos = new FRegalos();
    $listaRegalos = $fRegalos->obtenerRegalos();
    $idSeleccionado = $_GET['idSeleccionado'] ?? "";
    $datosRegalo = null;

    if ($idSeleccionado !== "") {
        foreach ($listaRegalos as $regalo) {
            if ($regalo->getId() == $idSeleccionado) {
                $datosRegalo = $regalo;
                break;
            }
        }
    }
    $idRegalo   = $datosRegalo ? $datosRegalo->getId()      : "";
    $nombre   = $datosRegalo ? $datosRegalo->getNombreRegalo()   : "";
    $foto = $datosRegalo ? $datosRegalo->getFoto() : "";
    $precio    = $datosRegalo ? $datosRegalo->getPrecio()    : "";
    $reyMago    = $datosRegalo ? $datosRegalo->getReparteRey()    : "";
    
   

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
            <h2 class="mb-4 text-center">🎄Lista de Regalos🎄</h2>
            <div class="card shadow-sm p-3  bg-body rounded">
                <!-- Tabla con los regalos ordenados alfabéticamente por nombre. -->
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
                        foreach ($listaRegalos as $regalo) {
                            echo "<tr>";
                            echo "<td class='text-center'><img src='" . $regalo->getFoto() . "' width='80'
                            onerror=\"this.onerror=null; this.src='assets/img/generica.jpg';\"></td>";
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
        <hr>
        <div class="row mb-3">
            <div class="col-lg-3">
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <!-- cuadro para seleccionar regalo o añadirlo -->
                    <h6 class="bg-success text-white p-2 rounded text-center">Introducir o modificar Regalo</h6>
                <form method="get">
                    <select class="form-select" name="idSeleccionado" onchange="this.form.submit()" aria-label="Default select example">
                        <option value="" selected>Introducir nuevo regalo</option>
                        <?php
                        foreach ($listaRegalos as $regalo) {
                            $selected = (isset($idSeleccionado) && $idSeleccionado == $regalo->getId()) ? 'selected' : '';
                            echo "<option value='" . $regalo->getId() . "' $selected>" . $regalo->getNombreRegalo() . "</option>";
                        }
                        ?>
                    </select>

                </form>
                </div>
                
            </div>

            <div class="col-lg-9 ">
                <div class="card shadow-sm p-3 mb-2 bg-body rounded">
                    <!-- formulario para ingresar o modificar regalo -->
                    <form class="row g-3" method="post" action="funcionCrud/fRegalos.php">
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationFoto" class="form-label">Foto</label>
                            <input type="text" class="form-control" id="validationFoto" name="foto" value="<?php echo $foto; ?>" >
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationNombre" class="form-label">Nombre</label>
                            <input type="hidden" name="idRegalo" value="<?php echo $idRegalo; ?>">
                            <input type="text" class="form-control" id="validationNombre" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationPrecio" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">💶</span>
                                <input type="number" step="0.01" class="form-control" id="validationPrecio" name="precio" value="<?php echo $precio; ?>" aria-describedby="inputGroupPrepend2" required>
                            </div>
                        </div>
    
                        <div class="col-lg-3 col-sm-6">
                            <label for="validationDefault04" class="form-label">Rey Mago</label>
                            <select class="form-select" id="validationDefault04" name="reyMago" required>
                                <option <?php echo ($reyMago == 1) ? 'selected' : ''; ?> value="1">Melchor</option>
                                <option <?php echo ($reyMago == 2) ? 'selected' : ''; ?> value="2">Gaspar</option>
                                <option <?php echo ($reyMago == 3) ? 'selected' : ''; ?> value="3">Baltasar</option>
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
                                onclick="return confirm('¿Seguro que quieres borrar este regalo?');">
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