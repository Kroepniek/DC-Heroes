<?php

    if (isset($_POST['team']))
    {
        session_start();

        require "connect.php";

        if ($con->connect_error) 
        {
            echo "error";
            exit;
        }

        if (!isset($_POST['id']))
        {
            $sql = "SELECT heroId, heroName, heroDescription, heroImage FROM hero WHERE teamId = ".$_POST['team'];
            $result = $con->query($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo '
                    <div class="hero" onclick="RateHero(this, '.$row["heroId"].')">
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
        }
        else
        {
            $sql = "SELECT * FROM hero NATURAL JOIN rating WHERE heroId = ".$_POST['id'];
            $result = $con->query($sql);

            

            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();

                //print_r($row);

                $_SESSION['heroId'] = $_POST['id'];
                $_SESSION['ratingId'] = $row["ratingId"];
                
                echo '
                <div class="show-hero">
                    <div><img src="img/heroes/'.$row["heroImage"].'" height="250" width="250" /></div>
                    <div>
                        <i class="icon-'.($row["rating"] > 0 ? ($row["rating"] > 1 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star"></i>
                        <i class="icon-'.($row["rating"] > 2 ? ($row["rating"] > 3 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star"></i>
                        <i class="icon-'.($row["rating"] > 4 ? ($row["rating"] > 5 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star"></i>
                        <i class="icon-'.($row["rating"] > 6 ? ($row["rating"] > 7 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star"></i>
                        <i class="icon-'.($row["rating"] > 8 ? ($row["rating"] > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star"></i>
                    </div>
                    <div>
                        <span>'.$row["heroName"].'</span>
                        <span>
                            '.$row["heroDescription"].'<br>
                            '.$row["heroPower"].'
                        </span>
                    </div>
                </div>';
            }
            else
            {
                echo "error";
            }
        }

        $con->close();
    }
?>