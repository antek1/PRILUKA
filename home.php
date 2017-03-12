 <?php include_once('conn.php'); ?>
 <?php 
$sql= $link->prepare("SELECT * FROM  posts order by id desc limit 10");

$sql -> execute();
$row = $sql -> fetchAll(PDO::FETCH_OBJ);
            
?>          
<div id="content">
                <div class="container background-white">
                    <div class="row margin-vert-30">
                        <!-- Main Column -->
                        <div class="col-md-9">
                            <!-- Blog Post -->
                            <?php foreach ($row as $posts): ?>
                            <div class="blog-post padding-bottom-20">
                                <!-- Blog Item Header -->
                                <div class="blog-item-header">
                                    <!-- Title -->
                                    <h2>
                                        <a href="single.php?id=<?php echo $posts->id ?>">
                                            <?php echo $posts -> title; ?></a>
                                    </h2>
                                    <div class="clearfix"></div>
                                    <!-- End Title -->
                                    <!-- Date -->
                                    <div class="blog-post-date">
                                        <a href="single.php?id=<?php echo $posts->id ?>"><?php echo $posts -> created_at; ?></a>
                                    </div>
                                    <!-- End Date -->
                                </div>
                                <!-- End Blog Item Header -->
                                <!-- Blog Item Details -->
                                <div class="blog-post-details">
                                    <!-- Author Name -->
                                    <div class="blog-post-details-item blog-post-details-item-left">
                                        <i class="fa fa-user color-gray-light"></i>
                                        <a href="#"><?php echo $posts -> autor ;?></a>
                                    </div>
                                    <!-- End Author Name -->
                                    <!-- Tags -->
                                    <!-- <div class="blog-post-details-item blog-post-details-item-left blog-post-details-tags">
                                        <i class="fa fa-tag color-gray-light"></i>
                                        <a href="#">jQuery</a>,
                                        <a href="#">HTML5</a>,
                                        <a href="#">CSS</a>
                                    </div> -->
                                    <!-- End Tags -->
                                    <!-- # of Comments -->
                                    <div class="blog-post-details-item blog-post-details-item-left blog-post-details-item-last">
                                        <a href="single.php?id=<?php echo $posts->id ?>">
                                            <i class="fa fa-comments color-gray-light"></i>
                                            <?php 
                                            $sql= $link->prepare("SELECT count(id) as com FROM  comments where id_post='".$posts-> id."'");

                                            $sql -> execute();
                                            $row = $sql -> fetchAll(PDO::FETCH_OBJ);
                                                foreach ($row as $com) {
                                                            echo $com-> com . ' comments';
                                                        }        
                                            ?>

                                        </a>
                                    </div>
                                    <!-- End # of Comments -->
                                </div>
                                <!-- End Blog Item Details -->
                                <!-- Blog Item Body -->
                                <div class="blog">
                                    <div class="clearfix"></div>
                                    <div class="blog-post-body row margin-top-15">
                                        <div class="col-md-5">
                                        <a href="single.php?id=<?php echo $posts->id ?>">
                                            <img class="blogImg" id="u_<?php echo $posts->id ?>" src="<?php 
                
									               echo "images/" . $posts-> image ;
									                //echo $putanjaslika;
									                if(file_exists($img)){
									                    echo "images/" . $posts-> image ;
									                }
									                 //   else{
									                //     echo "images/slika1.jpg";
									                // }
									                
									                
									                
									                ?>" alt="" >
                                                    </a>
                                        </div>
                                        <div class="col-md-7">
                                            <p><?php echo $posts -> summary; ?></p>
                                            <!-- Read More -->
                                            <a href="single.php?id=<?php echo $posts->id ?>" class="btn btn-primary">
                                                Read More
                                                <i class="icon-chevron-right readmore-icon"></i>
                                            </a>
                                            <!-- End Read More -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Blog Item Body -->
                            </div>
                            <?php endforeach; ?>
                            <!-- End Blog Item -->
                            <!-- Blog Post -->
                            
                            <!-- End Blog Item -->
                            <!-- Pagination -->
                            
                            <!-- End Pagination -->
                        </div>
                        <!-- End Main Column -->
                        <!-- Side Column -->
                        
                        <div class="col-md-3">
                            <!-- Recent Posts -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Popular Posts</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="posts-list margin-top-10">
                                        <?php $sql= $link->prepare("SELECT p.id,p.title, p.created_at, c.postcount FROM                         posts as p INNER JOIN (
                                                            SELECT id_post, count(*) AS postcount
                                                                FROM comments GROUP BY id_post) as c on p.id = c.id_post
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
                            </div>
                            <!-- End recent Posts -->
                            <!-- About -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">About</h3>
                                </div>
                                <div class="panel-body">
                                    Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat.
                                </div>
                            </div>
                            <!-- End About -->
                        </div>
                        <!-- End Side Column -->
                    </div>
                </div>
            </div>