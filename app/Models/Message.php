<?php
namespace App\Models;
use DateTime;
use App\Models\Model;

class Message extends Model{
    protected $table = "messages";

    public function insertMessage(array $data, int $product_id, int $user_id)
    {
        
        $content = htmlentities($data["content"]);
        $sender_id = $_SESSION["id"];
        $receiver_id = $user_id;
        $product_id = $product_id;
        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(sender_id, receiver_id, product_id, content) VALUES(?, ?, ?, ?)");
        return $stmt->execute([$sender_id, $receiver_id, $product_id, $content]);
    }
    
    public function getMessage(int $product_id, int $user_id)
    {
        $sender_id = $_SESSION["id"];
        $receiver_id = $user_id;
        $product_id = $product_id;
        $messages =  $this->query("SELECT * FROM {$this->table} WHERE sender_id = ? AND receiver_id = ? AND product_id = ? OR receiver_id = ? AND sender_id = ? AND product_id = ? ORDER BY id DESC",
         [$sender_id, $receiver_id, $product_id, $receiver_id, $sender_id, $product_id]);
        return $messages;
    }
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }
    
    
}