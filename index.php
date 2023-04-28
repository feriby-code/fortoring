<?php

session_start();
require 'connection.php';
require 'session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortoring</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- My CSS -->
    <?php
    require 'css/style.php';
    ?>
</head>
<body>
    <div class="bg-loader">
        <div class="loader"></div>
    </div>

    <?php
    require 'functions/function.php';
    require 'items/item_header.php';
    require 'items/item_menu_sidebar.php';
    showProfile($conn);
    addActivity($conn);
    if ($_SESSION['login'] == true) {
        if (isset($_GET['pagination'])) {
            $pagination = $_GET['pagination'];
            switch ($pagination) {
                case 'home':
                    require_once 'items/item_home.php';
                    break;
                case 'code_reader':
                    require 'items/item_code_reader.php';
                    chooseActivity($conn);
                    break;
                case 'open_camera':
                    if (isset($_GET['type'], $_GET['act'])) {
                        global $typeAct;
                        global $act;
                        global $nickname;
                        global $checkAct;
                        global $alertPresence;

                        $typeAct = $_GET['type'];
                        $act = $_GET['act'];
                        require 'items/item_camera.php';
                        getFeedbackAct();
                        if (isset($_GET['nim'])) {
                            global $nim;
                            $nim = $_GET['nim'];
                            getPresence($conn, $typeAct, $act, $nim);
                        }
                    }
                    break;
                case 'activity':
                    require 'items/item_activity.php';
                    break;
                case 'add%users':
                    require 'items/item_add_user.php';
                    break;
            }
        }
    }
    ?>

    <!-- My Script -->
    <?php
    require 'js/script.php';
    ?>
</body>
</html>