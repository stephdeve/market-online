<?php
namespace App\Models;
use DateTime;
use App\Models\Model;

class Comment extends Model{
    protected $table = "comments";

    public function insertComment(array $data, int $product_id)
    {
        
        $content = htmlentities($data["content"]);
        $id_author = $_SESSION["id"];
        $id_product = $product_id;
        $comment_author = $_SESSION["pseudo"];
        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(content, id_autor, id_product, comment_author) VALUES(?, ?, ?, ?)");
        return $stmt->execute([$content, $id_author, $id_product, $comment_author]);
    }
    
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    public function getCommentByProduct(int $id_product)
    {
        $comments = $this->query("SELECT * FROM {$this->table} WHERE id_product = ? ORDER BY created_at DESC", [$id_product]);
        return $comments;
    }

    public function getResponseByComment(int $comment_id)
    {
        $responses = $this->query("SELECT * FROM responses WHERE id_comment = ? ORDER BY created_at", [$comment_id]);
        $ressutl = <<<HTML
                        <div class="d-flex mt-4">
                            
                            <div class="ms-3">
                    HTML;
                    foreach($responses as $response){
                        $ressutl .= <<<HTML
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="fw-bold">{$response->response_author}</div>
                            {$response->content}
                        HTML;
                    }
                    $ressutl .= <<<HTML
                            </div>
                        </div>
                    HTML;
        return $ressutl;
    }
}