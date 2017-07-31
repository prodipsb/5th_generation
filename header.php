<?php
if(!isset($_SESSION)){
    session_start();
}
include_once 'vendor/autoload.php';

use App\Settings;
$settingobj = new Settings();
$settings = $settingobj->show_settings();


use App\Menus;

$menuobj = new Menus();
$all_menus = $menuobj->select_all_published_menus();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $settings['title']." | ".$settings['subtitle'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <!-- css -->
        <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="css/jcarousel.css" rel="stylesheet" />
        <link href="css/flexslider.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <link href="css/libs/font-awesome.css" type="text/css" rel="stylesheet" />
        <!-- Theme skin -->
        <link href="skins/default.css" rel="stylesheet" />


    </head>
    <body>
        <div id="wrapper">
            <!-- start header -->
            <header>
                <div class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php"><img src="<?php echo"img/logos/".$settings['logo']; ?>" height="50" width="200" ></a>
                        </div>
                        <div class="navbar-collapse collapse ">
                            <ul class="nav navbar-nav">

                                <?php
                                foreach ($all_menus as $v_menu) {
                                    if ($v_menu['sub_id'] == 1) {
                                        ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"><?php echo $v_menu['title']; ?> <b class=" icon-angle-down"></b></a>
                                            <ul class="dropdown-menu">
                                                <?php
                                                foreach ($all_menus as $s_menu) {
                                                    if ($s_menu['parent_id'] == $v_menu['id']) {
                                                        ?>
                                                        <li><a href="<?php echo $s_menu['url']; ?>"><?php echo $s_menu['title']; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>

                                    <?php } elseif ($v_menu['sub_id'] == 0) { ?>

                                        <li><a href="<?php echo $v_menu['url']; ?>"><?php echo $v_menu['title']; ?></a></li>

                                        <?php
                                    }
                                }
                                ?>

                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <li><a href="backend/dashboard.php" target="blank">Dashboard</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="login.php">Login</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- end header -->