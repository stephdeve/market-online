<?php
namespace App\Models;

use DateTime;
use App\Models\Model;

class Answer extends Model{

    protected $table =  'reponses';

    public function insertAnswer(array $questions, int $id_auteur, string $pseudo, int $id)
    {
        $_SESSION["auth"] = true;
        $question_content = nl2br(htmlspecialchars($questions["contenu"]));
        $id_auteur = $id_auteur;
        $pseudo_auteur = $pseudo;
    
        $stmt = $this->db->getPDO()->prepare('INSERT INTO reponses(id_auteur, pseudo_auteur, contenu, id_question) VALUES(?,?,?,?)');
        $result = $stmt->execute([
            $id_auteur,
            $pseudo_auteur,
            $question_content,
            $id
        ]);

        if($result){
            return true;
        }
    }


    public function afficheAnswer(int $id)
    {
        return $this->query("SELECT * FROM reponses WHERE id_question = ? ORDER BY id DESC", [$id]);
        
    }

    public function getCreatedAt(): string
    {
        return (new DateTime($this->date_reponse))->format('d/m/Y à H:i');
    }

    public function getCurtContent(): string
    {
        return substr($this->contenu, 0, 200).'...';
    }
}