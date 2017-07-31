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

    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                 <h4 style="color: green; text-align: center;">
            <?php
                if(isset($_SESSION['email_sent_mgs'])){
                    echo $_SESSION['email_sent_mgs'];
                    unset($_SESSION['email_sent_mgs']);
                }
            ?>
            </h4>
                <!-- Contact -->
                <section>
                    <div class="container" >
                        <div class="row">
                            <h2 align="center">Contact us </h2>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 align="center">Get in touch with using <strong>contact form</strong></h3>
                                        <form id="contactform" action="contact_action.php" method="post" class="validateform" name="send-contact">
                                            <div id="sendmessage">
                                                Your message has been sent. Thank you!
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 field">
                                                    <label>Your Name</label></br>
                                                    <input type="text" name="name" class="form-control" placeholder="* Enter your full name" data-rule="maxlen:4" data-msg="Please enter at least 4 chars" required>
                                                    <div class="validation">
                                                    </div>
                                                </div><br>
                                                <div class="col-lg-12 field">
                                                    <label>Your Email</label></br>
                                                    <input type="email" name="email" class="form-control" placeholder="* Enter your email address" data-rule="email" data-msg="Please enter a valid email" required>
                                                    <div class="validation">
                                                    </div>
                                                </div><br>
                                                <div class="col-lg-12 field">
                                                    <label>Email subject</label></br>
                                                    <input type="text" name="subject" class="form-control" placeholder="Enter your subject" data-rule="maxlen:4" data-msg="Please enter at least 4 chars" required>
                                                    <div class="validation">
                                                    </div>
                                                </div><br>
                                                <div class="col-lg-12 margintop10 field">
                                                    <label>Message content</label>
                                                    <textarea rows="12" name="message" class=" form-control input-block-level" placeholder="* Your message here..." data-rule="required" data-msg="Please write something" required></textarea>
                                                    <div class="validation">
                                                    </div>
                                                    <p>
                                                        <button class="btn btn-theme margintop10 pull-left" type="submit">Submit message</button>
                                                        <span class="pull-right margintop20">* Please fill all required form field, thanks!</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end Contact -->
            </div>
        </div>
    </div>


<?php echo include_once 'footer.php';?>