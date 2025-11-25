<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../classPojo/cRegalo.php';
class FRegalos
{
    private $connection;

    public function __construct()
    {
        $conectar = new Database();
        $this->connection = $conectar->getConnection();
    }


    public function obtenerRegalos()
    {
        $listaRegalos = [];
        $resultado = mysqli_query($this->connection, "SELECT idRegalo, fotoRegalo, nombreRegalo, 
                         concat( precioRegalo,' €') as precios, nombreRey FROM regalos JOIN reyes on idRey =idReyFK ORDER BY nombreRegalo ASC");
        while ($linea = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
            $regalo = new Regalo(
                $linea['idRegalo'],
                $linea['fotoRegalo'],
                $linea['nombreRegalo'],
                $linea['precios'],
                $linea['nombreRey']
            );
            $listaRegalos[] = $regalo;
        }

        return $listaRegalos;
    }


    public function agregaModifica()
    {
        $idRegalo   = $_POST["idRegalo"] ?? "";
        $nombre   = $_POST["nombre"] ?? "";
        $foto = $_POST["foto"] ?? "";
        $precio    = $_POST["precio"] ?? "";
        $reyMago    = $_POST["reyMago"] ?? 1;
        $regalo = new Regalo(null, $foto, $nombre, $precio, $reyMago);
        $accion = $_POST['accion'] ?? 'guardar';

        if ($accion === 'borrar' && !empty($_POST['idRegalo'])) {
            $this->borrarRegalo($_POST['idRegalo']);
            return;
        }

        if ($idRegalo === "") {
            // INSERTAR
            $this->insertarRegalo($regalo);
        } else {
            // MODIFICAR
            $regalo->setId($idRegalo);
            $this->modificarRegalo($regalo);
        }
    }
    public function insertarRegalo($regalo)
    {
        $foto = trim($regalo->getFoto());
        if($foto==""||$foto==null){
            $foto = "../assets/img/generica.jpg";
        }
        $sentenciaInser = "INSERT INTO regalos VALUE 
         (NULL,'" 
         . $foto . "','" 
         . $regalo->getNombreRegalo() . "','" 
         . $regalo->getPrecio() . "'," 
         . $regalo->getReparteRey() . ");";
        mysqli_query($this->connection, $sentenciaInser);
    }
    public function modificarRegalo($regalo)
    {
        $sentenciaUpdate =
            "UPDATE regalos SET 
        fotoRegalo ='" . $regalo->getFoto() . "', 
        nombreRegalo='" . $regalo->getNombreRegalo() . "', 
        precioRegalo = '" . $regalo->getPrecio() . "', 
        idReyFK =" . $regalo->getReparteRey() . "
        WHERE idRegalo= " . $regalo->getId() . ";";

        mysqli_query($this->connection, $sentenciaUpdate);
    }
    public function borrarRegalo($idRegalo)
    {
        $sentenciaDelete = "DELETE FROM regalos WHERE idRegalo = " . $idRegalo . ";";
        mysqli_query($this->connection, $sentenciaDelete);
    }

    public function __destruct()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fn = new FRegalos();
    $fn->agregaModifica();
    header("Location: ../regalos.php"); // volver al formulario
    exit;
}
