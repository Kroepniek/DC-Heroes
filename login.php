<?php
    session_start();

    if (isset($_POST['pass']))
    {
        if ($_POST['pass'] == "root")
        {
            $_SESSION['admin'] = "true";
            echo "ok";
        }
        else if ($_POST['pass'] == "logout")
        {
            unset($_SESSION['admin']);
            echo "ok";
        }
    }
    else
    {
        header('Location: index.php');
    }
?>