<?php

    if (isset($_POST['team']))
    {
        require "connect.php";

        if ($con->connect_error) 
        {
            echo "error";
            exit;
        } 

        $sql = "SELECT heroName, heroDescription, heroImage FROM hero WHERE teamId = ".$_POST['team'];
        $result = $con->query($sql);

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo '
                <div class="hero">
                    <div><img src="img/heroes/'.$row["heroImage"].'" height="230" width="170" /></div>
                    <div>
                        <span>'.$row["heroName"].'</span>
                        <span>'.$row["heroDescription"].'</span>
                    </div>
                </div>';
            }
        }
        else
        {
            echo "error";
        }

        $con->close();
    }
?>