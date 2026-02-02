<?php if(isset($_GET["success"] )): ?>
    <div class="alert alert-success">
        <li><?= $_SESSION["success"] ?></li>
    </div>
<?php endif ?>
<?php unset($_SESSION["success"]);?>
<?php //if(isset($_SESSION["auth"]) == false): ?>
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
    <?php unset($_SESSION['errors']); ?>
<?php endif ?>
<?php if(isset($_SESSION['erreur'] )): ?>
    <div class="alert alert-danger">
        <li><?= $_SESSION['erreur'] ?></li>
    </div>
<?php endif ?>

<?php //session_destroy(); ?>

    <form class="container" action="/publication" method="POST" >
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Titre de la question </label>
            <input type="text" class="form-control" name="titre">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description de la question</label>
            <textarea type="text" class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contenu de la question</label>
            <textarea type="text" class="form-control" name="contenu"></textarea>
        </div>
       
        <button type="submit" class="btn btn-primary" >Publier la question</button>
       
    </form>          
<?php //endif ?>