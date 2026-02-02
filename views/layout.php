<?php
  $urls = explode("/", $_GET["url"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php 
  use App\Controllers\Session\Compteur;
  if(session_status() === PHP_SESSION_NONE){
    session_start();
  } 
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market +</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/style.css">
    
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: black;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Market +</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/create-store">Create Store</a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="/my-question"></a> -->
        </li>
      </ul>
      <?php if($urls[0] == "store"): ?>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown"  aria-expanded="false">Category</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#!">Option</a></li>
              <li><hr class="dropdown-divider" /></li>
              <?php foreach($params['categories'] as $category): ?>
                  <li><a class="dropdown-item" href="/store/<?=$params["store_id"];?>/<?= $params["user_id"]; ?>?category_id=<?= $category->id ?>"><?= $category->name ?></a></li>
                <?php endforeach ?>
              <!-- <li><a class="dropdown-item" href="#!">Bags</a></li>
              <li><a class="dropdown-item" href="#!">Bagues</a></li> -->
            </ul>
          </li>
        </ul>
      <?php endif ?>
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown"  aria-expanded="false"><?= (isset($_SESSION["auth"])) ? ucfirst($_SESSION["pseudo"]): "" ?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#!">Option</a></li>
              <li><hr class="dropdown-divider" /></li>
              <!-- <li><a class="dropdown-item" href="#!">Bags</a></li>
              <li><a class="dropdown-item" href="#!">Bagues</a></li> -->
              <?php if(isset($_SESSION["auth"])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="/profile/<?= $_SESSION["id"]; ?>">Mon Profile</a>
                </li>
                <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"] == 1): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/posts">Admin</a>
                  </li>
                <?php endif ?>
                <li class="nav-item">
                  <a class="nav-link" href="/logout">Se déconnecter</a>
                </li>
              <?php endif ?>
            </ul>
          </li>

        <?php if(!isset($_SESSION["auth"])): ?>
          <li class="nav-item">
            <a class="nav-link" href="/login">Se Connecter</a>
          </li>
        <?php endif ?>

      </ul>
    </div>
  </div>
</nav>

</div>
<br>

<div class="container" style="">
        <form method="GET">
            <div class="form-group row">
                <div class="col-8">
                    <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search">    
                </div>
                <div class="col-4">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
    </div>
    <br>

  <div class="container"><?= $content ?></div>
    
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
