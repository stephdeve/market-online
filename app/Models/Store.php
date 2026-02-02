<?php
namespace App\Models;

use DateTime;
use App\Models\User;
use App\Models\Model;

class Store extends Model{
    protected $table = "boutiques";

    public function createStore(array $data)
    {
        $title = htmlspecialchars($data["title"]);
        $description = nl2br(htmlentities($data["description"]));
        $profile_store = (new User($this->db))->image($_FILES["file"]["name"], $_FILES["file"]["tmp_name"], "store");
        if(is_array($profile_store)){
            $profile_store = null;
        }
        $user_id = $_SESSION["id"];
        $user_name = $_SESSION["pseudo"];

        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(title, description, image, user_id, own_name) VALUES(?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $profile_store, $user_id, $user_name]);
    }

    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    public function getCurtContent(): string
    {
        if(strlen($this->description) > 200){
            return substr($this->description, 0, 200).'...';
        }else{
            return $this->description;
        }   
    }
 
    public function getImage()
    {
        $tab = explode("market-online", $this->image);
        return "..".$tab[1];
        // var_dump("..".$tab[1]); die();
    }

    public function getIdOfStore()
    {
        $query = $this->db->getPDO()->query("SELECT * FROM {$this->table}");
        $result = $query->fetchAll();
        return $result;
    } 
}