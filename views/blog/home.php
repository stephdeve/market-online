
<div class="text-center mb-5">
    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Posted</span></h1>
</div>
    
<?php //foreach($params["allPub"] as $pub):?>
    <!-- <div class="card">
        <div class="card-header text-start">
            <a href="article/<?php //$pub->id;?>" style="text-decoration: none; color:blue;"><?php //$pub->titre;?></a> 
        </div>
        <div class="card-body text-center">
            <?php //$pub->getCurtContent();?>
        </div>
        <div class="card-footer text-end">
            Publié par <a href="/profile/<?php //$pub->id_auteur; ?>" style="text-decoration: none"> <?php //$pub->pseudo_auteur;?></a> le  <?php //$pub->getCreatedAt();?>
        </div>
    </div>
    <br><br> -->
<?php //endforeach ?>

<?php foreach($params['allStores'] as $store): ?>
<div class="card shadow border-0 rounded-4 mb-5">
    <div class="card-body p-5">
        <div class="row text-center">
            <div class="align-items-center">
                <a href="/store/<?=$store->id;?>/<?= $store->user_id; ?>"><img src="<?= $store->getImage() ?>" class="rounded-circle im" alt="..."></a>
            </div>
        </div>
        
        <div class="row align-items-center gx-5">
            <div class="col text-center text-lg-start mb-4 mb-lg-0">
                <div class="bg-light p-4 rounded-4">
                    <div class="text-primary fw-bolder mb-2"><a href="store/<?=$store->id;?>/<?= $store->user_id; ?>" style="text-decoration: none; color:blue;"><?= $store->title;?></a> </div>
                    <div class="small fw-bolder">Crée par <?= $store->own_name; ?> le <?= $store->getCreatedAt(); ?> </div>
                    <div class="small text-muted"><?= $store->own_name; ?></div>
                    <div class="small text-muted"><?= $store->own_name; ?></div>
                </div>
            </div>
            <div class="col-lg-8"><div><?= $store->getCurtContent(); ?>.</div></div>
        </div>
    </div>
</div>
<br><br>
<?php endforeach ?>