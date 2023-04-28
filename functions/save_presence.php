<?php
    require '../connection.php';

    $participant = $_POST['participant'];
    $idAct = $_POST['id_act'];
    $nimPresenceTemp = $_POST['presence'];
    $nimNotPrecenseTemp = $_POST['notPresence'];
    $nim = "";
    if ($participant == 'college_student') {
        if ($nimNotPrecenseTemp == NULL && $nimPresenceTemp == NULL){
            mysqli_query($conn, "UPDATE college_student_presence SET `$idAct`='0';");
            header('location: ../?pagination=activity');
        } elseif (isset($_POST['presence'])) {
            for ($i = 0; $i <= count($nimPresenceTemp) - 1; $i++) {
                if ($i == 0) {
                    $nim = $nimPresenceTemp[$i];
                } else {
                    $nim = $nim . "," . $nimPresenceTemp[$i];
                }
            }
            mysqli_query($conn, "UPDATE college_student_presence SET `$idAct`='1' WHERE nim_college_student IN($nim);");
            header('location: ../?pagination=activity');
        } elseif (isset($_POST['notPresence'])) {
            for ($i = 0; $i <= count($nimNotPrecenseTemp) - 1; $i++) {
                if ($i == 0) {
                    $nim = $nimNotPrecenseTemp[$i];
                } else {
                    $nim = $nim . "," . $nimNotPrecenseTemp[$i];
                }
            }
            mysqli_query($conn, "UPDATE college_student_presence SET `$idAct`='0' WHERE NOT nim_college_student IN($nim);");
            header('location: ../?pagination=activity');
        }
    } elseif ($participant == 'management') {
        if ($nimNotPrecenseTemp == NULL && $nimPresenceTemp == NULL){
            mysqli_query($conn, "UPDATE management_presence SET `$idAct`='0';");
            header('location: ../?pagination=activity');
        } elseif (isset($_POST['presence'])) {
            for ($i = 0; $i <= count($nimPresenceTemp) - 1; $i++) {
                if ($i == 0) {
                    $nim = $nimPresenceTemp[$i];
                } else {
                    $nim = $nim . "," . $nimPresenceTemp[$i];
                }
            }
            mysqli_query($conn, "UPDATE management_presence SET `$idAct`='1' WHERE nim_management IN($nim);");
            header('location: ../?pagination=activity');
        } elseif (isset($_POST['notPresence'])) {
            for ($i = 0; $i <= count($nimNotPrecenseTemp) - 1; $i++) {
                if ($i == 0) {
                    $nim = $nimNotPrecenseTemp[$i];
                } else {
                    $nim = $nim . "," . $nimNotPrecenseTemp[$i];
                }
            }
            mysqli_query($conn, "UPDATE management_presence SET `$idAct`='0' WHERE NOT nim_management IN($nim);");
            header('location: ../?pagination=activity');
        }
    }
?>