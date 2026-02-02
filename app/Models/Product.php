<?php
namespace App\Models;

use PDO;
use DateTime;
use Exception;
use App\Models\Model;

class Product extends Model{
    protected $table = "products";
    //Insertion
    public function insertProduct(array $data)
    {
        $title = htmlspecialchars($data["title"]);
        $description = nl2br(htmlentities($data["description"]));
        $description = str_replace("<br />", "", $description);
        $category_id = $data["category_id"];
        $store_id = $data["store_id"];
        $price = $data["price"];
        $is_for_trade = $data["choice"];
        $user_id = $_SESSION["id"];

        $stmt = $this->db->getPDO()->prepare("INSERT {$this->table}(user_id, title, description, category_id, price, is_for_trade, store_id) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $description,$category_id, $price, $is_for_trade, $store_id]);

        //traitement du fichier lié au produit
        $product_id = $this->db->getPDO()->lastInsertId();
        $file_type = $data["file_type"];
        // var_dump((int)$product_id, $file_type, $_FILES); die();
        $this->file($product_id, $file_type);
         // var_dump((int)$product_id, $file_type, $_FILES); die();
    }

    public function file(int $product_id, string $file_type)
    {
       
        //gestion du téléchargement de l'image de profile
        $target_dir = dirname(dirname(__DIR__))."/uploads/product-files/";
        $errors = [];
        //verifions si le dossier existe
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        //verification de l'existance du fichier
        if(!empty($_FILES["files"]["name"])){
            foreach($_FILES["files"]["name"] as $key => $filename){
                $target_file = $target_dir.basename($filename);
                $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                //detection du type de fichier
                $allowed_extension = ['image' => ['jpg', 'jpeg', 'png', 'gif'], 'pdf' => ['pdf'], 'video' => ['mp4', 'avi', 'mov']];
                $file_category = '';
                foreach($allowed_extension as $category => $extensions){
                    if(in_array($fileType, $extensions)){
                        $file_category = $category;
                        break;
                    }
                }
                if($file_category && move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)){
                    //Insertion de du fichier dans la table product_files
                    $stmt = $this->db->getPDO()->prepare("INSERT product_files(product_id, file_type, file_name) VALUES(?, ?, ?)");
                    return $stmt->execute([$product_id, $file_type, $filename]);
                }
            }
           
        }
    }

    //Updating
    public function updateProduct(int $id,  array $data)
    {
        $title = htmlspecialchars($data["title"]);
        $description = nl2br(htmlentities($data["description"]));
        $description = str_replace("<br />", "", $description);
        $category_id = $data["category_id"];
        $price = $data["price"];
        $is_for_trade = $data["choice"];

        $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET title = ?, description = ?, category_id = ?, price = ?, is_for_trade  = ? WHERE id = ?");
        $response1= $stmt->execute([$title, $description, $category_id, $price, $is_for_trade, $id]);

        //traitement du fichier lié au produit
        $product_id = $id;
        $file_type = $data["file_type"];
        // var_dump((int)$product_id, $file_type, $_FILES); die();
        $response2 = $this->file($product_id, $file_type);
        if($response1 == true || $response1 == null || $response2 == true || $response2 == null){
            return true;
        }
    }


