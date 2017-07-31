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

use App\Users;
use App\Profiles;
use App\Pages;

$pageobj = new Pages();
$profileobj = new Profiles();
$userobj = new Users();




$page_info = $pageobj->manage_page();
//echo '<pre>';
//print_r($page_info);
//exit();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>SuperheroAdmin - Bootstrap Admin Template</title>

        <!-- bootstrap -->
        <link href="../css/bootstrap/bootstrap.css" rel="stylesheet" />

        <!-- libraries -->
        <!-- <link href="css/libs/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" /> -->
        <link href="../css/libs/font-awesome.css" type="text/css" rel="stylesheet" />

        <!-- global styles -->
        <link rel="stylesheet" type="text/css" href="../css/compiled/layout.css">
        <link rel="stylesheet" type="text/css" href="../css/compiled/elements.css">

        <!-- this page specific styles -->
        <link rel="stylesheet" href="../css/libs/fullcalendar.css" type="text/css" />
        <link rel="stylesheet" href="../css/libs/fullcalendar.print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="../css/compiled/calendar.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../css/libs/morris.css" type="text/css" />
        <link rel="stylesheet" href="../css/libs/daterangepicker.css" type="text/css" />
        <link rel="stylesheet" href="../css/libs/jquery-jvectormap-1.2.2.css" type="text/css" />

        <!-- Favicon -->
        <link type="image/x-icon" href="../favicon.png" rel="shortcut icon"/>

        <!-- google font libraries -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>
        <style type="text/css">
            a:hover{ text-decoration: none !important;}
        </style>

    </head>
    <body>
        <?php include_once 'admin_header_bar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-2" id="nav-col">
                    <?php include_once 'admin_left_sidebar.php'; ?>
                </div>
                <div class="col-md-10" id="content-wrapper">
                    <div class="row">
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
                                                      
                                                        <th><span>Page Title</span></th>
                                                        <th class="text-center"><span>Publication Status</span></th>
                                                        <th><span>Posted Date</span></th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($page_info as $v_page_info) {
                                                        ?>
                                                        <tr>
                                                            
                                                            <td>
                                                                <?php echo $v_page_info['title']; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($v_page_info['publication_status'] == 1) { ?>
                                                                <a href = "page_unpublished.php?id=<?php echo $v_page_info['id']; ?>">
                                                                        <span class = "label label-danger">Unpublised</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href = "page_published.php?id=<?php echo $v_page_info['id']; ?>">
                                                                        <span class = "label label-success">Published</span>
                                                                    </a>
                                                                <?php } ?>

                                                            </td>
                                                            <td style="width: 10%;">
                                                                <?php
                                                                $data = $v_page_info['created_at'];
                                                                $date_format = date('d M Y H:i A', strtotime($data));
                                                                echo $date_format;
                                                                ?>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <a href="../page.php?id=<?php echo $v_page_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="page_edit.php?id=<?php echo $v_page_info['id']; ?>" class="table-link">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="page_delete.php?id=<?php echo $v_page_info['id']; ?>" class="table-link danger">
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
                                       
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer-bar">
            <p id="footer-copyright">
                &copy; 2014 <a href="http://www.adbee.sk/" target="_blank">Adbee digital</a>. Powered by SuperheroAdmin.
            </p>
        </footer>

        <!-- global scripts -->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>

        <!-- this page specific scripts -->


        <!-- theme scripts -->
        <script src="../js/scripts.js"></script>

        <!-- this page specific inline scripts -->

    </body>
</html>
