<!-- <link rel="stylesheet" href="../../public/assets/style.css"> -->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <!-- Post content-->
            <article>
                <figure class="mb-4"><img class="img-fluid rounded" src="<?= $params["product"]->getImage($params["product"]->id) ?>" alt="..." /></figure>
            </article>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-6">
        <div class="card mb-4">
            <?php if($params["product"]->is_for_trade === 'on'):?>
                <div class="badge bg-dark text-white position-absolute choice" style="top: 0.5rem; right: 0.5rem;">Sale</div>
            <?php else: ?>
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 50px">Trade</div>
                <?php endif ?>
                <!-- <a href="#!"><img class="card-img-top im1" src="<?php //$params["product"]->getImage($params["product"]->id) ?>" alt="..." /></a> -->
            <div class="card-body">
                <div class="small text-muted"><?= $params["product"]->getCreatedAt() ?></div>
                <h2 class="card-title h4"><?= $params["product"]->title ?></h2>
                <p class="card-text"><?= $params["product"]->description ?></p>
                <a class="btn btn-primary" href="/store/<?= $params["product"]->store_id; ?>/<?= $params["product"]->user_id; ?>">Go to back →</a>
                <a class="btn btn-success" href="/discussion/<?= $params["product"]->id; ?>/<?= $params["product"]->user_id ?>">Discusion →</a>
                <a class="btn btn-primary" href="/comment/<?= $params["product"]->id ?>">Comment →</a>
            </div>
        </div>
        </div>
    </div>
</div>

