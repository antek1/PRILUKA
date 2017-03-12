<?php include_once ('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_POST['title']; ?></title>
	<?php include_once ('head.php'); ?>
</head>
<body>
<?php include_once ('header.php'); ?>
<?php
if(isset($_GET["id"])){
    if (!is_numeric($_GET["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["id"]));
        exit;
    }
}

    $sql= $link->prepare("SELECT * FROM  posts where id=:id");

$sql -> execute(array(':id'=>$_GET['id']));
$row = $sql -> fetchall(PDO::FETCH_OBJ);
//echo"<pre>"; print_r($row) ; echo "</pre>";
                     
 
                     

                    
                    if(isset($_GET["id"])){
    if (!is_numeric($_GET["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["id"]));
        exit;
    }  
}
?>

<div id="content">
                <div class="container background-white">
                    <div class="row margin-vert-30">
                        <!-- Main Column -->
                        <div class="col-md-9">
                        <?php foreach ($row as $posts) :?>
                            <div class="blog-post">
                                <div class="blog-item-header">
                                    <h2>
                                        
                                            <?php echo $posts-> title; ?>
                                        
                                    </h2>
                                    <!-- Date -->
                                    <div class="blog-post-date">
                                        <a href="#"><?php echo $posts-> created_at; ?></a>
                                    </div>
                                    <!-- End Date -->
                                </div>
                                <div class="blog-post-details">
                                    <!-- Author Name -->
                                    <div class="blog-post-details-item blog-post-details-item-left user-icon">
                                        <i class="fa fa-user color-gray-light"></i>
                                        <a href="#"><?php echo $posts-> autor; ?></a>
                                    </div>
                                    <!-- End Author Name -->
                                    <!-- Tags -->
                                    <div class="blog-post-details-item blog-post-details-item-left blog-post-details-item-last">
                                       
                                            <i class="fa fa-comments color-gray-light"></i>
                                            <?php 
                                            $sql= $link->prepare("SELECT count(id) as com FROM  comments where id_post='".$posts-> id."'");

                                            $sql -> execute();
                                            $row = $sql -> fetchAll(PDO::FETCH_OBJ);
                                                foreach ($row as $com) {
                                                            echo $com-> com . ' comments';
                                                        }        
                                            ?>

                                        
                                    </div>

                                    <?php if ($_SESSION['username']-> username && $posts -> autor or ($_SESSION['admin'])):?>
                                        

                                        <form action="edit-delete.php" method="post" enctype="" style="display: inline-block;">
                                            
                                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                                            <input type="submit" name="delete" value="Delete Post" onclick="return confirm('Are you sure you want delete this post?')">

                                        </form> 
                                        
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['admin']) || ($_SESSION['username'])):?>
                        <button class="" data-toggle="modal" data-target="#myModalNorm">
                            Edit post
                        </button>
                    <?php endif; ?>

                        <!-- Modal -->
                        <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                           data-dismiss="modal">
                                               <span aria-hidden="true">&times;</span>
                                               <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            Edit Post
                                        </h4>
                                    </div>
                                    
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        
                                        <form role="form" action="edit-delete.php" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label for="Title">Title</label>
                                              <input type="text" name="title" class="form-control" value="<?php echo $posts-> title; ?>" />
                                          </div>
                                          <div class="form-group">
                                            <label for="summary">Summary</label><br>
                                             <textarea name="summary" required style="resize: none;width:250px;height: 100px; " placeholder="few words about this post"><?php echo $posts-> summary; ?></textarea>
                                          </div>
                                          <div class="checkbox">
                                            <label for="content">Content</label><br>
                                               <textarea name="content" required style="resize: none; width:553px; height: 300px; "><?php echo $posts-> content; ?></textarea> 
                                               <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                                            
                                          </div>
                                          <div class="col-md-5">
                                            <input type="file" name="image"><br>
                                          </div>
                                          <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                                          <button type="submit" name="addP" class="btn btn-default">Submit</button>
                                        </form>
                                        
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                                    <!-- End Tags -->
                                    <!-- # of Comments -->
                                    
                                    <!-- End # of Comments -->
                                </div>
                                <div class="blog-item">
                                    <div class="clearfix"></div>
                                    <div class="blog-post-body row margin-top-15">
                                    <div class="row">
                                        <div class="col-md-5">
                                        
                                            <img class="blogImg" id="u_<?php echo $posts->id ?>" src="<?php 
                
                                               echo 'images/' . $posts-> image ;
                                                //echo $putanjaslika;
                                                if(file_exists($img)){
                                                    echo "images/" . $posts-> image ;
                                                }
                                                 //   else{
                                                //     echo "images/slika1.jpg";
                                                // }
                                                
                                                
                                                
                                                ?>" alt="" >

                                        </div>
                                        <div class="col-md-7">
                                            <p><?php echo $posts-> summary; ?></p>
                                        </div>
                                        
                                        </div>
                                        <div class="col-md-12">
                                            <p class="content">
                                            <?php 
                                                    $content = $posts-> content;
                                                     // half of the string length
                                                    $middle = strrpos(substr($content, 0, floor(strlen($content) / 2)), ' ') + 1;
                                                    $firstp = substr($content, 0, $middle);
                                                    $secondp = substr($content, $middle);
                                                    echo $firstp;
                                                    ?>
                                                </p>
                                                    


                                                <iframe width="740" height="315" src="https://www.youtube.com/embed/F9JcaWGv9Z0" frameborder="0" allowfullscreen></iframe>
                                                <p class="content">
                                                <?php echo $secondp; ?>
                                                </p>
                                            <!-- <blockquote class="primary">
                                                <p>
                                                    <em>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."</em>
                                                </p>
                                                <small>
                                                    Someone famous in
                                                    <cite title="Source Title">Source Title</cite>
                                                </small>
                                            </blockquote> -->
                                            
                                        </div>
                                    </div>
                                    <div class="blog-item-footer">
                                        
                                        
                                        <!-- End About the Author -->
                                        <!-- Comments -->
                                        <div class="blog-recent-comments panel panel-default margin-bottom-30">
                                            <div class="panel-heading">
                                                <h3 ">Comments</h3>
                                                
                                            </div>
                                            <ul class="list-group">
                                                <?php 
                                                $sql= $link->prepare("SELECT * FROM  comments where id_post=:id");
                                                $sql -> execute(array(':id'=>$_GET['id']));
                                                $row = $sql -> fetchall(PDO::FETCH_OBJ);

                                                 ?>
                                                 <?php foreach ($row as $comm) : ?>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                     <?php if ($_SESSION['username']-> id === $comm -> id_user or ($_SESSION['admin'])):?>

                                                    
                                                        <form style="display: inline-block; float: right;margin-right: 5px; " class="option" method="post" action="delete-comment.php?id=<?php echo $comm-> id?>">
                                                            <button type="submit" name="cDelete" class="cDelete" "><img src="images/delete.png"></button>
                                                            
                                                        </form>
                                                   <?php endif; ?>
                                                        <div class="col-md-2 profile-thumb">
                                                            <a href="#">
                                                                <img class="media-object" src="assets/img/profiles/Unknown.gif" alt="">
                                                                <h4><?php echo $comm-> created_by; ?></h4>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-10">
                                                            
                                                            <p><?php echo $comm-> comment; ?></p>
                                                            <span class="date">
                                                                <i class="fa fa-clock-o color-gray-light"></i><?php echo $comm-> created_at; ?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                                <!-- Comment Form -->
                                                <li class="list-group-item">
                                                    <div class="blog-comment-form">
                                                        <div class="row margin-top-20">
                                                            <div class="col-md-12">
                                                                <div class="pull-left">
                                                                    <h3>Leave a Comment</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-top-20">
                                                            <div class="col-md-12">
                                                                <form method="post" action="">
                                                                    
                                                                    
                                                                    <label>Comment</label>
                                                                    <div class="row margin-bottom-20">
                                                                        <div class="col-md-11 col-md-offset-0">
                                                                            <textarea required style="resize: none;" class="form-control" rows="8" name="comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <p>
                                                                    <?php if (isset($_SESSION['username']) || isset($_SESSION['admin'])):?>
                                                                        <button class="btn btn-primary" type="submit" name="comm">Comment</button>
                                                                    <?php else: ?>
                                                                    
                                                                        <h3>Login or sign up for posting comments!</h3>
                                                                    <?php endif; ?>
                                                                    </p>
                                                                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php 

                                                        if (isset($_POST['comm'])) {
                                                            
                                                            unset($_POST['comm']);
                                                            $sql=$link->prepare("INSERT INTO comments (comment,created_at,created_by,id_user,id_post) 
                                                                        VALUES (:comment,CURRENT_TIMESTAMP,'".$_SESSION['username']-> username."','".$_SESSION['username']-> id."',:id)");
                                                                    $sql->execute($_POST); 
                                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                                     exit;
                                                                 }
                                                         ?>
                                                <!-- End Comment Form -->
                                            </ul>
                                        </div>
                                        <!-- End Comments -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                            <!-- End Blog Post -->
                        </div>
                        <!-- End Main Column -->
                        <!-- Side Column -->
                        <div class="col-md-3">
                            <!-- Blog Tags -->
                            <!-- <div class="blog-tags">
                                <h3>Tags</h3>
                                <ul class="blog-tags">
                                    <li>
                                        <a href="#" class="blog-tag">Nogomet</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Rukomet</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">RPG</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">FPS</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">World</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Country</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Mobile</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Software</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Hardware</a>
                                    </li>
                                    <li>
                                        <a href="#" class="blog-tag">Health</a>
                                    </li>
                                </ul>
                            </div> -->
                            <!-- End Blog Tags -->
                            <!-- Recent Posts -->
                            <div class="recent-posts">
                                <h3>Most Popular Posts</h3>
                                <ul class="posts-list margin-top-10">
                                 <?php $sql= $link->prepare("SELECT p.id,p.title, p.created_at, c.postcount FROM                         posts as p INNER JOIN (
                                                            SELECT id_post, count(*) AS postcount
                                                                FROM comments GROUP BY id_post) as c on p.id = c.id_post WHERE category=1
                                                                Order by c.postcount desc limit 5");

                                    $sql -> execute();
                                    $row = $sql -> fetchAll(PDO::FETCH_OBJ); 
                                     foreach ($row as $post):?>
                                    <li>
                                        <div class="recent-post">
                                            <a href="single.php?id=<?php echo $posts->id ?>">
                                                <img class="pull-left1" id="u_<?php echo $post->id ?>" src="<?php 
                
                                                   echo "images/" . $post-> title . ".jpg" ;
                                                    //echo $putanjaslika;
                                                    if(file_exists($img)){
                                                        echo "images/" . $post-> title . ".jpg" ;
                                                    }
                                                     //   else{
                                                    //     echo "images/slika1.jpg";
                                                    // }
                                                    
                                                    
                                                    
                                                    ?>" alt="" >
                                            </a>
                                            <a href="#" class="posts-list-title"><?php echo $post-> title; ?></a>
                                            <br>
                                            <span class="recent-post-date">
                                                <?php echo $post-> created_at; ?>
                                            </span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php endforeach; ?>
                                   
                                </ul>
                            </div>
                            <!-- End Recent Posts -->
                            <!-- End Side Column -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            

<?php include_once ('footer.php'); ?>
</body>
</html>