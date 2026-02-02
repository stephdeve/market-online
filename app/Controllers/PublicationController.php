<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Question;
use App\Models\Response;
use App\Models\ProductFiles;
use App\Validation\Validator;

class PublicationController extends Controller{
    
   public function createStore()
    {

        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        
        return $this->views('user-panel.creates.store');
    }

    public function storePost()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required'],
            'description' => ['required'],
            // 'file' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: /create-store");
            exit;
        }
        $creating = (new Store($this->getDB()))->createStore($_POST);
        if($creating){
            header("Location: /publication");
            exit;
        }
    }


    public function publication()
    {

        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        
        return $this->views('user-panel.create');
    }

    public function publicationCategory()
    {

        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        return $this->views('user-panel.creates.category');
        
    }
    
    public function createCategory()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'name' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: /publication/create-category");
            exit;
        }

        $result = (new Category($this->getDB()))->insertCategory($_POST);
        if($result){
            header("Location: /publication");
            exit;
        }

    }

    public function publicationProduct()
    {

        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        

        $results1 = (new ProductFiles($this->getDB()))->fileType();
        $results = (new Category($this->getDB()))->getIdOfCategories();
        $stores = (new Store($this->getDB()))->getIdOfStore();
        return $this->views('user-panel.creates.product', compact('results', 'results1', 'stores'));
    }

    public function createProduct()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required'],
            'description' => ['required'],
            // 'files' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: //publication/create-product");
            exit;
        }
        $creating = (new Product($this->getDB()))->insertProduct($_POST);
        if($creating){
            header("Location: /store");
            exit;
        }
    }

    

    public function publicationPost()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'titre' => ['required', 'min:3'],
            'contenu' => ['required']
        ]);

        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /publication');
            exit;
        }else{
            if(isset($_SESSION["id"]) && isset($_SESSION["pseudo"])){
                $id = $_SESSION["id"];
                $pseudo = $_SESSION["pseudo"];
                
                $question  = (new Question($this->getDB()))->insertQuestion($_POST, $id, $pseudo);
    
                if($question == true){
                    $success = "Votre question a été bien publiée !";
                    $_SESSION["success"] = $success;
                    header('Location: /publication?success=true');
                }
            }
        }
   
    }
    public function postAnswer(int $id)
    {
            $validator = new Validator($_POST);
            $errors = $validator->validate([
                'contenu' => ['required'],
            ]);
            if($errors){
                $_SESSION['errors'][] = $errors;
                header("Location: /article/$id");
                exit;
            }

            if(isset($_SESSION["id"]) && isset($_SESSION["pseudo"])){
                $id_auteur = $_SESSION["id"];
                $pseudo = $_SESSION["pseudo"];
                
                $answer  = (new Answer($this->getDB()))->insertAnswer($_POST, $id_auteur, $pseudo, $id);

                if($answer == true){
                    header("Location: /article/$id?success=true");
                }
            }
    }
       
    


    public function showAllStore()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $allStores = (new Store($this->getDB()))->all("created_at");
        $categories = $this->getCategory();
        return $this->views("blog.home", compact('allStores', 'categories'));

    }

    public function getStore(int $store_id, ?int $user_id=null)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        if((isset($store_id) && !empty($store_id)) && (isset($user_id) && !empty($user_id))){
            if(isset($_GET["category_id"])){
                $category_id = $_GET["category_id"];
                $products = (new Product($this->getDb()))->allProduct($store_id, $user_id, $category_id);
                $currentPage = $products["currentPage"];
                $pages = $products["pages"];
                $products = $products["products"];
                $categories = $this->getCategory();
                // $page = ($_GET["page"] ?? 1);
                // $currentPage = (int)$page;
                // var_dump($pages); die();
                $user_info = (new User($this->getDb()))->findById($user_id, "id");
                return $this->views("market.article", compact('products', 'user_info', 'currentPage', 'store_id', 'user_id', 'pages', 'categories'));
            }
            
            $products = (new Product($this->getDb()))->allProduct($store_id, $user_id);
            $currentPage = $products["currentPage"];
            $pages = $products["pages"];
            $products = $products["products"];
            $categories = $this->getCategory();
            // $page = ($_GET["page"] ?? 1);
            // $currentPage = (int)$page;
            // var_dump($pages); die();
            $user_info = (new User($this->getDb()))->findById($user_id, "id");
            return $this->views("market.article", compact('products', 'user_info', 'currentPage', 'store_id', 'user_id', 'pages', 'categories'));
        }else{
            return false;
        }
    }

    //Get by category name
    public function getBycategory(int $category_id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        if((isset($category_id) && !empty($category_id))){
            $products = (new Product($this->getDb()))->allProduct($category_id,);
            $currentPage = $products["currentPage"];
            $pages = $products["pages"];
            $products = $products["products"];
            $categories = $this->getCategory();
            $url = explode("/", $_GET["url"]);
            // if($url[0] == "store"){
            //     $user_id = (int)$url[2];
            //     $user_info = (new User($this->getDb()))->findById($user_id, "id");
            //     return $this->views("market.article", compact('products', 'user_info', 'currentPage', 'store_id', 'user_id', 'pages', 'categories'));
            // }
            // $page = ($_GET["page"] ?? 1);
            // $currentPage = (int)$page;
            // var_dump($pages); die();
            return $this->getStore($category_id);
            
        }else{
            return false;
        }
    }

    public function myQuestions()
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $id_user = $_SESSION["id"];
        $user_question = (new Question($this->getDB()))->afficheQuestionSpecific($id_user);

        if(count($user_question) > 0){
            
            return $this->views("market.myQuestion", compact('user_question'));
        }else{
            return false;
        }
    }

    public function editing(int $id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        if(isset($id) && !empty($id)){
            $user_id = $id;
            $products = (new Product($this->getDb()))->allProduct(0, $id);
            $products  = $products["products"];
            $categories = $this->getCategory();
            // var_dump($products); die();
            return $this->views("user-panel.creates.edite", compact('products', 'categories'));
        }else{
            return false;
        }
       
    }

    public function editProduct(int $id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        
        $results1 = (new ProductFiles($this->getDB()))->fileType();
        $results = (new Category($this->getDB()))->getIdOfCategories();
        $product = (new Product($this->getDB()))->findById($id, "id");
        $product_file = (new ProductFiles($this->getDB()))->findById($id, "product_id");
        return $this->views("market.edit-product", compact('results', 'results1', 'product', 'product_file'));
    }

    public function updateProduct(int $id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $updating = (new Product($this->getDB()))->updateProduct($id, $_POST);
        if($updating){
            header("Location: /editing/{$_SESSION['id']}");
            exit;
        }
    }

    public function deleteProduct(int $id)
    {
        // var_dump($id); die();
        $destroy_product = (new Product($this->getDB()))->destroy($id);
        header("Location: /editing/{$_SESSION['id']}");
    }

    //Function de traitement du profil d'un utilisateur donné.

    public function userProfile(int $id)
    {
        $user_info = (new User($this->getDB()))->userInformation($id);
        $user_shop = (new User($this->getDB()))->userShop($id);
        //var_dump($user_info, $user_shop); die();
        return $this->views("market.profile", compact('user_info', 'user_shop'));

    }

    public function readMore(int $id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        
        $product = (new Product($this->getDB()))->findById($id, "id");
        $product_file = (new ProductFiles($this->getDB()))->findById($id, "product_id");
        return $this->views("market.show", compact('product', 'product_file'));
    }
    
    //Gestion des commentaires des produits
    public function comments(int $product_id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $comments = (new Comment($this->getDB()))->getCommentByProduct($product_id);
        // $responses = (new Comment($this->getDB()))->getResponseByComment();
        // var_dump($responses); die();
        
        return $this->views("market.comment", compact('comments', 'product_id'));   
    }

    public function commentPost(int $product_id)
    {

        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'content' => ['required'],
            // 'file' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: /comment/$product_id");
            exit;
        }
        $creatingComment = (new Comment($this->getDB()))->insertComment($_POST, $product_id);
        if($creatingComment){
            header("Location: /comment/$product_id");
            exit;
        }
    }

    public function responsePost(int $comment_id, ?int $product_id = null)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'content' => ['required'],
            // 'file' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: /comment/$product_id");
            exit;
        }
        $creatingResponse = (new Response($this->getDB()))->insertResponse($_POST, $comment_id);
        if($creatingResponse){
            header("Location: /comment/$product_id");
            exit;
        }
    }

    public function discussion(int $id_product, int $user_id)
    {
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $messages = (new Message($this->getDB()))->getMessage($id_product, $user_id);
        return $this->views("market.discussion", compact('id_product', 'user_id', 'messages'));

    }

    public function discussionPost(int $id_product, int $user_id)
    {
        // var_dump($_POST); die();
        if(!isset($_SESSION["auth"])){
            $this->isLogin();
        }
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'content' => ['required'],
            // 'file' => ['required'],
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header("Location: /discussion/$product_id");
            exit;
        }
        $creatingMessage = (new Message($this->getDB()))->insertMessage($_POST, $id_product, $user_id,);
        if($creatingMessage){
            header("Location: /discussion/$id_product/$user_id");
            exit;
        }

    }
}