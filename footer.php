<?php
include_once 'vendor/autoload.php';

use App\Articles;

$articleobj = new Articles();
$recent_posts = $articleobj->select_recent_posts();

use App\Categories;

$categoryobj = new Categories();
$footer_cats = $categoryobj->select_categories_for_footer();

use App\Menus;

$menuobj = new Menus();
$footer_menus = $menuobj->select_menus_for_footer();

use App\Settings;

$settingobj = new Settings();
$settings = $settingobj->show_settings();
?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="widget">
                    <h5 class="widgetheading">Pages</h5>
                    <ul class="link-list">
                        <?php
                        foreach ($footer_menus as $v_footer_menu) {
                            ?>
                            <li><a href="<?php echo $v_footer_menu['url'] ?>"><?php echo $v_footer_menu['title']; ?></a></li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget">
                    <h5 class="widgetheading">Categories</h5>
                    <ul class="link-list">
                        <?php
                        foreach ($footer_cats as $v_footer_cat) {
                            ?>
                            <li><a href="category_archive.php?category_id=<?php echo $v_footer_cat['id'] ?>"><?php echo $v_footer_cat['title']; ?></a></li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget">
                    <h5 class="widgetheading">Latest posts</h5>
                    <ul class="link-list">
                        <?php
                        foreach ($recent_posts as $v_recent_posts) {
                            ?>
                            <li><a href="article_details.php?id=<?php echo $v_recent_posts['article_id']; ?>"><?php echo $v_recent_posts['title']; ?></a></li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
            <d<div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widgetheading">Contact Us</h5>
                        <address>
                            <strong>5th Generation</strong><br>
                            BITM, Karanbazar, Dhaka<br>
                            Let's Learn Coding </address>
                        <p>
                            <i class="icon-phone"></i>  <br> (+088) 01926813104
                            <i class="icon-envelope-alt"></i> admin@groupname.com
                        </p>
                    </div>
                </div>
        </div>
        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
                                <?php
                               echo $settings['site_footer'];
                                ?>
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="social-network">
                            <li><a href="https://www.facebook.com" data-placement="top" title="Facebook" target="blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.twitter.com" data-placement="top" title="Twitter" target="blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com" data-placement="top" title="Linkedin" target="blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://www.pinterest.com" data-placement="top" title="Pinterest" target="blank"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="https://www.google.com" data-placement="top" title="Google plus" target="blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</footer>


</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
