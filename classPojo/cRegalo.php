<HTML>

<head>
    <title> POO de regalo</title>
</head>

<body>
    <?php
    class Regalo
    {
        var $id;
        var $foto;
        var $nombreRegalo;
        var $precio;
        var $reparteRey;
        public function __construct($id, $foto,$nombreRegalo, $precio, $reparteRey)
        {
            $this->id = $id;
            $this->foto = $foto;
            $this->nombreRegalo = $nombreRegalo;
            $this->precio = $precio;
            $this->reparteRey = $reparteRey;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setFoto($foto)
        {
            $this->foto = $foto;
        }
        public function getFoto()
        {
            return $this->foto;
        }
        public function setNombreRegalo($nombreRegalo)
        {
            $this->nombreRegalo = $nombreRegalo;
        }
        public function getNombreRegalo()
        {
            return $this->nombreRegalo;
        }
        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }
        public function getPrecio()
        {
            return $this->precio;
        }
        public function setReparteRey($reparteRey)
        {
            $this->reparteRey = $reparteRey;
        }
        public function getReparteRey()
        {
            return $this->reparteRey;
        }
    }
    ?>
</body>

</HTML>