<?php include_once('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php include_once('head.php'); ?>
</head>
<body>
<?php include_once('header.php'); ?>

<div id="content">
                <div class="container background-white">
                    <div class="container">
                        <div class="row margin-vert-30">
                            <!-- Login Box -->
                            <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                                <form class="login-page" action="" method="post">
                                    <div class="login-header margin-bottom-30">
                                        <h2>Login to your account</h2>
                                    </div>
                                    <div class="input-group margin-bottom-20">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input placeholder="Username" class="form-control" type="text" name="username">
                                    </div>
                                    <div class="input-group margin-bottom-20">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <input placeholder="Password" class="form-control" type="password" name="password">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="checkbox">
                                                <input type="checkbox">Stay signed in</label>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary pull-right" type="submit" name="login">Login</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Forget your Password ?</h4>
                                    <p>
                                        <a href="#">Click here </a>to reset your password.</p>
                                </form>
                            </div>
                            <!-- End Login Box -->
                        </div>
                    </div>
                    <div class="container">
                              
                              <!-- Trigger the modal with a button -->
                              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

                              <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    
                                    <div class="modal-body">
                                      <form action="" method="post">
                                          <input type="text" name="username"><br>
                                          <input type="password" name="password"><br>
                                          <input type="submit" name="aSubmit">
                                      </form>
                                    </div>
                                   
                                  </div>
                                  
                                </div>
                              </div>
                              
                            </div>
                </div>

            </div>

            <?php

// if (isset($_POST['submit'])) {
//     $sql= $link->prepare("SELECT *
//         FROM admin WHERE username=:username and password=md5(:password) ");
//     unset($_POST['submit']);
//     $sql->execute($_POST);
//     $count = $sql->fetch(PDO::FETCH_OBJ);

//     if ($count!=null) {
//         $_SESSION['admin']=$count;
//         header('location:index.php');
//         exit;
//     }else{
       
//         echo "Wrong data!";
//     }

// }

if (isset($_POST['login'])) {
    $sql=$link->prepare("SELECT * FROM user WHERE username=:username and password=md5(:password) and is_approved=1 ");
    unset($_POST['login']);
    $sql->execute($_POST);
    $row=$sql->fetch(PDO::FETCH_OBJ);
    if ($row!=0) {
        $_SESSION['username']=$row;
        header('location:index.php');
        exit;
    }else{
        echo "Wrong data please try again";
    }
}


?>
<?php

if (isset($_POST['aSubmit'])) {
    $sql= $link->prepare("SELECT *
        FROM admin WHERE username=:username and password=md5(:password) ");
    unset($_POST['aSubmit']);
    $sql->execute($_POST);
    $count = $sql->fetch(PDO::FETCH_OBJ);

    if ($count!=null) {
        $_SESSION['admin']=$count;
        header('location:index.php');
        exit;
    }else{
       
        echo "Wrong data!";
    }

}
?>
<!-- <h3><a href="signup.php">Register</a></h3> -->


<?php include_once('footer.php'); ?>
</body>
</html>