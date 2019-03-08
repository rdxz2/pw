<?php
    class Hewan{
        private $nama;
        private $hidup;

        function __construct($nama){
            $this->nama = $nama;
            $this->hidup = true;
            echo $this->nama . " adalah hewan hidup.<br>";
        }

        function __destruct()
        {
            $this->hidup = false;
            echo $this->nama . " telah wafat.<br>";
        }

        public function makan(){
            echo $this->nama . " suka makan, nyam nyam nyam nyam.<br>";
        }

        public function tidur(){
            echo $this->nama . " suka tidur, zzzz zzzz zzzz.<br>";
        }

        public function berjalan(){
            echo $this->nama . " suka berjalan, tuk ku tuk.<br>";
        }
    }

    $momo = new Hewan("momo");
    $mimi = new Hewan("mimi");
    $mumu = new Hewan("mumu");

    echo "<br>";

    $momo->makan();
    $mimi->tidur();
    $mumu->berjalan();

    echo "<br>";
?>