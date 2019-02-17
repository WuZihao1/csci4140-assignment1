<?php



include "mysql.php";
echo $db;

$file = $_FILES["image"];


$mode = $_POST['mode'];

// 先判断有没有错
if ($file["error"] == 0) {

  $typeArr = explode("/", $file["type"]);
  $nameType = explode(".", $file["name"]);

  //echo $typeArr[1].'<br/>';
  //echo $nameType[1].'<br/>';
  if(($typeArr[1] == $nameType[1]) || (($typeArr[1] == "jpeg") && ($nameType[1] == "jpg" ))){
    if($typeArr[0]== "image"){

      //$command = "magick identify ".$file["tmp_name"];
      //$result = exec($command, $result, $return_val);
      //print($return_val);
      //print_r($result);

      $check_id = "Select id from image";
      $id_tot = mysqli_query($conn,$check_id);
      $all_id = mysqli_fetch_all($id_tot, MYSQLI_ASSOC);
      $max_id = count($all_id)+1;
      $imgname = $max_id.".".$nameType[1];

      $permission = "Public";
      $imgType = array("png","jpg","gif","jpeg");
      if(in_array($typeArr[1], $imgType)){ 

        if($mode == "Public"){
          $dir = $mode;
          $permission = "Public";
          $insert="Insert image(Permission, Name) values('Public','".$imgname."')";
        }else{
          $dir = $mode;
          $permission = $_COOKIE['username'];
          $insert = "Insert image(Permission, Name) values('".$permission."','".$imgname."')";
        }
         


        mysqli_query($conn, $insert);

        $imgpath = $dir."/".$imgname;

        if(file_exists($dir)){
          ;
        }else{
          mkdir($dir);
        }

        //echo $imgname;

        $bol = move_uploaded_file($file["tmp_name"], $imgpath);
        if($bol){
          echo "Upload sucessfully";
          header('refresh:3; url=index.php');
          exit;
        }else{
          echo "Fail";
          header('refresh:3; url=index.php');
          exit;
        }



      }else{
        echo "The uploaded file is jpg or png or gif";
        header('refresh:3; url=index.php');
        exit;
      }
    } else {

    echo "The uploaded file is not a photo of gif";
    header('refresh:3; url=index.php');
    exit;
    }
  }else{
    echo "The content is unmatched to the filename";
    header('refresh:3; url=index.php');
    exit;
  }
} else {

  header('refresh:3; url=index.php');
  echo $file["error"];
  exit;
}

#echo $file["name"];
#echo $typeArr[1];

header("location:index.php");
?>