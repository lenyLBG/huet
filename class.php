<?php
    class moi {
        
        private $attribut;

        public function __construct(){
            $this -> attribut = 10;
        }

        public function methode(){
            return $this -> attribut;
        }
        public function setAttribut($values){
            if(($values >= 0) && ($values < 10)) $this -> attribut = $values;
        }
    }

?>