<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../classPojo/cNino.php';
class FNinos
{
    private $connection;

    public function __construct()
    {
        $conectar = new Database();
        $this->connection = $conectar->getConnection();
    }


    public function obtenerNinos()
    {
        $listaNinos = [];
        $resultado = mysqli_query($this->connection, "SELECT idBoy, nombreBoy, apellidoBoy, 
                         DATE_FORMAT(fechaNacimiento, '%d/%m/%Y') as fechaNacimiento, 
                         buenBoy 
                  FROM boys ORDER BY nombreBoy ASC");
        while ($linea = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
            $nino = new Nino(
                $linea['idBoy'],
                $linea['nombreBoy'],
                $linea['apellidoBoy'],
                $linea['fechaNacimiento'],
                $linea['buenBoy']
            );
            $listaNinos[] = $nino;
        }

        return $listaNinos;
    }


    public function agregaModifica()
    {
        $idNino   = $_POST["idNino"] ?? "";
        $nombre   = $_POST["nombre"] ?? "";
        $apellido = $_POST["apellido"] ?? "";
        $fecha    = $_POST["fecha"] ?? "";
        $bueno    = $_POST["bueno"] ?? 1;
        $nino = new Nino(null, $nombre, $apellido, $fecha, $bueno);
        $accion = $_POST['accion'] ?? 'guardar';

        if ($accion === 'borrar' && !empty($_POST['idNino'])) {
            $this->borrarNino($_POST['idNino']);
            return;
        }

        if ($idNino === "") {
            // INSERTAR
            $this->insertarNino($nino);
        } else {
            // MODIFICAR
            $nino->setId($idNino);
            $this->modificarNino($nino);
        }
    }
    public function insertarNino($nino)
    {
        $sentenciaInser = "INSERT INTO boys VALUE 
         (NULL,'" . $nino->getNombre() . "','" . $nino->getApellido() . "','" . $nino->getFecha() . "'," . $nino->getBueno() . ");";
        mysqli_query($this->connection, $sentenciaInser);
    }
    public function modificarNino($nino)
    {
        $sentenciaUpdate =
            "UPDATE boys SET 
        nombreBoy ='" . $nino->getNombre() . "', 
        apellidoBoy='" . $nino->getApellido() . "', 
        fechaNacimiento = '" . $nino->getFecha() . "', 
        buenBoy =" . $nino->getBueno() . "
        WHERE idboy= " . $nino->getId() . ";";

        mysqli_query($this->connection, $sentenciaUpdate);
    }
    public function borrarNino($idNino)
    {
        // Primero borrar pedidos asociados
        $sentenciaDeletePedidos = "DELETE FROM Piden WHERE idBoyFK = $idNino";
        mysqli_query($this->connection, $sentenciaDeletePedidos);

        // Luego borrar el niño
        $sentenciaDeleteNino = "DELETE FROM boys WHERE idBoy = $idNino";
        mysqli_query($this->connection, $sentenciaDeleteNino);

    }

    public function __destruct()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fn = new FNinos();
    $fn->agregaModifica();
    header("Location: ../ninos.php"); // volver al formulario
    exit;
}
