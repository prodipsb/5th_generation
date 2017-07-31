<?php
session_start();
include_once 'vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();
$all_articles_info = $articleobj->select_all_articles();

//$category_id = $_GET['category_id'];
//$all_articles_by_category_id = $articleobj->select_all_articles_by_category_id($category_id);
//$a_categories_id = explode(',', $all_articles_by_category_id['category_id']);
//$all_articles_by_category_id[0]['category_id'] = $a_categories_id;


use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_published_categories();

$cat_article_map = $categoryobj->maping_table();

//echo '<pre>';
//print_r($all_articles_by_category_id);
//exit();

use App\Menus;

$menuobj = new Menus();

$all_menus = $menuobj->select_all_menus();

?>
<?php include_once 'header.php'; ?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                foreach ($cat_article_map as $v_cat_article_map) {
                    $v_cat_article_map['category_id'] = explode(",", $v_cat_article_map['category_id']);
                    if (in_array($_GET['category_id'], $v_cat_article_map['category_id'])) {
                        $article = $articleobj->show_article_by_id($v_cat_article_map['article_id']);
                        ?>                        
                        <div class="row">
                            <h2><?php echo $article['title'] ?></h2>
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="<?php echo 'img/article_feature_images/' . $article['image_name']; ?>" width="100%" alt="">
                                </div>
                                <div class="col-lg-9">
                                    <p style="text-align: justify">
                                        <?php echo $article['summary']; ?>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="bottom-article">
                            <ul class="meta-post">
                                <li><i class="icon-calendar"></i>
                                    <a href="#">
                                        <?php
                                        $data = $article['created_at'];
                                        $date_format = date('M d Y', strtotime($data));
                                        echo $date_format;
                                        ?>

                                    </a>
                                </li>
                                <li><i class="icon-user"></i><a href="user_archive.php?user_id=<?php echo $article['user_id']; ?>"> <?php echo $article['firstname'] . ' ' . $article['lastname']; ?></a></li>
                                <li><i class="icon-folder-open"></i>

                                    <?php
                                    foreach ($categories_info as $v_category) {
                                        $categories_id = explode(',', $article['category_id']);

                                        if (in_array($v_category['id'], $categories_id)) {
                                            ?>
                                            <a href="category_archive.php?category_id=<?php echo $v_category['id']; ?>"> <?php echo $v_category['title']; ?>  | </a>
                                            <?php
                                        }
                                    }
                                    ?>

                                </li>
                            </ul>
                            <a href="article_details.php?id=<?php echo $article['article_id']; ?>" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
                        </div>

                        <?php
                    }
                }
                ?>

            </div>
            <div class="col-lg-4">
                <?php include_once 'frontend_right_sidebar.php'; ?>

            </div>
        </div>
    </div>
</section>

<?php echo include_once 'footer.php'; ?>