<?php 
  use App\Controllers\Session\Compteur;
?>
<div class="col-md-4 m-auto" style="background-color: #124efe;>
<div class="card">
  <div class="card-body text-center" style="color:white;">
    <?php
      $compteur = new Compteur(dirname(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur');
      $compteur->increment_vue();
      $vue = $compteur->nombre_vue();
    ?>
    Il ya <?= $vue ?> visite<?= $vue > 1 ?"s":"" ;?> sur le site
  </div>
</div>
</div>
<br>
<h1 class="text-center" >Administration des Utilisateurs</h1>
<?php if(isset($_GET["success"])): ?>
  <div class="alert-success">Vous êtes authentifiés</div>
<?php endif ?>
<h3 class="text-center" ><a href="" class="btn btn-success my-3 text-center">Tables</a></h3>

<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Users</th>
      <th scope="col">Questions</th>
    </tr>
  </thead>
  <tbody>
   <?php //foreach($params["posts"] as $post): ?>
    <tr>
      <td><a href="/admin/posts/user" class="btn btn-success my-3">Users</a></td>
      <td><a href="/admin/posts/question" class="btn btn-success my-3">Questions</a></td>
      <td>
      </td>
    </tr>
    <?php //endforeach ?>
  </tbody>
</table>