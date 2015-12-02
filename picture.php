<?php
  require_once "core/init.php";
  if(!empty($_POST))
  {

    $db = DB::getInstance();
    if($_FILES['photo']['name'])
    {
      if(!$_FILES['photo']['error'])
      {
        $data = file_get_contents($_FILES["photo"]["tmp_name"]);

        $temp_file = tempnam(sys_get_temp_dir(), 'Tux');
        $fh = fopen($temp_file, 'w') or die("Can't create file");

        $res = smart_resize_image(null, $data, 400, 200, true, $temp_file, false, false, 1); // Kanske ändra så denna kör nåt annat än fil?
        move_uploaded_file($_FILES['photo']['tmp_name'], $source);

        $name = $_FILES['photo']['name'];
        $source = 'uploads/'.$name;
        $smallData = file_get_contents($temp_file);

        // Delete temp file

        $base64 = 'data:image/' . $_FILES["photo"]["type"] . ';base64,' . base64_encode($smallData);
        $insertImage = DB::getInstance()->insert("pictures", array(
          "id" => null, 
          "name" => $name, 
          "source" => $source, 
          "base64" => $base64
        ));
      }
    }
  }

  $images = DB::getInstance()->query("select * from pictures")->take(0,4);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LayoutTest</title>
        <link rel="stylesheet" href="content/css/grid.css">
        <link rel="author" href="humans.txt">
        <script src="content/scripts/antimoderate.js"></script>
    </head>
    <body>
      <header>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="file" name="photo" size="25" />
          <input type="submit" name="submit" value="Submit" />
        </form>
      </header>

      <div class="grid-wrapper">
        <div class="grid-container">

        <?php foreach($images as $image): ?>
            <?php 
              $source = $image->source;
              $base64 = $image->base64;
            ?>  
            <div class="grid-item">
                <img src="<?php echo $source; ?>" data-antimoderate-idata="<?php echo $base64; ?>" data-antimoderate-scale="20">
            </div>     

        <?php endforeach; ?>

        </div>
      </div>

      <script>
        var images = document.querySelectorAll('img');
        [].forEach.call(images, function(img) {
          AntiModerate.process(img, img.getAttribute("data-antimoderate-idata"), img.getAttribute("data-antimoderate-scale"));
        });          
      </script>
    </body>
</html>