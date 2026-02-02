<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
<h1 class="text-center text-success" >Administration des Utilisateurs</h1>
<?php if(isset($_GET["success"])): ?>
  <div class="alert-success">Vous êtes authentifiés</div>
<?php endif ?>
<br><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">username</th>
      <th scope="col">Password</th>
      <th scope="col">Est vérifié ?</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($params["users"] as $user): ?>
    <tr>
      <th scope="row"><?= $user->id ?></th>
      <td><?= $user->username ?></td>
      <td><?= $user->password ?></td>
      <td><?= $user->is_verified ?></td>
      <td>
      <?php if($user->is_admin == 1): ?>
        <form action="" methode="POST" class="d-inline">
            <button type="submit" class="btn btn-danger">Undeleted</button>
          </form>
      <?php endif ?>

      <?php if($user->is_admin == 0): ?>
        <form action="/admin/posts/destroy/<?= $user->id ?>" methode="POST" class="d-inline">
            <button id="btn1" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
      <?php endif ?>
      </td>
    </tr>
    <?php endforeach ?>
    <td colspan="5" id = "d" class="text-center" ><a href="/admin/posts" class="btn btn-success my-3">Darhboard</a></td>
  </tbody>
</table>

<script>
  const btn1 = document.getElementById("d");
  // btn1.onclick = function(){
  //   confirm("Voulez vous vraiment passer à côté ?");
  //   let vr = confirm("Voulez vous vraiment passer à côté ?");
  //   let a = `<p> cc </p>`;
  //   console.log(a);
  // }
  btn1.addEventListener('click', (e)=>{
  let confirm = confirm("Voulez vous vraiment supprimer");
  if(!confirm){
    e.preventDefault();
  }
  console.log(a);
});
</script>