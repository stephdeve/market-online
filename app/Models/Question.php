<?php
namespace App\Models;

use DateTime;
use App\Models\Model;

class Question extends Model{

    protected $table =  'questions';

    public function insertQuestion(array $questions, int $id, string $pseudo)
    {
        $_SESSION["auth"] = true;
        $question_title = htmlspecialchars($questions["titre"]);
        $question_description = nl2br(htmlspecialchars($questions["description"]));
        $question_content = nl2br(htmlspecialchars($questions["contenu"]));
        $id_auteur = $id;
        $pseudo_auteur = $pseudo;

        $stmt = $this->db->getPDO()->prepare('INSERT INTO questions(titre, description, contenu, id_auteur, pseudo_auteur) VALUES(?,?,?,?,?)');
        $result = $stmt->execute([
            $question_title,
            $question_content,
            $question_description,
            $id_auteur,
            $pseudo_auteur
        ]);

        if($result){
            return true;
        }
    }


    public function afficheQuestions()
    {
        $questions = $this->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        if(isset($_GET["search"]) && !empty($_GET["search"]))
        {
            //stockons la recherche effectuer par l'tilisateur dans une variable propres
            $getSearch = $_GET["search"];
            //affichons les resultats selon la recherche effectuer par l'utilisateur
            $questions =$this->query('SELECT * FROM questions WHERE titre OR contenu OR description OR date_publication LIKE "%'.$getSearch.'%"');
        }

        return $questions;
    }
    
    public function afficheQuestionSpecific(int $id)
    {
        return $this->query("SELECT * FROM questions WHERE id_auteur = ? ORDER BY id DESC", [$id]);
    }

    public function getCreatedAt(): string
    {
        return (new DateTime($this->date_publication))->format('d/m/Y à H:i');
    }

    public function getCurtContent(): string
    {
        if(strlen($this->contenu) > 200){
            return substr($this->contenu, 0, 200).'...';
        }else{
            return $this->contenu;
        }   
    }
}