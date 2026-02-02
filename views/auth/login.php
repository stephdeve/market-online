<?php if(isset($_SESSION['errors'])): ?>
    <?php foreach($_SESSION['errors']  as $errorsArray): ?>
        <?php foreach($errorsArray as $errors): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endif ?>
<?php if(isset($_SESSION['erreur'] )): ?>
    <div class="alert alert-danger">
        <li><?= $_SESSION['erreur'] ?></li>
    </div>
<?php endif ?>
<?php session_destroy(); ?>

<div class="text-center mb-5">
    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Connexion</span></h1>
</div>
<form action="/login" method="POST">
<div class="form-group mb-3">
      <label for="username" id="" class="form-label">Username</label>
      <input type=text" name="username" class="form-control" id="username" placeholder="">
    </div>
    
    <div class="form-group mb-3">
      <label for="password" id="" class="form-label">Password</label>
      <input type="password" id="passwordField" name="password" class="form-control" id="password" placeholder="">
    </div>
    
    <div style="position: relative;">
        <i class="text-success" id="togglePassword"  style="position: absolute; right:10px; top: 50%; transform:translateY(-50%); cursor:pointer">Voir</i>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
    <br><br>
    <h6>Je n'ai pas de compte, je <a href="/signup" style="text-decoration: none; color:blue;">m'inscris</a></h6>
</form>
<script>
    const passwordField = document.getElementById("passwordField");
    const togglePassword = document.getElementById("togglePassword");

    function change(){
        if(passwordField.type == "password"){
            passwordField.type = "text";
            togglePassword.textContent = "Masquer";
        }else{
            passwordField.type = "password";
            togglePassword.textContent = "Voir";
        }
    }

    togglePassword.addEventListener("click", change);

</script>