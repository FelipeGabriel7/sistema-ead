<?php

include("./utils/session_user.php");
include("./utils/protected.php");


$pageInitial = "inicial.php";
$initialPath = "/pages/";
$adminPath = "/pages/admin/";
$page = '';


if (!isset($_SESSION)) {
    session_start();
}


if ($_SESSION['userAdmin'] == 0) {
    include("./utils/functions.php");
    verify_protected_route(0);
}

if ($_SESSION['userAdmin'] == 1) {
    verify_protected_route(1);
}

if (isset($_GET['p']) && $_SESSION['userAdmin'] == 1) {
    $route_page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING) . ".php";

    // se for "perfil", não está na pasta admin
    if ($route_page === "perfil.php") {
        $page = $initialPath . $route_page;
    } else {
        $page = $adminPath . $route_page;
    }
} else if (isset($_GET['p'])) {
    $route_page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING) . ".php";
    $page = $initialPath . $route_page;
} else {
    $page = $initialPath . $pageInitial;
}


function get_name_user($item)
{
    include("./database/conexao.php");
    $user = $_SESSION['user'];

    $sql_code = "SELECT * FROM usuarios WHERE id = '$user'";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
    $sql_exec = $sql_exec->fetch_assoc();

    return $sql_exec[$item];
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> EAD - Sistema</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content="flat ui, admin  Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
</head>

<body>
    <?php include('./templates/header.php');  ?>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">

            <div class="main-body">
                <div class="page-wrapper">
                    <?php
                    if (file_exists("." . $page)) {
                        include("." . $page);
                    } else {
                        http_response_code(404);
                        include("./pages/404.php");
                    }
                    ?>

                    <div id="styleSelector">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="assets/js/classie/classie.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/demo-12.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
</body>

</html>