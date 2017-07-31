<?php
if(!isset($_SESSION)){
    session_start();
}

include_once 'vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();

$page1 = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == '' || $page == '1') {
        $page1 = 0;
    } else {
        $page1 = ($page * 5) - 5;
    }
}
$all_articles_info = $articleobj->select_all_articles_for_pagi($page1);
$all_articles_info_for_pagi = $articleobj->select_all_articles_for_pagination();





use App\Categories;

$categoryobj = new Categories();
$categories_info = $categoryobj->select_published_categories();
$cat_article_map = $categoryobj->maping_table();
//echo '<pre>';
//print_r($all_articles_info);
//exit();

use App\Menus;

$menuobj = new Menus();
$all_menus = $menuobj->select_all_menus();

use App\Sliders;

$sliderobj = new Sliders();
$all_published_sliders = $sliderobj->select_all_published_slider();

?>
        <?php include_once 'header.php';?>
            <section id="featured">
                <!-- start slider -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Slider -->
                            <div id="main-slider" class="flexslider">
                                <ul class="slides">
                                    <?php
                                        foreach($all_published_sliders as $v_slider){
                                    ?>
                                    <li>
                                        <img src="<?php echo 'img/slides/'.$v_slider['slider_image'];?>" width="" height="450" alt="" />
                                        <div class="flex-caption">
                                            <?php echo htmlspecialchars_decode($v_slider['caption']);?>
                                        </div>
                                    </li>
                                        <?php }?>
                                    
                                </ul>
                            </div>
                            <!-- end slider -->
                        </div>
                    </div>
                </div>	



            </section>
   
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">

                            <?php foreach ($all_articles_info as $v_article) { ?>
                            
                                <div class="row">
                                    <a href="article_details.php?id=<?php echo $v_article['article_id']; ?>"><h2><?php echo $v_article['title'] ?></h2></a>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <a href="article_details.php?id=<?php echo $v_article['article_id']; ?>"> <img src="<?php echo 'img/article_feature_images/' . $v_article['image_name']; ?>" width="100%" height="150" alt=""></a>
                                        </div>
                                        <div class="col-lg-9">
                                            <p style="text-align: justify">
                                                    <?php
                                                        
                                                    $words = explode(' ', $v_article['summary']);
                                                    
                                                    $slice_string =array_slice($words, 0, 90);
                                                    $array_to_string = implode(' ', $slice_string);
                                                    echo $array_to_string;
                                                    
                                                        
                                                        ?>
                                                </p>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bottom-article">
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

                                   
                                <?php } ?>




                                <?php if ($all_articles_info_for_pagi > 5) { ?>
                                    <div class="row">
                                        <ul class="pagination pull-right">
                                       
                                            <?php
                                            $cout = $all_articles_info_for_pagi;


                                            $a = $cout / 5;
                                            $a = ceil($a);

                                            for ($b = 1; $b <= $a; $b++) {
                                                ?>
                                            <li> <a href="index.php?page=<?php echo $b; ?>"><?php echo $b . ' '; ?></a></li>


                                        <?php } ?>
                                       

                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4">
                            <?php include_once 'frontend_right_sidebar.php'; ?>
                        </div>
                    </div>
                </div>
            </section>
            
            <?php echo include_once 'footer.php';?>