<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css"> 
<link rel="stylesheet" href="../../public/assets/style.css">
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">Welcome to <?= ucfirst($params["user_info"]->username); ?> Market +!</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Created on <?= $params["user_info"]->getCreatedAt();?> by <?= $params["user_info"]->username;?> </div>
                    <!-- Post categories-->
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded-circle" src="1.jpg" alt="..." /></figure>
            </article>
        </div>
        <?php if($params["user_info"]->id == $_SESSION["id"]): ?>
        <!-- Side widgets-->
        <div class="col-lg-4">
        <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
            <div class="card-header">Actions</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="/">Acceder</a></li>
                                <li><a href="/editing/<?= $_SESSION["id"]; ?>">Editer</a></li>
                                <li><a href="/publication">Créer</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>

<!-- listing of products -->
<div class="container mt-5">
    <div class="row">
        <?php foreach($params["products"] as $product): ?>
        <div class="col-md-6 col-lg-6">
                                <!-- Blog post-->
            <div class="card mb-4">
                <?php if($product->is_for_trade === 'on'):?>
                    <div class="badge bg-dark text-white position-absolute choice" style="top: 0.5rem; right: 0.5rem; color: green"><?= $product->price ?>$</div>
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 50px">Sale</div>
                <?php else: ?>
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 50px">Trade</div>
                <?php endif ?>
                <article>
                <figure class="mb-4"><img class="img-fluid rounded" src="<?= $product->getImage($product->id) ?>" alt="..." /></figure>
                </article>
                <!-- <a href="#!"><img class="card-img-top im1" src="<?php //$product->getImage($product->id) ?>" alt="..." /></a> -->
                <div class="card-body">
                    <div class="small text-muted"><?= $product->getCreatedAt() ?></div>
                    <h2 class="card-title h4"><?= $product->title ?></h2>
                    <p class="card-text"><?= $product->getCurtContent() ?>.</p>
                    <a class="btn btn-primary" href="/readmore-product/<?= $product->id ?>">Read more →</a>
                    <a class="btn btn-success" href="/discussion/<?= $product->id; ?>/<?= $product->user_id ?>">Discusion →</a>
                    <a class="btn btn-primary" href="/comment/<?= $product->id ?>">Comment →</a>
                </div>
            </div>
            <!-- Blog post-->
        </div>
        <?php endforeach ?>
        <!-- <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="badge bg-dark text-white position-absolute choice" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 50px">Trade</div>
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title h4">Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                    <a class="btn btn-success" href="#!">Discusion →</a>
                    <a class="btn btn-primary" href="#!">Comment →</a>
                </div>
            </div>
        </div> -->
       
    </div>
    <div class="d-flex justify-content-between my-4">
         <?php if($params["currentPage"] > 1): ?>
            <a href="/store/<?= $params["store_id"] ?>/<?= $params["user_id"] ?>?page=<?= $params["currentPage"] - 1; ?>" class="btn btn-primary">&laquo; Page Précédente</a>
         <?php endif ?>
         <?php if($params["currentPage"] < $params["pages"]): ?>
            <a href="/store/<?= $params["store_id"] ?>/<?= $params["user_id"] ?>?page=<?= $params["currentPage"] + 1; ?>" class="btn btn-primary m-auto">Page Suivante &raquo;</a>
         <?php endif ?>
    </div>
</div>
<script src="../../public/assets/js/bootstrap.bundle.min.js"></script>