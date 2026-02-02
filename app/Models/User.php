<?php
namespace App\Models;

use DateTime;
use App\Models\Model;
use PHPMailer\PHPMailer\PHPMailer;

class User extends Model{

    protected $table =  'users';

    public function  getByUsername(string $username, string $password = null)
    {
       
        $veri  = $this->verify($username, $password);
        // var_dump($veri); die();
        if($veri != null){
            //print_r($veri); die();
            return  $veri;
        }else{
            return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
        }
        
        
    }

    //fonction de vérification des champs
    private function verify(string $username, string $password)
    {
        $vrify = (int) 0;
        $array =  $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
        // var_dump($array); die();
        // foreach($array as $i){
        //     if($username != $i->username && password_verify($password, $i->password ) == false){
            
        //         $vrify = (int) 1;
        //         return $vrify;
        //     }elseif ($username == $i->username && password_verify($password, $i->password) == false) {
        //         $vrify = (int) 2;
        //         return $vrify;
        //     }elseif($username != $i->username && password_verify($password, $i->password) == true){
                
        //         $vrify = (int) 3;
        //         return $vrify;

        //     }
            //print_r($username, $i->username); die();
            
            
        //}
        if($array == false){
            return $array;
        }
        
    }

    public function signupUser(array $posts, array $file)
    {
       $veri = $this->verify($posts['username'], $posts['password']);
       if($veri != null){
            return $veri;
        }else{
            $username = htmlspecialchars($posts['username']);
            $email = htmlspecialchars($posts['email']);
            $checkIfUserAlreadyExist = $this->query("SELECT * FROM {$this->table} WHERE username = ? OR email = ?", [$username, $email], true) ? true: false;
            // var_dump($checkIfUserAlreadyExist); die();    
            if(!$checkIfUserAlreadyExist){
                $password = password_hash($posts['password'], PASSWORD_DEFAULT);//hachage du mot de pass
                $token = bin2hex(random_bytes(50));//Génération d'un jeton unique
                $full_name = htmlspecialchars($posts["full_name"]);
                // var_dump($_FILES); die();
                $profile_image = $this->image($_FILES["profile_image"]["name"], $_FILES["profile_image"]["tmp_name"], "profiles");//L'image de profile
                if(is_array($profile_image)){
                    $profile_image = null;
                }
                //insertion de l'utilisateur dans la base de donnée
                $stmt = $this->db->getPDO()->prepare("INSERT INTO users(username, email, password, full_name, picture_profile, token) VALUES(?, ?, ?, ?, ?, ?)");
                $result = $stmt->execute([$username, $email, $password, $full_name, $profile_image, $token]);
        
                if($result == true){
                    //$this->sendMailConfirmation($email, $username, $token);
                }else{
                    echo "Erreur de connexion base de données";
                }
            }else{
                return false;
            }
       }
        
    }


    public function image(string $image, string $tmp_image, string $dirname)
    {
        //gestion du téléchargement de l'image de profile
        $target_dir = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$dirname.DIRECTORY_SEPARATOR;
        $profile_image = null;
        $errors = [];
        //verifions si le dossier existe
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }
        if(!empty($image)){
            $target_file = $target_dir.basename($image);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //verifions si le fichier est une image
            $check = getimagesize($tmp_image);
            if($check !== false){
                //verifions l'exxttension du fichier
                $allowed_extension = ['jpg', 'jpeg', 'png', 'gif'];
                if(in_array($imageFileType, $allowed_extension)){
                    if(move_uploaded_file($tmp_image, $target_file)){
                        $profile_image = $target_file;
                        return $profile_image;
                    }else{
                        $errors[] = "Erreur lors du téléchargement";
                        return $errors;
                    }if(move_uploaded_file($tmp_image, $target_file)){
                        $profile_image = $target_file;
                        return $profile_image;
                    }else{
                        $errors[] = "Erreur lors du téléchargement";
                        return $errors;
                    }
                }else{
                    $errors[]  = "Cette extension n'est pas pris en charge";
                    return  $errors;
                }
                
            }else{
                $errors[] = "Le fichier n'est pas une image";
                return $errors;
            }
        }
    }
    public function confirmEmail(string $token)
    {
        if(isset($token)){
           $result = $this->db->getPDO()->query("SELECT * FROM users WHERE token={$token} AND is_verified=0");
            // $stmt->execute([]);
            // return $stmt->fetch();
            if($result->num_rows > 0){
                $sql = $this->db->getPDO()->query("UPDATE users SET is_verified = 1 WHERE token = {$token}");
                if($sql == TRUE){
                    echo "Votre compte a été vériefié avec succès.";
                }else{
                    echo "Erreur lors de la vérification du compte.";
                }
            }
        }
    }

    private function sendMailConfirmation(string $email, string $username, string $token)
    {
        $mail = new PHPMailer(true);
        try{
            //paramètre du serveur
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'stephanetossougbe2004@gmail.com';
            $mail->Password = 'Steven@2004';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            //Paramètre de l'e-mail
            $mail->setFrom('stephanetossougbe2004@gmail.com', 'market-online');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de l\'inscription:';
            $mail->Body = <<<HTML
            <p>Cliquez sur le lien suivant pour confirmer votre inscription :</p>
            <a href="http://market-online.test/confirm?token=$token" class="btn btn-primary">Confirmer l'inscription</a> 
        HTML;

        $mail->send();
        $success = "Un email de confirmation vous a été envoyé.";

        }catch(Exception $e){
            echo "Erreur lors de l'nvoi de l'email: {$mail->ErrorInfo}";
        }
    }

    public function getUserInfo(int $id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }
    
    public function getAllUsers()
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY id DESC");
    }

    public function getCreatedAt(): string
    {
        $month = [
            "01" => "January",
            "02" => "February",
            "03" => "March",
            "04" => "April",
            "05" => "May",
            "06" => "June",
            "07" => "Jully",
            "08" => "August",
            "09" => "September",
            "10" => "October",
            "11" =>  "November",
            "12" =>  "December"
        ];
        $date = explode("-", $this->created_at);
        $date1 = explode(" ", $date[2]);
        $jour = $date1[0];
        $hMinSec = $date1[1];
        $date2 = explode(":", $hMinSec);
        $heure = $date2[0];
        $min = $date2[1];
        $second = $date2[2];
        $mois = $month[$date[1]];
        $annee = $date[0];
        return ($mois." ".$jour.", ".$annee." à ".$heure."h ".$min."m ".$second."s");
    }

    public function userInformation(int $id)
    {
        $userInformation = $this->query("SELECT * FROM users WHERE id = ?", [$id], true);
        return $userInformation;
    }

    
    public function getImage(int $id)
    {
        $stmt = $this->query("SELECT * FROM users WHERE id = ?", [$id], true);
        $tab = explode("market-online", $stmt->picture_profile);
        //var_dump($tab); die();
        $file = explode("profiles/", $tab[1]);
        return "..\..\uploads".DIRECTORY_SEPARATOR."profiles".DIRECTORY_SEPARATOR.$file[1];
        //return $stmt->picture_profile;
        //var_dump($stmt->picture_profile); die();
    }

    public function userShop(int $user_id)
    {
        $user_shop = $this->query("SELECT * FROM boutiques WHERE user_id = ?", [$user_id]);
        return $user_shop;
    }
}

