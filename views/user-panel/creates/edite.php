<link rel="stylesheet" href="../../../public/assets/css/bootstrap.min.css"> 
<link rel="stylesheet" href="../../../public/assets/style.css">
<div class="container mt-5">
    <div class="row">
        <?php foreach($params["products"] as $product): ?>
        <div class="col-md-6 col-lg-6">
                                <!-- Blog post-->
            <div class="card mb-4">
                <?php if($product->is_for_trade === 'on'):?>
                    <div class="badge bg-dark text-white position-absolute choice" style="top: 0.5rem; right: 0.5rem"><?= $product->price ?>$</div>
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
                    <h2 class="card-title h4"><?= $product->title ?> <?= $product->id ?></h2>
                    <p class="card-text"><?= $product->getCurtContent() ?>.</p>
                    <a class="btn btn-success" href="/store/<?=$product->store_id;?>/<?=$product->user_id;?>">Go back →</a>
                    <a class="btn btn-warning" href="/edit-product/<?= $product->id ?>" onclick="alert('Editing');">Edit →</a>
                    <!-- <form action="destroy-product/<?php //$product->id ?>" method="POST" class="d-inline">
                        <button id="btn1" type="submit" class="btn btn-danger">Remove →</button>
                    </form> -->
                    <a href="#"  class="btn btn-danger"
                                onclick="event.preventDefault;
                                let cfm = confirm('Voulez-vous vraiment supprimer ?');
                                if(cfm){
                                    document.getElementById('form').submit();
                                }">Remove →
                        <form action="/destroy-product/<?= $product->id ?>" method="POST" class="d-inline" id="form">

                        </form>
                </a>
                </div>
            </div>
            <!-- Blog post-->
        </div>
        <?php endforeach ?>
        <div class="col-md-6 col-lg-6">
            <div class="card mb-4">
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 50px">Trade</div>
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title h4">Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                    <a class="btn btn-success" href="#!">Go back →</a>
                    <a class="btn btn-warning" href="#!">Edit →</a>
                    <a class="btn btn-danger" href="#!">Remove →</a>
                </div>
            </div>
        </div>
    </div>
</div>
