<?php
namespace App\Controllers;

use App\Models\Category;
use Database\DBConnexion;
use App\Controllers\Session\Session;

 abstract class Controller{
    protected $db;
    protected $session;
    public $idUser;
    public $pseudo;
    public $sesions;
    public function __construct(DBConnexion $db){
        $this->session = new Session();
        
        // var_dump($this->session->isLogIn()); die();
        // if($this->session->isLogIn() == false){
        //     header("Location: /login");
        //     exit;
        // }
        // if(session_status() === PHP_SESSION_NONE){
        //     session_start();
            
        // }
    
        $this->db = $db;
        $categories = (new Category($this->getDB()))->all("id");
        $this->sessions = $categories;
        // var_dump($this->session); die();
    }

    public function getCategory()
    {
        return $this->sessions;
    }
    protected function  views(string $path, array $params=null)
    {
        ob_start();
        $path = str_replace(".", DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        // if($params){
        //     $params = extract($params);
        // }

        $content = ob_get_clean();
        require VIEWS.'layout.php';
    }

    protected function getDB()
    {
        return $this->db;
    }

    protected function isAdmin()
    {
        if(isset($_SESSION["auth"]) && $_SESSION["auth"] === 1)
        {
            return true;
        }else{

            return  header("Location: /login");
        }
    } 

    
    protected function isLogin()
    {
        if(isset($_SESSION["auth"]) && $_SESSION["auth"] === 0)
        {
            return true;
        }else{

            return  header("Location: /login");
        }
    } 
}
