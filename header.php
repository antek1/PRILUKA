<?php include_once('conn.php'); ?>
<?php ob_start(); ?>
<div id="pre-header" class="background-gray-lighter">
                
            <!-- End Phone/Email -->
            <!-- Header -->
            <!-- <div id="header">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <!-- <div class="logo">
                            <a href="index.php" title="">
                                <img src="images/logo.png" alt="Logo" />
                            </a>
                        </div> -->
                        <!-- End Logo-->
                    </div>
                </div>
            </div> 
            <div id="hornav" class="bottom-border-shadow">
                <div class="container no-padding border-bottom">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="visible-lg">
                                <ul id="hornavmenu" class="nav navbar-nav">
                                    <li>
                                        <a href="index.php" class="fa-home ">Home</a>
                                    </li>
                                    <li><a href="" >Category</a>
                                    <?php
                                        $sql= $link->prepare("SELECT * FROM  category");
                                        $sql -> execute();
                                        $row = $sql -> fetchAll(PDO::FETCH_OBJ);
                                    ?>  
                                        <ul>
                                        <?php foreach ($row as $catg):?>
                                            <li><a href="category.php?id=<?php echo $catg-> id; ?>"><?php echo $catg-> title; ?></li></a>
                                        <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    
                                     <li>
                                        <a href="about.php">About Us</a>
                                    </li>

                                     
                                    <?php if(isset($_SESSION['admin']) || ($_SESSION['username'])): ?>
                                    <li>
                                    <a href="logout.php" onclick="return confirm('Are you sure?')" ;>Logout <?php echo  $_SESSION ['username']->username; ?></a>
                                    </li>
                                    <?php else: ?>
                                
                                    <li>
                                    <a href="login.php" >Login</a>
                                    </li>
                                    <li>
                                        <a href="signup.php">Sign-Up</a>
                                    </li>
                                <?php endif; ?>
                               
                                    
                                    <?php if (isset($_SESSION['username'])) :?>
                                    <li>
                                        <a href="profile.php?id=<?php echo $_SESSION['username']-> id;?>" ">Profile</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['admin'])):?>
                                    <li>
                                        <a href="era.php">Era</a>
                                    </li>
                                <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>