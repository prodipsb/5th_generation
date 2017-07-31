<?php

include_once '../vendor/autoload.php';

use App\Settings;

$settingobj = new Settings();

$settings = $settingobj->show_settings();

if (!isset($settings['title']) || empty($settings['title'])) {
    $settingobj->insert();
}
//echo '<pre>';
//print_r($settings);
//exit();
?>

 <?php include_once 'admin_header.php';?>

        <div class="col-md-10" id="content-wrapper">
            <div class="row">
                <h4 style="color: green; text-align: center;">
                    <?php
                    if (isset($_SESSION['settings_save_mgs'])) {
                        echo $_SESSION['settings_save_mgs'];
                        unset($_SESSION['settings_save_mgs']);
                    }
                    ?>
                </h4>
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-10 col-lg-12">
                            <div class="main-box">
                                <form action="settings_stoer.php" method="POST" enctype="multipart/form-data">
                                    <div class="clearfix">
                                        <h2>Setting</h2>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="title"><h4>Site Title</h4></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                       placeholder="Enter A Title"
                                                       value="<?php echo $settings['title'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="subtitle"><h4>Site Subtile</h4></label>
                                                <input type="text" name="subtitle" class="form-control" id="subtitle"
                                                       placeholder="Enter A Title"
                                                       value="<?php echo $settings['subtitle'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="site_footer"><h4>Site Footer</h4></label>
                                                <input type="text" name="site_footer" class="form-control" id="site_footer"
                                                       placeholder="Enter A Title"
                                                       value="<?php echo $settings['site_footer'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="admin_footer"><h4>Footer Text</h4></label>
                                                <input type="text" name="admin_footer" class="form-control" id="admin_footer"
                                                       placeholder="Enter A Title"
                                                       value="<?php echo $settings['admin_footer'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="logo"><h4>Site Logo Wide</h4></label>
                                                <?php if (isset($settings['logo']) && !empty($settings['logo'])) { ?>
                                                    <img src="<?php echo "../img/logos/" . $settings['logo']; ?>" width="100" height="100">
                                                <?php } ?>
                                                <input type="file" name="logo" class="form-control" id="logo"
                                                       placeholder="Enter A Title"
                                                       value="<?php echo $settings['subtitle'] ?>">
                                            </div>
                                        </div>

                                        <input type="hidden" name="oldimage"
                                               value="<?php echo $settings['logo'] ?>"><br/>


                                        <input type="submit" class="btn btn-default submit" value="Save">
                                        <input type="reset" class="btn btn-default submit" value="Reset"></div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="graph-line" style="max-height: 290px;"></div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
</div>
<?php include_once 'admin_footer.php';?>