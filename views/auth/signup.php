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
    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">S'inscrire</span></h1>
</div>
<form class="row g-3" action="/signup" method="POST" enctype="multipart/form-data">
  <div class="col-md-6">
    <label for="validationServer01" class="form-label">Full name</label>
    <input type="text" name="full_name" class="form-control" id="validationServer01" value="">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationServer02" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="validationServer02" value="">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationServerUsername" class="form-label">Username</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend3">@</span>
      <input type="text" name="username" class="form-control" id="validationServerUsername" aria-describedby="">
      <div id="validationServerUsernameFeedback" class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationServer03" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="passwordField" aria-describedby=""><br>
    <div style="position: relative;">
        <i class="text-success" id="togglePassword"  style="position: absolute; right:10px; top: 50%; transform:translateY(-50%); cursor:pointer">Voir</i>
    </div>
    
    <div id="passwordField" class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-12">
    <label for="validationServer04" class="form-label">Image</label>
    <input type="file" name="profile_image" accept="image/*" class="form-control" id="validationServer03" aria-describedby="">
    <div id="validationServer04Feedback" class="">
      Please select a valid file.
    </div>
  </div>
  
  <div class="col-12">
    <button class="btn btn-primary" type="submit">S'inscrire</button>
  </div>

  <h6>J'ai déjà un compte compte, je me <a href="/login" style="text-decoration: none; color:blue;">log</a></h6>
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