<HTML>

<head>
    <title> POO de regalo de niño</title>
</head>

<body>
    <?php
    class RegaloNino
    {
        var $nombreRegalo;
        var $nombreNino;
        var $bueno;

        public function __construct($nombreRegalo, $nombreNino, $bueno)
        {
            $this->nombreRegalo = $nombreRegalo;
            $this->nombreNino = $nombreNino;
            $this->bueno = $bueno;
        }
        public function setNombreRegalo($nombreRegalo)
        {
            $this->nombreRegalo = $nombreRegalo;
        }
        public function getNombreRegalo()
        {
            return $this->nombreRegalo;
        }
        public function setNombreNino($nombreNino)
        {
            $this->nombreNino = $nombreNino;
        }
        public function getNombreNino()
        {
            return $this->nombreNino;
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