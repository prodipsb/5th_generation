<?php
session_start();
include_once 'vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();
$all_articles_info = $articleobj->select_all_articles();
$user_id = $_GET['user_id'];
$user_articles = $articleobj->select_all_articles_by_user_id($user_id);


use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_published_categories();
//echo '<pre>';
//print_r($user_articles);
//exit();

use App\Menus;

$menuobj = new Menus();

$all_menus = $menuobj->select_all_menus();

$base_url = 'http://localhost/113264/UserMiniProjectFeb16/';

?>
<?php include_once 'header.php';?>
           
   
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">

                            <?php foreach ($user_articles as $v_user_articles) { ?>
                                <div class="row">
                                    <h2><?php echo $v_user_articles['title'] ?></h2>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img src="<?php echo 'img/article_feature_images/' . $v_user_articles['image_name']; ?>" width="100%" alt="">
                                        </div>
                                        <div class="col-lg-9">
                                            <p style="text-align: justify">
                                                <?php echo $v_user_articles['summary']; ?>
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                            <div class="bottom-article">
                            <ul class="meta-post">
                                <li><i class="icon-calendar"></i>
                                    <a href="#">
                                        <?php
                                        $data = $v_user_articles['created_at'];
                                        $date_format = date('M d Y', strtotime($data));
                                        echo $date_format;
                                        ?>

                                    </a>
                                </li>
                                <li><i class="icon-user"></i><a href="user_archive.php?user_id=<?php echo $v_user_articles['user_id']; ?>"> <?php echo $v_user_articles['firstname'] . ' ' . $v_user_articles['lastname']; ?></a></li>
                                <li><i class="icon-folder-open"></i>
                                    <?php 
//                                    echo '<pre>';
//                                    print_r($v_user_articles);
//                                    exit();
                                    ?>
                                    <?php
                                    foreach ($categories_info as $v_category) {
                                        $categories_id = explode(',', $v_user_articles['category_id']);
//                                         echo '<pre>';
//                                    print_r($categories_id);
//                                    exit();
                                        if (in_array($v_category['id'], $categories_id)) {
                                            ?>
                                            <a href="category_archive.php?category_id=<?php echo $v_category['id']; ?>"> <?php echo $v_category['title']; ?>  | </a>
                                            <?php
                                        }
                                    }
                                    ?>

                                </li>
                            </ul>
                            <a href="article_details.php?id=<?php echo $v_user_articles['article_id']; ?>" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
                        </div>
                               
                            <?php } ?>
                        </div>
                        <div class="col-lg-4">
                           <aside class="right-sidebar">
				<div class="widget">
					<form class="form-search">
						<input class="form-control" type="text" placeholder="Search..">
					</form>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Categories</h5>
					<ul class="cat">
                                             <?php
                                                    foreach ($categories_info as $v_category) {
                                                        ?>
                                            <li><i class="icon-angle-right"></i><a href="category_archive.php?category_id=<?php echo $v_category['id'];?>"><?php echo $v_category['title']?></a><span> (<?php echo count($v_category);?>)</span></li>
                                            <?php } ?>
						
					</ul>
				</div>
				</aside>
                        </div>
                    </div>
                </div>
            </section>
           
            <?php echo include_once 'footer.php';?>