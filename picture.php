<?php
  require_once "core/init.php";
  if(!empty($_POST))
  {
    $picture = new Picture();
    $picture->UploadImage($_FILES["photo"]);
  }

  $images = DB::getInstance()->query("select * from pictures")->all();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LayoutTest</title>
        <script src="content/scripts/antimoderate.js"></script>
        <style>
          div.grid-item{
            display: inline-block;
          }
        </style>
    </head>
    <body>
      <header>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="file" name="photo" size="25" />
          <input type="submit" name="submit" value="Submit" />
        </form>
      </header>

      <?php if($images): ?>
        <?php foreach($images as $key => $image): ?>
            <?php 
              $source = $image->source;
              $base64 = $image->base64;
            ?>  
            <div class="grid-item">
                <img src="<?= $source; ?>" data-antimoderate-idata="<?= $base64; ?>" data-antimoderate-scale="20">
            </div> 
            <div class="grid-item">
                <img src="<?= $base64; ?>">
            </div> 


        <?php endforeach; ?>
      <?php endif; ?>


      <script>
        var images = document.querySelectorAll('img');
        [].forEach.call(images, function(img) {
          AntiModerate.process(img, img.getAttribute("data-antimoderate-idata"), img.getAttribute("data-antimoderate-scale"));
        });
      </script>
    </body>
</html>