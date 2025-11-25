<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../classPojo/cRegalo.php';

class FPiden
{
    private $connection;

    public function __construct()
    {
        $conectar = new Database();
        $this->connection = $conectar->getConnection();
    }

    // Regalos que un niño ha pedido
    public function regalosDeNino($idBoy)
    {
        $listaRegalosNiño = [];
        $resultado = mysqli_query($this->connection, "SELECT idRegalo, fotoRegalo, nombreRegalo, concat( precioRegalo,' €') as precios, nombreRey
                FROM Piden 
                JOIN Regalos  ON idRegaloFK = idRegalo
                JOIN Reyes ON idReyFK = idRey
                WHERE idBoyFK = $idBoy");


        while ($linea = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
            $regalo = new Regalo(
                $linea["idRegalo"],
                $linea["fotoRegalo"],
                $linea["nombreRegalo"],
                $linea["precios"],
                $linea["nombreRey"]
            );
            $listaRegalosNiño[] = $regalo;
        }
        return $listaRegalosNiño;
    }

    // Comprobar regalo
    public function existeRelacion($idBoy, $idRegalo)
    {
        $res = mysqli_query($this->connection, "SELECT idPedido FROM Piden 
                WHERE idBoyFK = $idBoy AND idRegaloFK = $idRegalo");
        return mysqli_num_rows($res) > 0;
    }

    
    public function agregarRegalo($idBoy, $idRegalo)
    {
    
        mysqli_query($this->connection, 
        "INSERT INTO Piden VALUES (NULL, $idBoy, $idRegalo)");
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }
}
