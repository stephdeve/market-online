<?php foreach($params['user_question'] as $question): ?>
    <div class="card">
        <div class="card-header text-center">
            <a href="/article/<?=$question->id;?>" style="text-decoration: none"><?= $question->titre;?></a>
        </div>
        <div class="card- text-center">
            <p class="text-text">
                <?= $question->description;?>
            </p>
            <div class="row text-center">
            <div class="col-md-4 py-4">
                <a href="/article/<?=$question->id;?>" class="btn btn-primary">Accéder à la question</a>
            </div>
            <div class="col-md-4 py-4"><a href="/edit-question/<?=$question->id;?>" class="btn btn-warning">Modifier la question</a></div>
            <div class="col-md-4 py-4">
                <form action="/delete/<?= $question->id ?>" methode="POST" class="d-inline">
                    <button type="submit" class="btn btn-danger">Supprime la questionr</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <br>
<?php endforeach ?>