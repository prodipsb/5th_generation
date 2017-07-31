<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once '../vendor/autoload.php';

use App\Profiles;

$profileobj = new Profiles();
$user_id = $_SESSION['user_id'];
$user_profile_info = $profileobj->view_user_details($user_id);

//echo '<pre>';
//print_r($user_profile_info);
//exit();
?>
<header class="navbar" id="header-navbar">
    <div class="container">
        <a href="../index.php" id="logo" class="navbar-brand col-md-3 col-sm-3 col-xs-12" target="blank">
            <img src="../img/logo.png" alt=""/> <span>Visit Site</span>
        </a>

        <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>

        <div class="nav-no-collapse pull-right" id="header-nav">
            <ul class="nav navbar-nav pull-right">
                
                
                
                <li class="dropdown profile-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if (isset($user_profile_info['image']) && !empty($user_profile_info['image'])) { ?>
                            <img src="../img/profile_pics/<?php echo $user_profile_info['image']; ?>" width="35" height="35" alt=""/>
                        <?php } else { ?>
                            <img src="../img/samples/Unknown_Person.png" width="35" height="35" alt=""/>

                        <?php } ?>
                        <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="user-profile.php"><i class="fa fa-user"></i>Profile</a></li>
                        <li><a href="../logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</header>