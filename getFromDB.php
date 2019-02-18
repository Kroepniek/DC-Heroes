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
            if (!isset($_POST['rating']))
            {
                $sql = "SELECT * FROM hero NATURAL JOIN rating WHERE heroId = ".$_POST['id'];
                $result = $con->query($sql);

                if ($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();
                    
                    echo '
                    <div class="show-hero" heroID="'.$row["heroId"].'">
                        <div><img src="img/heroes/'.$row["heroImage"].'" height="250" width="250" /></div>
                        <div onmouseleave="BackToRightRate()">
                            <i class="icon-'.($row["rating"] > 0 ? ($row["rating"] > 1 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(0, 1, 2, false)" onclick="RateHover(0, 1, 2, true)"></i>
                            <i class="icon-'.($row["rating"] > 2 ? ($row["rating"] > 3 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(1, 3, 4, false)" onclick="RateHover(1, 3, 4, true)"></i>
                            <i class="icon-'.($row["rating"] > 4 ? ($row["rating"] > 5 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(2, 5, 6, false)" onclick="RateHover(2, 5, 6, true)"></i>
                            <i class="icon-'.($row["rating"] > 6 ? ($row["rating"] > 7 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(3, 7, 8, false)" onclick="RateHover(3, 7, 8, true)"></i>
                            <i class="icon-'.($row["rating"] > 8 ? ($row["rating"] > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(4, 9, 10, false)" onclick="RateHover(4, 9, 10, true)"></i>
                        </div>
                        <div>
                            <span>'.$row["heroName"].'</span>
                            <span>
                                '.$row["heroDescription"].'<br><br>
                                '.$row["heroPower"].'
                            </span>
                        </div>
                        <div>
                            <p>Write comment:</p>
                            <textarea id="RateComment"></textarea>
                            <div id="SubmitComment" onclick="SubmitRate('.$row['teamId'].')">Submit</div>
                        </div>';

                    //Make foreach for each review (show comment, date of it etc.)

                    echo '
                    </div>
                    <!--'.$row["rating"].'-->';
                }
                else
                {
                    echo "error";
                }
            }
            else
            {
                $sql = "INSERT INTO rating VALUES(NULL, ".intval($_POST['id']).", ".intval($_POST['rating']).", NOW(), \"".$_POST['rateComment']."\")";

                if ($con->query($sql) === TRUE) {
                    echo "Najsiwo";
                } else {
                    echo "error";
                }
            }
        }
        $con->close();
    }
?>