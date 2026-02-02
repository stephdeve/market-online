<h1>Formulaire d'édition d'article n°<?= $params["post"]->id ?></h1>
<form action="/admin/posts/edit/<?= $params["post"]->id ?>" method="POST">
    <div class="form-group mb-3">
        <label for="title" id="" class="form-label">Titre de l'article</label>
        <input type=text" name="title" class="form-control" id="titre" placeholder="" value="<?= $params["post"]->title ?>">
    </div>
    <div class="form-group mb-3">
    <label for="content" class="form-label">Contenu</label>
        <textarea class="form-control" name="content" id="content" rows="8"><?= $params["post"]->content ?></textarea>
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">Tags de l'article</label>
        <select multiple class="form-select" id="tags" name="tags[]">
            <?php foreach($params["tags"] as $tag):?>
                <option value ="<?= $tag->id ?>" 
                <?php foreach($params["post"]->getTag() as $postTag ){
                        echo (($tag->id  === $postTag->id) ? "selected": "");
                    } 
                ?>><?= $tag->name ?></option>
            <?php endforeach ?>
            
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>
