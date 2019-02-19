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
            if (!isset($_POST['getInfo']))
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
                //Get info about teams to nav
                $sql = "SELECT Count(*), rating FROM hero NATURAL JOIN rating WHERE heroId = ".$_POST['team'];
                $result = $con->query($sql);

                if ($result->num_rows > 0)
                {
                    print_r($row);
                    while($row = $result->fetch_assoc())
                    {
                        
                    }
                }
                else
                {
                    echo "error";
                }
            }
        }
        else if(isset($_POST['id']) && !isset($_POST['rateComment']))
        {
            if (!isset($_POST['rating']))
            {
                $sql = "SELECT * FROM hero WHERE heroId = ".$_POST['id'];
                $result = $con->query($sql);
                $row = $result->fetch_assoc();

                $heroInfo = $row;

                $sql = "SELECT * FROM rating WHERE heroId = ".$_POST['id'];
                $result = $con->query($sql);

                $heroRatings = array();

                while($row = $result->fetch_assoc()){
                    array_push($heroRatings, $row);
                }

                $averageRating = 0;
                $ratingCount = 0;
                
                foreach ($heroRatings as $oneRate) 
                {
                    $averageRating += $oneRate["rating"];
                    $ratingCount++;
                }

                if ($ratingCount > 0)
                {
                    $averageRating = round($averageRating / $ratingCount);
                }

                echo '
                <div class="show-hero" heroID="'.$heroInfo["heroId"].'">
                    <div id="show-hero-img"><img src="img/heroes/'.$heroInfo["heroImage"].'" height="250" width="250" /></div>
                    <div id="show-hero-rate" onmouseleave="BackToRightRate()">
                        <i class="icon-'.($averageRating > 0 ? ($averageRating > 1 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(0, 1, 2, false)" onclick="RateHover(0, 1, 2, true)"></i>
                        <i class="icon-'.($averageRating > 2 ? ($averageRating > 3 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(1, 3, 4, false)" onclick="RateHover(1, 3, 4, true)"></i>
                        <i class="icon-'.($averageRating > 4 ? ($averageRating > 5 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(2, 5, 6, false)" onclick="RateHover(2, 5, 6, true)"></i>
                        <i class="icon-'.($averageRating > 6 ? ($averageRating > 7 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(3, 7, 8, false)" onclick="RateHover(3, 7, 8, true)"></i>
                        <i class="icon-'.($averageRating > 8 ? ($averageRating > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(4, 9, 10, false)" onclick="RateHover(4, 9, 10, true)"></i>
                    </div>
                    <div id="show-hero-info">
                        <span>'.$heroInfo["heroName"].'</span>
                        <span>
                            '.$heroInfo["heroDescription"].'<br><br>
                            '.$heroInfo["heroPower"].'
                        </span>
                    </div>
                    <div id="show-hero-comment">
                        <p>Write comment:</p>
                        <textarea id="RateComment" placeholder="Write comment, minimum 3 letters..."></textarea>
                        <div id="SubmitComment" onclick="SubmitRate('.$heroInfo['teamId'].')">Submit</div>
                </div>';

                echo '<div id="show-hero-comments">';
                foreach ($heroRatings as $comment) 
                {
                    echo '
                        <div class="comments-comment">
                            <div class="comment-stars">
                                <i class="icon-'.($comment["rating"] > 0 ? ($comment["rating"] > 1 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>
                                <i class="icon-'.($comment["rating"] > 2 ? ($comment["rating"] > 3 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>
                                <i class="icon-'.($comment["rating"] > 4 ? ($comment["rating"] > 5 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>
                                <i class="icon-'.($comment["rating"] > 6 ? ($comment["rating"] > 7 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>
                                <i class="icon-'.($comment["rating"] > 8 ? ($comment["rating"] > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>
                            </div>
                            <span>'.date_format(date_create($comment["ratingDate"]), "d.m.Y | H:i").'</span>
                            <p>
                                '.$comment["ratingReview"].'
                            </p>
                        </div>
                    ';
                }
                echo '
                </div>
                </div>
                <!--'.$averageRating.'-->';
            }
            else
            {
                echo "error";
            }
        }
        else if(isset($_POST['rateComment']))
        {
            $sql = "INSERT INTO rating VALUES(NULL, ".intval($_POST['id']).", ".intval($_POST['rating']).", NOW(), \"".$_POST['rateComment']."\")";

            if ($con->query($sql) === TRUE) {
                echo "ok";
            } 
            else 
            {
                echo "error";
            }
        }
    }
    $con->close();
?>


