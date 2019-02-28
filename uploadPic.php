<?php
    session_start();

    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
    {
        if (strlen($_FILES['picture']['name']) > 0)
        {
            $target_dir = "img/heroes/";
            $target_file = $target_dir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);
        }
        else
        {
            header('Location: index.php');
        }
    }
    else
    {
        echo "error";
    }
?>