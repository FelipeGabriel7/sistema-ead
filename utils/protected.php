<?php
if (!function_exists("verify_protected_route")) {
        function verify_protected_route($admin)
        {
                if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                }

                if (!isset($_SESSION['user'])) {
                        die("<script>window.location.href='login.php';</script>");
                }

                if ($admin === 1 && $_SESSION['userAdmin'] != 1) {
                        die("<script>window.location.href='login.php';</script>");
                }
        }
}
