<?php
class BDD {

public function __construct() {
    $this -> mysqli = false;
}

public function connexion() {
    //mysql_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    $this -> mysqli = new mysqli("192.168.56.40", "app", "P@ssw0rd", "TP_Quizz");

    if ($this -> mysqli -> connect_error) {
        echo "Erreur de connexion à la base de données";
        return false;
    }
    else return true;
}

public function deconnexion() {
    if ($this -> mysqli != false) {
        $this -> mysqli -> close();
    }
    
}

public function requete() {
    $requete = "SELECT * FROM question";
    $resultat = $this -> mysqli -> query($requete);
    return $resultat;
}

public function getQuestion($question_id) {
    if ($this -> mysqli == false) {
        return null;
    }
   
    $question = null;	//Servira a stocker la question

    /* On crée la requete SQL et on lie les paramètres */
    $requete = $this -> mysqli-> prepare("SELECT question.id, question.intitule, question.multiple FROM question WHERE question.id=?");
    $requete -> bind_param('i', $question_id);
    
    /* On execute la requete et on récupère le résultat */
    $requete -> execute();
    $resultat = $requete -> get_result();
    
    /* On libère la requête */
    $requete -> close();
    
    
    /* On parcours les résultats pour les stocker */
    if($enregistrement = $resultat -> fetch_object()) {
        $question = $enregistrement;	//On ajoute un element avec un l'id et l'intitule à la suite de nos réponses
    }
    
    return $question;		//On retourne les réponses de la question
}

/* Récupération des réponses d'une question en utilisant l'id de la question */
public function getReponses($question_id) {
    if ($this -> mysqli == false) {
        return null;
    }
    $reponses = []; //Servira a stocker la liste des reponses

    /* On crée la requete SQL et on lie les paramètres */
    $requete = $this -> mysqli-> prepare("SELECT reponse.id, reponse.intitule FROM reponse WHERE question_id=?");
    $requete -> bind_param('i', $question_id);
   
    /* On execute la requete et on récupère le résultat */
    $requete -> execute();
    $resultat = $requete -> get_result();
   
    /* On libère la requête */
    $requete -> close();
   
   
    /* On parcours les résultats pour les stocker */
    while ($enregistrement = $resultat -> fetch_object()) {
        $reponses[] = $enregistrement;  //On ajoute un element avec un l'id et l'intitule à la suite de nos réponses
    }
   

    return $reponses;       //On retourne les réponses de la question
}

}
?>