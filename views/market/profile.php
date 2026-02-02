<div class="card">
    <div class="card-body">
    <article class="">
        <?php //var_dump($params['user_info']->getImage($params['user_info']->id)); die(); ?>
    <figure class="mb-4"><img class="img-fluid rounded profile" src="<?= $params['user_info']->getImage($params['user_info']->id) ?>" alt="..." /></figure>
    </article>
        <h4>@<?= $params['user_info']->username; ?></h4>
        <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 me-3"><i class="bi bi-code-slash"></i></div>
        <hr>
        <p><?= $params['user_info']->username.' '.$params['user_info']->username; ?></p>
    </div>
</div>
<br><br>
<div class="card shadow border-0 rounded-4 mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center gx-5">
        <div class="text-center"><div>Mes Boutiques</div></div>
        </div>
    </div>
</div>

<?php foreach($params['user_shop'] as $info): ?>
<div class="card shadow border-0 rounded-4 mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center gx-5">
        
            <div class="col text-center text-lg-start mb-4 mb-lg-0">
                <div class="bg-light p-4 rounded-4">
                    <div class="text-primary fw-bolder mb-2"><?= $info->title;?></div>
                    <div class="small fw-bolder text-end">Crée le <?= $info->getCreatedAt(); ?> </div>
                    <!-- <div class="small text-muted"><?php // $question->pseudo_auteur; ?></div>
                    <div class="small text-muted"><?php  //s$question->pseudo_auteur; ?></div> -->
                </div>
            </div>
            
        </div>
    </div>
</div>
<br>
<?php endforeach ?>

<?php //foreach($params['user_questions'] as $question): ?>
    <!-- <div class="card">
        <div class="card-header">
            <?php //$question->titre?>
        </div>
        <div class="card-body text-center">
            <?php//$question->description; ?>
        </div>
        <div class="card-footer text-end">
            Par <?php//$question->pseudo_auteur; ?> le <?php //$question->getCreatedAt(); ?>
        </div>
    </div>
    <br> -->
<?php //endforeach ?>