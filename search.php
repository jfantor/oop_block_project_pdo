<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
                //   include "config.php";
                  if(isset($_GET['search'])){
                    $search_term =  $_GET['search'];
                  ?>
                  <h2 class="page-heading">Search : <?php echo $search_term; ?></h2>
                  <?php

                    /* Calculate Offset Code */

                    $join ='category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id';
                    $col_name = "post.post_id, post.title, post.description,post.post_date,post.author,category.category_name,user.username,post.category,post.post_img";
                    $limit= 3;
                    $order= "post.post_id DESC";
                    $where = "post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%'";

                    $obj->select('post',$col_name,$join,$where,$order,$limit);

                    $result = $obj->get_result();
                    if(COUNT($result) > 0){
                      foreach($result as $row) {
                  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                              <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/uplode/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                              <div class="inner-content clearfix">
                                  <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                  <div class="post-information">
                                      <span>
                                          <i class="fa fa-tags" aria-hidden="true"></i>
                                          <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                      </span>
                                      <span>
                                          <i class="fa fa-user" aria-hidden="true"></i>
                                          <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                      </span>
                                      <span>
                                          <i class="fa fa-calendar" aria-hidden="true"></i>
                                          <?php echo $row['post_date']; ?>
                                      </span>
                                  </div>
                                  <p class="description">
                                      <?php echo substr($row['description'],0,130) . "..."; ?>
                                  </p>
                                  <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php
                      }
                    }else{
                      echo "<h2>No Record Found.</h2>";
                    }

                    // show pagination
                    $search ="search=".$search_term;
                    $obj->pagination('post',$join,$where,$limit,$search);

                    // $sql1 = "SELECT * FROM post
                    //         WHERE post.title LIKE '%{$search_term}%'";
                    // $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                    // if(mysqli_num_rows($result1) > 0){

                    //   $total_records = mysqli_num_rows($result1);

                    //   $total_page = ceil($total_records / $limit);

                    //   echo '<ul class="pagination admin-pagination">';
                    //   if($page > 1){
                    //     echo '<li><a href="search.php?search='.$search_term .'&page='.($page - 1).'">Prev</a></li>';
                    //   }
                    //   for($i = 1; $i <= $total_page; $i++){
                    //     if($i == $page){
                    //       $active = "active";
                    //     }else{
                    //       $active = "";
                    //     }
                    //     echo '<li class="'.$active.'"><a href="search.php?search='.$search_term .'&page='.$i.'">'.$i.'</a></li>';
                    //   }
                    //   if($total_page > $page){
                    //     echo '<li><a href="search.php?search='.$search_term .'&page='.($page + 1).'">Next</a></li>';
                    //   }

                    //   echo '</ul>';
                    // }
                  }else{
                    echo "<h2>No Record Found.</h2>";
                  }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
