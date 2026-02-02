<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
<h1 class="text-center text-success" >Administration des Questions</h1>
<?php if(isset($_GET["success"])): ?>
  <div class="alert-success">Vous êtes authentifiés</div>
<?php endif ?>
<br><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Titre</th>
      <th scope="col">Description</th>
      <th scope="col">Date de Publication</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($params["questions"] as $question): ?>
    <tr>
      <th scope="row"><?= $question->id ?></th>
      <td><?= $question->pseudo_auteur ?></td>
      <td><?= $question->titre ?></td>
      <td><?= $question->description ?></td>
      <td><?= $question->getCreatedAt() ?></td>
      <td>
      <form action="/admin/posts/destroy-question/<?= $question->id ?>" methode="POST" class="d-inline">
            <button id="btn1" type="submit" class="btn btn-danger">Supprimer</button>
        </form>
      </td>
    </tr>
    <?php endforeach ?>
    <td colspan="6" class="text-center"><a href="/admin/posts" class="btn btn-success my-3">Darhboard</a></td>
  </tbody>
</table>

<script>
  const btn1 = document.getElementById("btn1");
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
  console.log(confirm);
});
</script>