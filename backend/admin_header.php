<?php
if(!isset($_SESSION)){
    session_start();
}
if ($_SESSION['user_id']) {
    
} else {
    header('location:../index.php');
}
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


    </head>
    <body>
      <?php include_once 'admin_header_bar.php';?>
        <div class="container">

            <div class="row">

                
                <div class="col-md-2" id="nav-col">
                    <?php include_once 'admin_left_sidebar.php';?>
                </div>
