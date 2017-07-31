<?php
include_once 'vendor/autoload.php';

use App\Articles;
use App\Categories;

$articleobj = new Articles();
$id = $_GET['id'];
$articles_info = $articleobj->show_article_details_by_id($id);

$categories_id = explode(',', $articles_info[0]['category_id']);
$articles_info[0]['category_id'] = $categories_id;


$categoryobj = new Categories();
$categories_info = $categoryobj->select_published_categories();
$cat_article_map = $categoryobj->maping_table();
//echo '<pre>';
//print_r($articles_info);
//exit();
?>
<?php include_once 'header.php'; ?>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <div class="post-image">
                        <div class="post-heading">
                            <h3><a href="#"><?php echo $articles_info[0]['title']; ?></a></h3>
                        </div>
                        <img src="<?php echo 'img/article_feature_images/' . $articles_info[0]['image_name']; ?>" width="700" height="200" style="height: 400px;" alt="" />
                    </div>
                    <p>
                        <?php echo htmlspecialchars_decode($articles_info[0]['html_details']); ?>
                    </p>
                    <div class="bottom-article">
                        <ul class="meta-post">
                            <li><i class="icon-calendar"></i>
                                <a href="#">
                                    <?php
                                    $data = $articles_info[0]['created_at'];
                                    $date_format = date('M d Y', strtotime($data));
                                    echo $date_format;
                                    ?>

                                </a>
                            </li>
                            <li><i class="icon-user"></i><a href="user_archive.php?user_id=<?php echo $articles_info[0]['user_id']; ?>"> <?php echo $articles_info[0]['firstname'] . ' ' . $articles_info[0]['lastname']; ?></a></li>
                            <li><i class="icon-folder-open"></i>

                                <?php
                                foreach ($categories_info as $v_category) {
                                    if (in_array($v_category['id'], $articles_info[0]['category_id'])) {
                                        ?>
                                        <a href="category_archive.php?category_id=<?php echo $v_category['id']; ?>"> <?php echo $v_category['title']; ?>  | </a>
                                        <?php
                                    }
                                }
                                ?>

                            </li>
                        </ul>
                    </div>
                </article>




            </div>
            <div class="col-lg-4">
                <?php include_once 'frontend_right_sidebar.php'; ?>
            </div>
        </div>

        <section id="content ">
            <div class="container">

                <!-- divider -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="solidline">
                        </div>
                    </div>
                </div>
                <!-- end divider -->
                <!-- Portfolio Projects -->
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="heading">Recent Posts</h4>
                        <div class="row">
                            <section id="projects">
                                <ul id="thumbs" class="portfolio">
                                    <!-- Item Project and Filter Name -->
                                    <?php
                                    foreach ($cat_article_map as $v_cat_article_map) {
                                        $v_cat_article_map['category_id'] = explode(",", $v_cat_article_map['category_id']);
//                                        echo '<pre>';
//                                        print_r($articles_info[0]['category_id']);
//                                        exit();
                                        foreach ($articles_info[0]['category_id'] as $v_a_info) {
                                            if (in_array($v_a_info, $v_cat_article_map['category_id'])) {
                                                $article = $articleobj->show_releted_article_by_category_id($v_cat_article_map['article_id']);
                                                ?>    
                                                <li class="col-lg-3 design" data-id="id-0" data-type="web">
                                                    <div class="item-thumbs">
                                                        <!-- Fancybox - Gallery Enabled - Title - Full Image -->
                                                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="Work 1" href="article_details.php?id=<?php echo $article['article_id']; ?>">
                                                            <span class="overlay-img"></span>
                                                            <span class="overlay-img-thumb font-icon-plus"></span>
                                                        </a>
                                                        <!-- Thumb Image and Description -->
                                                        <img src="<?php echo 'img/article_feature_images/' . $article['image_name']; ?>" style="height: 200px;" alt="">
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </ul>
                            </section>
                        </div>
                    </div>
                </div>

            </div>
        </section>


    </div>
</section>
<?php echo include_once 'footer.php'; ?>