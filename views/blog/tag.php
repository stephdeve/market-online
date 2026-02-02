<h2><?= $params["tag"]->name ?></h2>
<?php foreach($params["tag"]->getPosts() as $post):?>
    <div class="card mb-3">
        <div class="card-body">
            <span class="text-success"><a href="/posts/<?= $post->id ?>"><?= $post->title ?></a></span>
            </div>
        </div>
    </div>
<?php endforeach ?>
    
