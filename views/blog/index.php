<h2>Les derniers articles</h2>
<?php foreach($params["posts"] as $post):?>
    <div class="card mb-3">
        <div class="card-body">
            <p><?= $post->title; ?></p>
            <div>
            <?php foreach($post->getTag() as $tag):?>
                <span class="text-success"><a href="tags/<?= $tag->id ?>"><?= $tag->name ?></a></span>
            <?php endforeach ?>
            
            </div>
            <small class="text-info">Publié le <?=$post->getCreatedAt(); ?></small>
            <p><?= $post->getCurtContent(); ?></p>
            <?= $post->getButton() ?>
        </div>
    </div>
    <?php endforeach ?>
    
