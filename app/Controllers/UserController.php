<?php

namespace App\Controllers;
use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller{
    // Inscription
    public function signup()
    {
        return $this->views('auth.signup');
    }

    public function signupPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required'],
            'email' => ['required'],
            'full_name'=> ['required']
        ]);
        // var_dump($errors); die();
        if($errors){
            $_SESSION['errors'][] = $errors;
            // print_r($_SESSION['errors'][0]["username"]); die();
            // foreach($_SESSION['errors'] as $e){
            //     print_r($e);
            //     print_r("\n");
            // }
            // die();
            header('Location: /signup');
            exit;
        }

        
        $user = (new User($this->getDB()))->signupUser($_POST, $_FILES);

        if($user == 1){
            $erreur = "Le username et le password sont incorrects ...";
            $_SESSION['erreur'] = $erreur;
        }elseif($user == 2){
            $erreur = "Le password est incorrect ...";
            $_SESSION['erreur'] = $erreur;
        }elseif($user == 3){
            $erreur = "Le username est incorrect ...";
            $_SESSION['erreur'] = $erreur;
        }elseif($user == false){
            $erreur = "Cet utilisateur existe déjà.";
            $_SESSION['erreur'] = $erreur;
            header("Location: /signup");
        }else{
            $_SESSION["auth"] = (int) $user->is_admin;
            $_SESSION["auth1"] = True ;
            $_SESSION["id"] = $user->id;
            $_SESSION["pseudo"] = $user->username;
        }
        header("Location: /login");
    }
    //Confirmation et activation du compte
    public function confirm()
    {
        if(isset($_GET['token']))
        {
            $token = $_GET['token'];
            $confirmUser = (new User($this->getDB()))->confirmEmail($token);
        }
        
    }

    // Connexion de l'utilisateur
    public function login()
    {
        return $this->views('auth.login');
    }

    public function loginPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);
        // var_dump($errors); die();
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }
        //var_dump($_POST['username'], $_POST['password']); die();
        $user = (new User($this->getDB()))->getByUsername($_POST["username"], $_POST["password"]);
        // var_dump($user); die();
        if($user == false){
            $erreur = "Le username et le password sont incorrects ... Cet utilisateur n'existe pas";
            $_SESSION['erreur'] = $erreur;
        }
        // if($user == (int) 1){
        //     $erreur = "Le username et le password sont incorrects ...";
        //     $_SESSION['erreur'] = $erreur;
        // }elseif($user == (int) 2){
        //     $erreur = "Le password est incorrect ...";
        //     $_SESSION['erreur'] = $erreur;
        // }elseif($user == (int) 3){
        //     $erreur = "Le username est incorrect ...";
        //     $_SESSION['erreur'] = $erreur;
        // }
        // var_dump($_POST["username"], $_POST["password"], password_verify($_POST['password'], $user->password), $user); die();
        if(password_verify($_POST['password'], $user->password))
        {
            // var_dump($this->session->setAuth('auth', $user->is_admin));die();
            $this->session->setKey1('id', $user->id);
            $this->session->setKey2('pseudo', $user->username);
            $this->session->setAuth('auth', $user->is_admin);
            $_SESSION['auth'] = $this->session->getAuth('auth');
            $_SESSION["id"] = $this->session->getKey1('id');
            // $_SESSION["auth"] = (int) $user->is_admin;
            // $_SESSION["auth1"] = True ;
            // $_SESSION["id"] = $user->id;
            // $_SESSION["pseudo"] = $user->username;
            //return header("Location: /admin/posts?success=true");
        //    print_r("1",  $this->session->setKey1('id', $user->id)); die();
            
            return header("Location: /?success=true");

        }else{
            //Svar_dump(password_verify($_POST['password'], $user->password));
            return header("Location: /login");
        }

    }
    // Déconnexion de l'utilisateur
    public function logout()
    {
        session_destroy();
        return header("Location: /login");
    }


    public function ajouter_vue(){
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur';
        $fichier_journalier = $fichier.'-'.date('y-m-d');
        increment_compteur($fichier);
        incremant_compteur($fichier_journalier);
    
    }

    public function increment_compteur(string $fichier){
        $compteur = 1;
        if(file_exists($fichier)){
            $compteur = (int)file_get_contents($fichier);
            $compteur++;
        }
        file_put_contents($fichier, $compteur);
    }

    public function nombre_vue(){
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur';
        return file_get_contents($fichier);
    }
    
}   