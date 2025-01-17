<?php
    class moi {
        
        private $attribut;

        public function __construct(){

        }

        public function afficherPage($mapage){
            if ($mapage == 1) $this -> page1();
            else if ($mapage == 2 ) $this -> page2();
            else $this -> page1();
        }

        public function page1(){
            echo "page 1";
        }
        public function page2(){
            echo "page 2";
        }
    }

?>