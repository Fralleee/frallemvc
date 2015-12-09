<?php

class Picture
{

  public function UploadImage($photo)
  {
    $db = DB::getInstance();
    if($photo['name'])
    {
      if(!$photo['error'])
      {
        $data = file_get_contents($photo["tmp_name"]);
        $name = $photo['name'];
        $source = 'uploads/'.$name;
        $size = getimagesize($source);
        $res = smart_resize_image(null, $data, 35, 35, true, "return", false, false, 1);
        ob_start();
        imagejpeg($res, null, 15);
          $image_data = ob_get_contents (); 
        ob_end_clean ();
        move_uploaded_file($photo['tmp_name'], $source);

        $base64 = 'data:image/image/jpeg' . ';base64,' . base64_encode($image_data);
        $insertImage = DB::getInstance()->insert("pictures", array(
          "id" => null, 
          "name" => $name, 
          "source" => $source, 
          "base64" => $base64,
          "width" => $size[0],
          "height" => $size[1]
        ));
      }
    }
  }

}