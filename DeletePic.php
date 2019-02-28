<?php
    session_start();

    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
    {
        if (isset($_POST['picToDelete']))
        {
            $target_dir = "img/heroes/";
            $target_file = $target_dir . $_POST['picToDelete'];
            if (!unlink($target_file))
            {
                echo ("error");
            }
            else
            {
                echo ("ok");
            }
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