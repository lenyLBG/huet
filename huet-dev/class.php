<?php

include("bdd.php");
include("template.php");
    class moi {
        
        private $bdd;

        public function __construct(){
            $this -> bdd = new BDD();
        }

        public function afficherPage($mapage){
            if(!$this -> bdd -> connexion()) {
				echo "Une erreur est survenue à la connexion";
				return;
			}
            if ($mapage == 1) $this -> page1();
            else if ($mapage == 2 ) $this -> page2();
            else $this -> page1();
			$this -> bdd -> deconnexion();
        }

        public function page1() {
			$vue = new Template('templates/question.html');	
			
			$question = $this -> bdd -> getQuestion(1);		
			$reponses = $this -> bdd -> getReponses(1);		

			$vue -> remplacer('#TITRE_QUESTION#', $question -> intitule);	

			echo $vue -> getSortie();	

			echo '<ul>';
			foreach($reponses as $reponse) {
				echo '<li><input type="radio" name="reponses" value="'.$reponse -> id.'"> '.$reponse -> intitule.'</li>';
			}
			echo '</ul>';

			echo '<button id="valider" type="submit">Valider</button>';
			
			
			
		}
        public function page2() {
			echo "Deuxieme page";
			
			
		}
    }

?>