<?php include_once('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<?php include_once('head.php'); ?>
</head>
<body>
<?php include_once('header.php'); ?>

<div id="content">
                <div class="container background-white">
                    <div class="row margin-vert-30">
                        <!-- Register Box -->
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                            <form class="signup-page" method="post" action="">
                                <div class="signup-header">
                                    <h2>Register a new account</h2>
                                    <p>Already a member? Click
                                        <a href="login.php"> HERE</a> to login to your account.</p>
                                </div>
                                <label>Username</label>
                                <input class="form-control margin-bottom-20" type="text" name="username">
                                
                                <label>Email Address
                                    <span class="color-red">*</span>
                                </label>
                                <input class="form-control margin-bottom-20" type="text" name="email">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Password
                                            <span class="color-red">*</span>
                                        </label>
                                        <input class="form-control margin-bottom-20" type="password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Confirm Password
                                            <span class="color-red">*</span>
                                        </label>
                                        <input class="form-control margin-bottom-20" type="password" name="passwordConfirm">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    
                                    <div class="col-lg-4 text-right">
                                        <button class="btn btn-primary" type="submit" name="register">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Register Box -->
                    </div>
                </div>
            </div>





<?php
            

if(isset($_POST['register'])){
  $mail=$_POST['email'];
  $name=$_POST['username'];

  //very basic validation
  if(strlen($_POST['username']) < 3){
    $error[] = 'Username is too short.';
  } else {
    $stmt = $link->prepare('SELECT username FROM user WHERE username = :username');
    $stmt->execute(array(':username' => $_POST['username']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['username'])){
      $error[] = 'Username provided is already in use.';
    }

  }

  if(strlen($_POST['password']) < 3){
    $error[] = 'Password is too short.';
  }

  if(strlen($_POST['passwordConfirm']) < 3){
    $error[] = 'Confirm password is too short.';
  }

  if($_POST['password'] != $_POST['passwordConfirm']){
    $error[] = 'Passwords do not match.';
  }

  //email validation
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $error[] = 'Please enter a valid email address';
  } else {
    $stmt = $link->prepare('SELECT email FROM user WHERE email = :email');
    $stmt->execute(array(':email' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($row['email'])){
      $error[] = 'Email provided is already in use.';
    }

  }


  //if no errors have been created carry on
  if(!isset($error)){

  //   //hash the password
     

  //   //create the activation code
     $activation = md5(uniqid(rand(),true));

    try {

      //insert into database with a prepared statement
      $stmt = $link->prepare('INSERT INTO user (username,password,email,is_approved,activation_key) VALUES (:username, md5(:password), :email,0,:activation_key)');
      $stmt->execute(array(
        ':username' => $_POST['username'],
        ':password' => $_POST['password'],
        ':email' => $_POST['email'],
        ':activation_key'=>$activation
        
      ));
      $id = $link->lastInsertId('id');








      //send emai
      /*$to = $_POST['email'];
      $subject = "Registration Confirmation";
      $body = "<p>Thank you for registering at site.</p>
      <p>To activate your account, please click on this link: <a href='".DIR."login.php'>".DIR."login.php</a></p>
      <p>Regards Site Admin</p>";

      $mail = new Mail();
      $mail->setFrom('antecalin@live.de');
      $mail->addAddress($to);
      $mail->subject($subject);
      $mail->body($body);
      $mail->send();

      //redirect to index page
      header('Location: login.php');
      exit;*/

    //else catch the exception and show the error.
     } catch(PDOException $e) {
         $error[] = $e->getMessage();
         header('login.php');
     }

  }

}


//define page title
$title = 'register';

//include header template
?>
<?php
        //check for any errors
        if(isset($error)){
          foreach($error as $error){
            echo '<p class="bg-danger">'.$error.'</p>';
          }
        }

        //if action is joined show sucess
        if(isset($_GET['action']) && $_GET['action'] == 'joined'){
          echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
        }
        ?>

<?php include_once('footer.php'); ?>
</body>
</html>
