<?php
namespace App\Models;
use DateTime;
use App\Models\Model;

class Response extends Model{
    protected $table = "responses";

    public function insertResponse(array $data, int $comment_id)
    {
        
        $content = htmlentities($data["contenu"]);
        $id_user = $_SESSION["id"];
        $id_comment = $comment_id;
        $response_author = $_SESSION["pseudo"];
        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(content, id_user, id_comment, response_author) VALUES(?, ?, ?, ?)");
        return $stmt->execute([$content, $id_user, $id_comment, $response_author]);
    }
    
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }
}