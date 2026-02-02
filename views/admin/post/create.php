<h1>Formulaire de création d'article</h1>
<form action="/admin/posts/create" method="POST">
    <div class="form-group mb-3">
      <label for="title" id="" class="form-label">Titre de l'article</label>
      <input type=text" name="title" class="form-control" id="titre" placeholder="" value="">
    </div>
    <div class="form-group mb-3">
      <label for="content" class="form-label">Contenu</label>
      <textarea class="form-control" name="content" id="content" rows="8"></textarea>
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">Tags de l'article</label>
        <select multiple class="form-select" id="tags" name="tags[]">
            <?php foreach($params["tags"] as $tag):?>
                <option value ="<?= $tag->id ?>"><?= $tag->name ?></option>
            <?php endforeach ?>
            
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Créer l'article</button>
</form>
