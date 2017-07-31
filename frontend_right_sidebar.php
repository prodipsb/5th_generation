<?php
   include_once 'vendor/autoload.php';

use App\Articles;

$articleobj = new Articles(); 


$recent_posts = $articleobj->select_recent_posts();
$old_posts = $articleobj->select_old_posts();

?>

<aside class="right-sidebar">
    <div class="widget">
        <form class="form-search" action="search.php" method="get">
            <input class="form-control" type="text" name="s" placeholder="Search..">
        </form>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li ><a href="#one" data-toggle="tab" style="color: #333; padding: 13px; width: 160px; text-align: center;"><i class="icon-briefcase"></i> <b> Recent Posts</b></a></li>
                <li class="active"><a href="#two" data-toggle="tab" style="color: #333;padding: 13px;width: 160px;text-align: center;"><b>Old Posts</b></a></li>
            </ul>
            <div class="tab-content" style="margin-top: 15px;">
                <div class="tab-pane " id="one">
                    <?php
                        foreach($recent_posts as $v_recent_posts){
                    ?>
                    <div class="row">
                    <div class="col-md-4">
                        <a href="article_details.php?id=<?php echo $v_recent_posts['article_id']; ?>"><img src="<?php echo 'img/article_feature_images/'.$v_recent_posts['image_name'];?>" width="100" height="80" alt=""></a>
                    </div>
                        <div class="col-md-8" style="text-align: justify;">
                            <a href="article_details.php?id=<?php echo $v_recent_posts['article_id']; ?>"> <?php echo $v_recent_posts['title'];?></a>
                    </div>
                    </div>
                        <?php }?>
                </div>
                <div class="tab-pane active" id="two">
                    <?php
                        foreach($old_posts as $v_old_posts){
                    ?>
                    <div class="row">
                    <div class="col-md-4">
                        <a href="article_details.php?id=<?php echo $v_old_posts['article_id']; ?>"><img src="<?php echo 'img/article_feature_images/'.$v_old_posts['image_name'];?>" width="100" height="80" alt=""></a>
                    </div>
                        <div class="col-md-8" style="text-align: justify;">
                            <a href="article_details.php?id=<?php echo $v_old_posts['article_id']; ?>"> <?php echo $v_old_posts['title'];?></a>
                    </div>
                    </div>
                     <?php }?>
                </div>
                
            </div>
        </div>
        

    </div>





    <div class="widget">
        <h5 class="widgetheading">Categories</h5>
        <ul class="cat">
            <?php
            foreach ($categories_info as $v_category) {
                ?>
                <li><i class="icon-angle-right"></i><a href="category_archive.php?category_id=<?php echo $v_category['id'] ?>"><?php echo $v_category['title'] ?></a></li>
            <?php } ?>

        </ul>
    </div>


</aside>