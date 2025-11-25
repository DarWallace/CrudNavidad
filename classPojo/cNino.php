<HTML>

<head>
    <title> POO de nino</title>
</head>

<body>
    <?php
    class Nino
    {
        var $id;
        var $nombre;
        var $apellido;
        var $fecha;
        var $bueno;
        public function __construct($id, $nombre, $apellido, $fecha, $bueno)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fecha = $fecha;
            $this->bueno = $bueno;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setApellido($apellido)
        {
            $this->apellido = $apellido;
        }
        public function getApellido()
        {
            return $this->apellido;
        }
        public function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }
        public function getFecha()
        {
            return $this->fecha;
        }
        public function setBueno($bueno)
        {
            $this->bueno = $bueno;
        }
        public function getBueno()
        {
            return $this->bueno;
        }
    }
    ?>
</body>

</HTML>