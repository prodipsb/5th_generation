<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['user_id']) {
    
} else {
    header('location:../index.php');
}
?>
<?php
include_once '../vendor/autoload.php';

use App\Sliders;

$sliderobj = new Sliders();
$slider_info = $sliderobj->select_all_sliders();

//echo '<pre>';
//print_r($slider_info);
//exit();
?>
<?php include_once 'admin_header.php';?>

                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
                        <h4 style="color: green; text-align: center;">
                            <?php
                            if (isset($_SESSION['slider_mgs'])) {
                                echo $_SESSION['slider_mgs'];
                                unset($_SESSION['slider_mgs']);
                            }
                            ?>
                        </h4>
                        <div class="col-lg-12">

                            <div class="clearfix">
                                <h2 class="pull-left">Manage Pages</h2>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix">
                                        <div class="table-responsive">
                                            <table class="table user-list">
                                                <thead>
                                                    <tr>
                                                        <th><span>Slider Image</span></th>
                                                        <th><span>Slider Title</span></th>
                                                        <th class="text-center"><span>Publication Status</span></th>
                                                        <th><span>Added Date</span></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($slider_info as $v_slider) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <span>
                                                                    <img src="<?php echo '../img/slides/'.$v_slider['slider_image'];?>" width="400" height="200" alt="">
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php echo $v_slider['title']; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($v_slider['publication_status'] == 1) { ?>
                                                                <a href = "slider_unpublished.php?id=<?php echo $v_slider['id']; ?>">
                                                                        <span class = "label label-danger">Unpublised</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href = "slider_published.php?id=<?php echo $v_slider['id']; ?>">
                                                                        <span class = "label label-success">Published</span>
                                                                    </a>
                                                                <?php } ?>

                                                            </td>
                                                            <td style="width: 10%;">
                                                                <?php
                                                                $data = $v_slider['created_at'];
                                                                $date_format = date('d M Y H:i A', strtotime($data));
                                                                echo $date_format;
                                                                ?>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <a href="user_view.php?id=<?php echo $v_slider['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="slider_edit.php?id=<?php echo $v_slider['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="slider_delete.php?id=<?php echo $v_slider['id']; ?>" class="table-link danger">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <ul class="pagination pull-right">
                                            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'admin_footer.php';?>