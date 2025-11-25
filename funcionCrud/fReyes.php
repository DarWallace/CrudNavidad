<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../classPojo/cReyRegaloNino.php';

class fReyes
{
    private $connection;

    public function __construct()
    {
        $conectar = new Database();
        $this->connection = $conectar->getConnection();
    }
    public function obtenerRegaloNinoPorRey($idRey)
    {
        $listaRegaloNinos = [];
        $resultado = mysqli_query(
            $this->connection,
            "SELECT r.nombreRegalo, b.nombreBoy, b.buenBoy
            FROM Regalos r
            JOIN Piden p ON p.idRegaloFK = r.idRegalo
            JOIN boys b ON b.idBoy = p.idBoyFK
            WHERE r.idReyFK = $idRey"
        );

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $listaRegaloNinos[] = new RegaloNino(
                $fila['nombreRegalo'], 
                $fila['nombreBoy'],
                $fila['buenBoy']
            );
        }

        return $listaRegaloNinos;
    }
    public function totalRegalosPorRey($idRey)
    {
        $total = 0;
        $resultado = mysqli_query(
            $this->connection,
            "SELECT concat( sum(
            precioRegalo
            ),' €') as total
            FROM Regalos r
            JOIN Piden p ON p.idRegaloFK = r.idRegalo
            JOIN boys b ON b.idBoy = p.idBoyFK
            WHERE r.idReyFK = $idRey
             AND b.buenBoy = 1;"
        );

        if ($fila = mysqli_fetch_assoc($resultado)) {
            $total = $fila['total'];
        }

        return $total;
    }
}
