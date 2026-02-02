<h1 class="text-center" >Creating product form</h1>
<form action="/publication/create-product" method="POST" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="title" id="" class="form-label">Title</label>
      <input type=text" name="title" class="form-control" id="titre" placeholder="" value="">
    </div>
    <div class="form-group mb-3">
      <label for="content" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="content" rows="8"></textarea>
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">Category ID</label>
        <select class="form-select" id="category_id" name="category_id">
            <?php foreach($params["results"] as $tag):?>
                <option value ="<?= $tag->id ?>"><?= $tag->name ?></option>
            <?php endforeach ?>
            
        </select>
    </div>
    <br>
    <div class="form-control">
        <label for="tags" class="form-label">Store</label>
        <select class="form-select" id="store_id" name="store_id">
            <?php foreach($params["stores"] as $tag):?>
                <option value ="<?= $tag->id ?>"><?= $tag->title ?></option>
            <?php endforeach ?>
            
        </select>
    </div>

    <div class="form-group mb-3">
      <label for="price" id="" class="form-label">Price</label>
      <input type="number" step="0.01" name="price" class="form-control" id="price" placeholder="" value="">
    </div>
    
   <div class="form-group mb-3">
      <label for="choice" id="choice" class="form-label">Is for sale ?</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="choice" value="on" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
          Yes
        </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="choice" value="off" id="flexRadioDefault2">
          <label class="form-check-label" for="flexRadioDefault2">
            No
          </label>
      </div>
    </div>
    <br><br>
    <div class="form-group mb-3">
      <label for="file" id="" class="form-label">File</label>
      <input type="file" name="files[]" multiple accept="image/*, video/*, pdf/*" class="form-control" id="titre" placeholder="" value="">
    </div>
    <div class="form-control">
        <label for="tags" class="form-label">File type</label>
        <select class="form-select" id="file_type" name="file_type">
            <?php foreach($params["results1"] as $row):?>
                <option value ="<?= $row ?>"><?= ucfirst($row) ?></option>
            <?php endforeach ?>
            
        </select>
    </div><br>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
<br><br>