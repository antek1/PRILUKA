<?php include_once 'conn.php'; 
ob_start();
$id=$_POST['id'];

if(!isset($_GET["id"]) && !isset($_POST["id"])){
    header("location: logout.php");
    exit;
}



if(isset($_GET["id"])){
    if (!is_numeric($_GET["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["sifra"]));
        exit;
    }
    
    $sql=$link->prepare("select count(id) from posts where id=:id");
    $sql->execute($_GET);
    $res = $sql->fetchColumn();

    
}


if(isset($_POST["delete"])){
    
    	
        unset($_POST["delete"]);
	    $sql=$link->prepare("delete from posts 
        where id=:id");
        $sql->execute(array(":id"=>$_POST['id']));
        //print_r($_POST);
        //exit;
        header("location: index.php");
    
};

 if(!isset($_GET["id"]) && !isset($_POST["id"])){
    header("location: logout.php");
    exit;
}

 
if(isset($_GET["id"])){
    if (!is_numeric($_GET["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["sifra"]));
        exit;
    }
     
    $sql=$link->prepare("select * from category where id=:id");
    $sql->execute($_GET);
    $_POST = $sql->fetch(PDO::FETCH_ASSOC);
}
 





if(isset($_POST["edit"])){
        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];

        $upload_dir = 'images/'; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
      // rename uploading image
      $image = rand(1000,1000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){     
        // Check file size '5MB'
        if($imgSize < 5000000)        {
          move_uploaded_file($tmp_dir,$upload_dir.$image);
        }
        else{
          $errMSG = "Image is to large, please select another image!";
        }
      }
      else{
        $errMSG = "Only JPG, JPEG, PNG & GIF";    
      }
 
     
   
        //radi insert
        unset($_POST["edit"]);
        $sql=$link->prepare('update posts
        set 
        title=:title,
        content=:content,
        image=:image,
        updated_at=CURRENT_TIMESTAMP,
        summary=:summary

                 
        where id=:id');
        $sql->execute($_POST);
        //print_r($_POST);
        //exit;
        header("location: index.php");
        
    
}
