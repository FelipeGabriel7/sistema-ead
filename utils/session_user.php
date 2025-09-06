<?php

function create_session()
{
        if (!isset($_SESSION)) {
                session_start();
        }
}

function create_sessions_user($user)
{
        create_session();
        $_SESSION['user'] = $user['id'];


        if (isset($user['isAdmin'])) {
                $_SESSION['userAdmin'] = $user['isAdmin'];
        }

        header("Location: index.php");
}
