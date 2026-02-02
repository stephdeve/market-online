<h1 class="text-center" >Editing product form</h1>
<form action="/update-product/<?= $params["product"]->id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="title" id="" class="form-label">Title</label>
      <input type=text" name="title" class="form-control" id="titre" placeholder="" value="<?= $params["product"]->title ?>">
    </div>
    <div class="form-group mb-3">
      <label for="content" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="content" rows="8"><?= $params["product"]->description ?></textarea>
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">Category ID</label>
        <select class="form-select" id="category_id" name="category_id">
            <?php foreach($params["results"] as $tag):?>
                <option value ="<?= $tag->id ?>" <?= ($params["product"]->category_id == $tag->id) ? 'selected': ''; ?>><?= $tag->name ?></option>
            <?php endforeach ?>
            
        </select>
    </div>

    <div class="form-group mb-3">
      <label for="price" id="" class="form-label">Price</label>
      <input type="number" step="0.01" name="price" class="form-control" id="price" placeholder="" value="<?= $params["product"]->price ?>">
    </div>
    
   <div class="form-group mb-3">
      <label for="choice" id="choice" class="form-label">Is for sale ?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="choice" value="on" <?= $params["product"]->is_for_trade  == "on" ? 'checked': ""; ?> id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
          Yes
        </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="choice" value="off" <?= $params["product"]->is_for_trade  == "off" ? 'checked': ""; ?> id="flexRadioDefault2">
          <label class="form-check-label" for="flexRadioDefault2">
            No
          </label>
      </div>
    </div>
    <br><br>
    <div class="form-group mb-3">
      <label for="file" id="" class="form-label">File</label><br>
      <label for="text" id="" class="form-label"><?= $params["product_file"]->file_name ?></label>
      <input type="file" name="files[]" multiple accept="image/*, video/*, pdf/*" class="form-control" id="file" placeholder="" value="<?= $params["product_file"]->file_name ?>">
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">File type</label>
        <select class="form-select" id="file_type" name="file_type">
            <?php foreach($params["results1"] as $row):?>
                <option value ="<?= $row ?>" <?= ($params["product_file"]->file_type == $row) ? 'selected': ''; ?>><?= ucfirst($row) ?></option>
            <?php endforeach ?>
            
        </select>
    </div><br>
    <button type="submit" class="btn btn-primary">Edit Product</button>
</form>
<br><br>

