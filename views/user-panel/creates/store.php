<h1 class="text-center" >Creating Store form</h1>
<form action="/create-store" method="POST" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <label for="title" id="" class="form-label">Store Name</label>
      <input type=text" name="title" class="form-control" id="titre" placeholder="" value="">
    </div>
    <div class="form-group mb-3">
      <label for="content" class="form-label">Store Description</label>
      <textarea class="form-control" name="description" id="content" rows="8"></textarea>
    </div>
    <div class="form-group mb-3">
      <label for="file" id="" class="form-label">Store Profile</label>
      <input type="file" name="file" accept="image/*" class="form-control" id="titre" placeholder="" value="">
    </div><br>
    <button type="submit" class="btn btn-primary">Create Store</button>
</form>
<br><br>