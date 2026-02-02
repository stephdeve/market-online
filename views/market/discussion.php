<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css"> 
<link rel="stylesheet" href="../../public/assets/style.css">
<div class="container mt-5">
    <div class="row">
        <?php foreach($params["messages"] as $message): ?>
            

                <div class="row">
                <div class="col-lg-6 mb-4" >
                <div class="row align-items-center gx-5">
                    <div class="">
                        <div class="bg-light p-4 rounded-4" >
                            <div class="text-primary fw-bolder mb-2"><a href="store/<?php;?>" style="text-decoration: none; color:blue;"><?php ?></a> </div>
                            <?php if($message->receiver_id == $_SESSION["id"]): ?>
                                <div class="small fw-bolder"><?= $message->content?></div>
                            <?php elseif($message->receiver_id == $params["user_id"]): ?>
                                <div class="small fw-bolder" style="color: green; "><?= $message->content?></div>
                            <?php endif ?>
                            <div class="small text-muted"><?php ?></div>
                            <div class="small text-muted"><?php ?></div>
                        </div>
                        
                    </div>
                </div>
                </div>
                </div><br><br>
                <!-- Side widgets-->
                

        
        <?php endforeach ?>
        <form class="mb-4" action="/discussion/<?= $params["id_product"]; ?>/<?= $params["user_id"] ?>" method="POST">
            <textarea class="form-control" name="content" rows="3" placeholder="Join your comment!"></textarea>
            <!-- <input type="hidden" value="<?php //$_GET['url'] ?>" class="form-control" name="id"> -->
            <br>
            <button type="submit" class="btn btn-primary">Send →</button>
        </form>l
    </div>
</div>
<script src="../../public/assets/js/bootstrap.bundle.min.js"></script>