    public function updateFile(int $product_id, string $file_type)
    {
       
        //gestion du téléchargement de l'image de profile
        $target_dir = dirname(dirname(__DIR__))."/uploads/product-files/";
        $errors = [];
        //verifions si le dossier existe
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        //verification de l'existance du fichier
        if(!empty($_FILES["files"]["name"])){
            foreach($_FILES["files"]["name"] as $key => $filename){
                $target_file = $target_dir.basename($filename);
                $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                //detection du type de fichier
                $allowed_extension = ['image' => ['jpg', 'jpeg', 'png', 'gif'], 'pdf' => ['pdf'], 'video' => ['mp4', 'avi', 'mov']];
                $file_category = '';
                foreach($allowed_extension as $category => $extensions){
                    if(in_array($fileType, $extensions)){
                        $file_category = $category;
                        break;
                    }
                }
                if($file_category && move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)){
                    //Insertion de du fichier dans la table product_files
                    $stmt = $this->db->getPDO()->prepare("UPDATE product_files SET file_type = :file_type, file_name = :file_name WHERE product_id = :product_id");
                    $stmt->execute([$file_type, $product_id]);
                }
            }
           
        }
    }
    
    public function allProduct(int $store_id, int $user_id, ?int $category_id=null)
    {
        if($category_id != null){
            $paginate = $this->paginationcat($category_id);
            $perPage = $paginate["perPage"];
            $pages = $paginate["pages"];
            $currentPage = $paginate["currentPage"];
            $offset = $paginate["offset"];
            $products = $this->query("SELECT * FROM {$this->table} WHERE category_id = ? ORDER BY id DESC", [$category_id]);
            $table = [
                "currentPage" => $currentPage,
                "pages" => $pages,
                "products" => $products
            ];
            return $table;
        }else{
            $paginate = $this->pagination();
            $perPage = $paginate["perPage"];
            $pages = $paginate["pages"];
            $currentPage = $paginate["currentPage"];
            $offset = $paginate["offset"];
            if(isset($_GET["search"]) && !empty($_GET["search"]))
            {
                $paginate = $this->pagination();
                $perPage = $paginate["perPage"];
                $pages = $paginate["pages"];
                $currentPage = $paginate["currentPage"];
                $offset = $paginate["offset"];
                //stockons la recherche effectuer par l'tilisateur dans une variable propres
                $getSearch = $_GET["search"];
                //affichons les resultats selon la recherche effectuer par l'utilisateur
                $products =$this->query('SELECT * FROM products WHERE title LIKE "%'.$getSearch.'%" ORDER BY id DESC');
                // var_dump($getSearch, $products); die();
                $table = [
                    "currentPage" => $currentPage,
                    "pages" => $pages,
                    "products" => $products
                ];
                return $table;
            }
            if($store_id == 0){
                $products = $this->query("SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY id DESC", [$user_id]);
            }else{
                $products = $this->query("SELECT * FROM {$this->table} WHERE store_id = ? AND user_id = ? ORDER BY id DESC  LIMIT $perPage OFFSET $offset", [$store_id, $user_id]);
            }
            $table = [
                "currentPage" => $currentPage,
                "pages" => $pages,
                "products" => $products
            ];
            return $table;
        }
        
       
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

    public function getImage(int $id)
    {
        $stmt = $this->query("SELECT * FROM product_files WHERE product_id = ?", [$id], true);
        $tab = explode("market-online", $stmt->file_name);
        return "..\..\uploads".DIRECTORY_SEPARATOR."product-files".DIRECTORY_SEPARATOR.$stmt->file_name;
        var_dump($stmt->file_name); die();
    }

    public function pagination()
    {
        //Gestion des paginations
        
        $page = $_GET["page"] ?? 1;
        if(!filter_var($page, FILTER_VALIDATE_INT)){
            throw new Exception("Le numero de page est invalide");
        }
        $currentPage = (int)$page; //si la valeur n'existe pas et si c'est egale à 0 on mettra 1
        if($currentPage <= 0){
            throw new Exception("Numero de page invalide !");
        };
   
        $count = (int)$this->db->getPDO()->query("SELECT COUNT(id) FROM {$this->table}")->fetch(PDO::FETCH_NUM)[0];
        $perPage = 3;
        $pages = ceil($count/$perPage);
        if($currentPage > $pages){
            throw new Exception("Cette page n'existe pas du tout");
        };
        $offset = $perPage * ($currentPage - 1);
        $table = [
            "currentPage" => $currentPage,
            "perPage" => $perPage,
            "offset" => $offset,
            "pages" => $pages
        ];
        return $table;
        // var_dump($currentPage); die();
        //fin gestion des paginations
    }

    public function paginationCat(?int $id)
    {
        //Gestion des paginations
        
        $page = $_GET["page"] ?? 1;
        if(!filter_var($page, FILTER_VALIDATE_INT)){
            throw new Exception("Le numero de page est invalide");
        }
        $currentPage = (int)$page; //si la valeur n'existe pas et si c'est egale à 0 on mettra 1
        if($currentPage <= 0){
            throw new Exception("Numero de page invalide !");
        };
   
        $stmt = $this->db->getPDO()->prepare("SELECT COUNT(id) FROM {$this->table} WHERE category_id = ?");
        $stmt->execute([$id]);
        $count = (int)$stmt->fetch(PDO::FETCH_NUM)[0];
        $perPage = 3;
        $pages = ceil($count/$perPage);
        if($currentPage > $pages){
            throw new Exception("Cette page n'existe pas du tout");
        };
        $offset = $perPage * ($currentPage - 1);
        $table = [
            "currentPage" => $currentPage,
            "perPage" => $perPage,
            "offset" => $offset,
            "pages" => $pages
        ];
        return $table;
        // var_dump($currentPage); die();
        //fin gestion des paginations
    }
}