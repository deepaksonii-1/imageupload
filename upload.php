<?php
  if(!empty($_FILES['files']['name'][0])){
    $failed = array();
    $uploaded = array();
    $allowed = array('jpg','jpeg');

    $file =  $_FILES['files'];
    foreach ($file['name'] as $position => $name) {
      $filesize = $file['size'][$position];
      $filetmp =  $file['tmp_name'][$position];
      $fileerr = $file['error'][$position];
      $fileext = explode(".",$name);
      $fileext = strtolower(end($fileext));


      if(in_array($fileext,$allowed)){
        if($filesize<= 2097152){
          $filepath = 'uploads/'.$name;
          if(move_uploaded_file($filetmp,$filepath)){
            $uploaded[$position] = $filepath;
          }else{
            $failed[$position] = "file unabled to uploaded";
          }

        }else{
          $failed[$position] = "file is out of size";
        }
      }else{
        $failed[$position] = "file is not the image type";
      }

    }
    if(!empty($uploaded)){
      print_r($uploaded);
    }

    if(!empty($failed)){
      print_r($failed);
    }
  }
 ?>
