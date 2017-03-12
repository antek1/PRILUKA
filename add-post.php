<?php include_once('conn.php'); ?>
<?php 
if(isset($_POST["id"])){
    if (!is_numeric($_POST["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["id"]));
        exit;
    }
}

if (isset($_POST["addP"])) 
{ 
  $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];   
    $id=$_GET['id']; 
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
    

	unset($_POST["addP"]);
	$sql=$link->prepare("INSERT INTO posts (content,summary,title,image,autor,category,created_at) 
	VALUES (:content,:summary,:title,:image,'" . $_SESSION['username']-> username . "',:id,CURRENT_TIMESTAMP)");
      $sql->bindParam(':title',$title);
      $sql->bindParam(':summary',$summary); 
      $sql->bindParam(':content',$content);      
      $sql->bindParam(':image',$image);
      $sql->bindParam(':id', $_POST['id']);     
      

	$sql->execute();
	header('location:' . $_SERVER['HTTP_REFERER']);
	
}else{
	echo "Something went wrong!";
}


 



include_once('footer.php');