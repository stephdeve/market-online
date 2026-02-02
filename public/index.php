<?php

use Router\Router;
use App\Exception\NotFoundException;
require "../vendor/autoload.php";

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
// les données de la connexion
define('DB_NAME', 'market-online');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PWD', '');
// var_dump($_GET['url']); die();
$router = new Router($_GET["url"]);

// $router->get("/", "App\Controllers\BlogController@home");//la fonction index de la class BlogController
// $router->get("/posts", "App\Controllers\BlogController@index");
// $router->get("/posts/:id", "App\Controllers\BlogController@show");
// $router->get("/tags/:id", "App\Controllers\BlogController@tag");

$router->get("/signup", "App\Controllers\UserController@signup");
$router->post("/signup", "App\Controllers\UserController@signupPost");
$router->post("/confirm", "App\Controllers\UserController@confirm");
$router->get("/login", "App\Controllers\UserController@login");
$router->post("/login", "App\Controllers\UserController@loginPost");
$router->get("/logout", "App\Controllers\UserController@logout");

$router->get("/", "App\Controllers\PublicationController@showAllStore");
$router->get("/store/:store_id/:user_id", "App\Controllers\PublicationController@getStore");
$router->get("/editing/:user_id", "App\Controllers\PublicationController@editing");
$router->get("/edit-product/:id", "App\Controllers\PublicationController@editProduct");
$router->get("/readmore-product/:id", "App\Controllers\PublicationController@readMore");
$router->post("/update-product/:id", "App\Controllers\PublicationController@updateProduct");
$router->post("/destroy-product/:id", "App\Controllers\PublicationController@deleteProduct");
$router->get("/create-store", "App\Controllers\PublicationController@createStore");
$router->post("/create-store", "App\Controllers\PublicationController@storePost");
$router->get("/comment/:id", "App\Controllers\PublicationController@comments");
$router->post("/comment/:id", "App\Controllers\PublicationController@commentPost");
$router->post("/comment-response/:comment_id/:product_id", "App\Controllers\PublicationController@responsePost");
$router->get("/category/:id", "App\Controllers\PublicationController@getByCategory");

$router->get("/discussion/:id_product/:user_id", "App\Controllers\PublicationController@discussion");
$router->post("/discussion/:id_product/:user_id", "App\Controllers\PublicationController@discussionPost");

$router->get("/publication", "App\Controllers\PublicationController@publication");
$router->post("/publication", "App\Controllers\PublicationController@publicationPost");
$router->get("/publication/create-category", "App\Controllers\PublicationController@publicationCategory");
$router->get("/publication/create-product", "App\Controllers\PublicationController@publicationProduct");
$router->get("/publication/create-product-file", "App\Controllers\PublicationController@publicationProductFile");
$router->post("/publication/create-category", "App\Controllers\PublicationController@createCategory");
$router->post("/publication/create-product", "App\Controllers\PublicationController@createProduct");


$router->get("/article/:id", "App\Controllers\PublicationController@showOnePub");
$router->post("/answer/:id", "App\Controllers\PublicationController@postAnswer");
$router->get("/my-question", "App\Controllers\PublicationController@myQuestions");
$router->get("/edit-question/:id", "App\Controllers\PublicationController@editQuestion");
$router->post("/edit-question/:id", "App\Controllers\PublicationController@updateQuestion");
$router->get("/delete/:id", "App\Controllers\PublicationController@deleteQuestion");
$router->get("/profile/:id", "App\Controllers\PublicationController@userProfile");

$router->get("/admin/posts", "App\Controllers\admin\PostController@indexAdmin");
$router->get("/admin/posts/user", "App\Controllers\admin\PostController@user");
$router->post("/admin/posts/destroy/:id", "App\Controllers\admin\PostController@destroy");
$router->get("/admin/posts/question", "App\Controllers\admin\PostController@questions");
$router->get("/admin/posts/destroy-question/:id", "App\Controllers\admin\PostController@destroyQuestion");
$router->post("/admin/posts/create", "App\Controllers\admin\PostController@createPost");
$router->get("/admin/posts/edit/:id", "App\Controllers\admin\PostController@edit");
$router->post("/admin/posts/edit/:id", "App\Controllers\admin\PostController@update");
try{
    $router->run();
}catch(NotFoundException $e){
    echo $e->error404();
}
