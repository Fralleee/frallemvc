<?php
  if(!empty($_POST))
  {
    Picture::UploadImage($_FILES["photo"]);
  }

  $images = DB::getInstance()->query("select * from pictures")->all();

?>

<div>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="photo" size="25" />
    <input type="submit" name="submit" value="Submit" />
  </form>
</div>

<br/>
<hr/>
<br/>

<?php if($images): ?>
  <?php foreach($images as $key => $image): ?>
    <?php 
      $source = $image->source;
      $base64 = $image->base64;
    ?>  
    <div>
        <img src="<?= $source; ?>" data-antimoderate-idata="<?= $base64; ?>" data-antimoderate-scale="20">
    </div> 
    <div>
        <img src="<?= $base64; ?>">
    </div> 
  <?php endforeach; ?>
<?php endif; ?>