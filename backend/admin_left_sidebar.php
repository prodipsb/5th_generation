<?php
include_once '../vendor/autoload.php';
if (!isset($_SESSION)) {
    session_start();
}

use App\Users;

$userobj = new Users();
$user_id = $_SESSION['user_id'];
$user_access = $userobj->view_user($user_id);
//echo '<pre>';
//print_r($user_info);
//exit();
?>
<section id="col-left">
    <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
        <ul class="nav nav-pills nav-stacked">
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                    <?php if ($user_access['is_admin'] == 1) { ?>
                        <li>
                            <a href="users.php">
                                User list
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="user-profile.php">
                            User profile
                        </a>
                    </li>
                    <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="user_add.php">
                            Add User
                        </a>
                    </li>
                     <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Menus</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                     
                    <li>
                        <a href="menu_add.php">
                            Add Menu
                        </a>
                    </li>
                    <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="menus_manage.php">
                            Manage Menus
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Categories</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="category_add.php">
                            Add Category
                        </a>
                    </li>
                     <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="category_manage.php">
                            Manage Categories
                        </a>
                    </li>
                     <?php } ?>
                </ul>
            </li>

            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Articles</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="add_article.php">
                            Add Article
                        </a>
                    </li>
                      <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="manage_article.php">
                            Manage Article
                        </a>
                    </li>
                     <?php } ?>
                </ul>
            </li>

            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Page</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="page_add.php">
                            Add Page
                        </a>
                    </li>
                     <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="page_manage.php">
                            Manage Pages
                        </a>
                    </li>
                      <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fa fa-users"></i>
                    <span>Sliders</span>
                    <i class="fa fa-chevron-circle-down drop-icon"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="slider_add.php">
                            Add Slider
                        </a>
                    </li>
                     <?php if ($user_access['is_admin'] == 1) { ?>
                    <li>
                        <a href="slider_manage.php">
                            Manage Sliders
                        </a>
                    </li>
                     <?php } ?>
                </ul>
            </li>
            <?php if ($user_access['is_admin'] == 1) { ?>
                <li>
                    <a href="settings.php">
                        <i class="fa fa-money"></i>
                        <span>Settings</span>
                    </a>
                </li>
            <?php } ?>


        </ul>
    </div>
</section>