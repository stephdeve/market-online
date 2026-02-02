<?php
namespace App\Models;

use App\Models\Model;

class Category extends Model{
    protected $table = "categories";

    public function insertCategory(array $data)
    {
        $name = htmlspecialchars($data["name"]);
        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(name) VALUES(?)");
        return $stmt->execute([$name]);
    }
    public function getIdOfCategories()
    {
        $query = $this->db->getPDO()->query("SELECT * FROM {$this->table}");
        $result = $query->fetchAll();
        return $result;
    } 
}