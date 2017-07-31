<?php
if(!isset($_GET['s'])){
    header('location:index.php');
}
session_start();
include_once 'vendor/autoload.php';

$page1 = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == '' || $page == '1') {
        $page1 = 0;
    } else {
        $page1 = ($page * 5) - 5;
    }
}


use App\Articles;

$articleobj = new Articles();

$all_articles_info = $articleobj->search($_GET['s'], $page1);

use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_published_categories();
$pagi_search_count = $categoryobj->pagi_for_search($_GET['s']);
//echo '<pre>';
//print_r($all_articles_info);
//exit();

use App\Menus;

$menuobj = new Menus();
$all_menus = $menuobj->select_all_menus();


?>
<?php include_once 'header.php';?>
            <!-- end header -->
           
   
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">


                            <?php

                            if (isset($all_articles_info[0]['title']) && !empty($all_articles_info[0]['title'])){
                            foreach ($all_articles_info as $v_article) {
                                $image_info = $articleobj->image_maping($v_article['id']);
                                $image_id = $image_info['image_id'];
                                $image = $articleobj->image($image_id)['image_name'];

                                ?>
                                <div class="row">
                                    <h2><?php echo $v_article['title'] ?></h2>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img src="<?php echo 'img/article_feature_images/' . $image; ?>" width="100%" alt="">
                                        </div>
                                        <div class="col-lg-9">
                                            <p style="text-align: justify">
                                                <?php echo $v_article['summary']; ?>
                                            </p>
                                            <div class="row pull-right">
                                                <a href="article_details.php?id=<?php echo $v_article['id']; ?>" class="btn btn-info">Read More</a>
                                            </div>
                                     <!--       <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-calendar"></i>
                                                <a href="#">
                                                    <?php
                                                    $data = $v_article['created_at'];
                                                    $date_format = date('M d Y', strtotime($data));
                                                    echo $date_format;
                                                    ?>

                                                </a>
                                            </li>
                                            <li><i class="icon-user"></i><a href="user_archive.php?user_id=<?php echo $v_article['user_id']; ?>"> <?php echo $v_article['firstname'] . ' ' . $v_article['lastname']; ?></a></li>
                                            <li><i class="icon-folder-open"></i>
                                                
                                                    <?php
                                                    $categories_id = explode(',', $v_article['category_id']);
//                                                    echo '<pre>';
//                                                    print_r($categories_info);
//                                                    exit();
                                                    foreach ($categories_info as $v_category) {
                                                            
//                                                        echo '<pre>';
//                                                    print_r($v_category['id']);
//                                                    exit();
                                                            if (in_array($v_category['id'], $categories_id)) {
                                                            ?>
                                                            <a href="category_archive.php?category_id=<?php echo $v_category['id']; ?>"> <?php echo $v_category['title']; ?>  | </a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                            </li>
                                        </ul>
                                        <a href="article_details.php?id=<?php echo $v_article['article_id']; ?>" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
                                    </div>
                                        -->
                                        </div>
                                       
                                         
                                        
                                        
                                    </div>
                                </div>
                            <hr>
                            <?php }} else { ?><h2 align="center">NO MATCH FOUND</h2> <?php } ?>
                            
                            
                            
                            
                            
                   <!--         <?php if($pagi_search_count >1){ ?>
                            <div class="row">
                                <ul class="pagination pull-right">
                                     <li><a href="index.php?page=<?php if($_GET['page']>1){ echo $_GET['page']-1;} ?>"><i class="fa fa-chevron-left"></i></a></li>
                                <?php
                                $cout = $pagi_search_count;
                               

                                $a = $cout / 5;
                                $a = ceil($a);
                                
                                for ($b = 1; $b <= $a; $b++) {
                                    ?>
                                     <li> <a href="search.php?page=<?php echo $b; ?>"><?php echo $b . ' '; ?></a></li>


                                <?php } ?>
                                    <li class=""><a href="index.php?page=<?php if($_GET['page']<=$a){ echo $_GET['page']+1;} ?>"><i class="fa fa-chevron-right"></i></a></li>

                                </div>
                            <?php }?> -->
                            
                            
                            
                            
                        </div>
                        <div class="col-lg-4">
                          <?php include_once 'frontend_right_sidebar.php';?>
                        </div>
                    </div>
                </div>
            </section>
          
          <?php echo include_once 'footer.php';?>