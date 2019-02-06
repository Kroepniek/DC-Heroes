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
                $_SESSION['heroId'] = $_POST['id'];
                $_SESSION['ratingId'] = $row["rating.ratingId"];
                
                echo '
                <div class="show-hero">
                    <div><img src="img/heroes/'.$row["hero.heroImage"].'" height="250" width="250" /></div>
                    <div>
                        <i class="icon-'.$row["rating.rating"] > 0 ? $row["rating.rating"] > 1 ? 'star' : 'star-half-alt' : 'star-empty'.' rate-star"></i>
                        <i class="icon-'.$row["rating.rating"] > 2 ? $row["rating.rating"] > 3 ? 'star' : 'star-half-alt' : 'star-empty'.' rate-star"></i>
                        <i class="icon-'.$row["rating.rating"] > 4 ? $row["rating.rating"] > 5 ? 'star' : 'star-half-alt' : 'star-empty'.' rate-star"></i>
                        <i class="icon-'.$row["rating.rating"] > 6 ? $row["rating.rating"] > 7 ? 'star' : 'star-half-alt' : 'star-empty'.' rate-star"></i>
                        <i class="icon-'.$row["rating.rating"] > 8 ? $row["rating.rating"] > 9 ? 'star' : 'star-half-alt' : 'star-empty'.' rate-star"></i>
                    </div>
                    <div>
                        <span>'.$row["hero.heroName"].'</span>
                        <span>
                            '.$row["hero.heroDescription"].'<br>
                            '.$row["hero.heroPower"].'
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