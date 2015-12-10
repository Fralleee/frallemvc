<?php

class Picture
{

  public static function UploadImage($photo)
  {
    $db = DB::getInstance();
    if($photo['name'])
    {
      if(!$photo['error'])
      {
        // Fullsize image
        $data = file_get_contents($photo["tmp_name"]);
        $name = $photo['name'];
        $source = 'uploads/'.$name;
        $thumbSource = 'uploads/thumbnail_'.$name;
        move_uploaded_file($photo['tmp_name'], $source);
        $size = getimagesize($source);

        // Thumbnail
        smart_resize_image(null, $data, 400, 400, true, $thumbSource, false, false, 75);

        // Base64
        $miniblob = smart_resize_image(null, $data, 35, 35, true, "return", false, false, 1);
        ob_start();
          imagejpeg($miniblob, null, 15);
          $blobData = ob_get_contents (); 
        ob_end_clean ();
        $base64 = 'data:image/image/jpeg' . ';base64,' . base64_encode($blobData);

        // Insert data to DB
        $insertImage = DB::getInstance()->insert("pictures", array(
          "id" => null, 
          "name" => $name, 
          "source" => $source,
          "thumb" => $thumbSource,
          "base64" => $base64,
          "width" => $size[0],
          "height" => $size[1]
        ));
        
      }
    }
  }

}