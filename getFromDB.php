<?php
    session_start();

    if (isset($_POST['q']))
    {
        require "connect.php";

        if ($con->connect_error) 
        {
            echo "error";
            exit;
        }

        if ($_POST['q'] == "changeTeam")
        {
            $sql = "SELECT heroId, heroName, heroDescription, heroImage FROM hero WHERE teamId = ".$_POST['team'];
            $result = $con->query($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo '
                    <div class="hero" onclick="RateHero('.$_POST['team'].', '.$row["heroId"].')">
                        <div><img src="img/heroes/'.$row["heroImage"].'" height="230" width="170" /></div>
                        <div>';
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
                    {
                        echo'<icon class="remove-min remove-hero icon-trash-empty" onclick="RemoveHero('.$_POST['team'].', '.$row["heroId"].')"></icon>';
                    }
                    echo '        
                            <span>'.$row["heroName"].'</span>
                            <span>'.$row["heroDescription"].'</span>
                        </div>
                    </div>';
                }
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
                {
                    echo '
                        <div class="hero-add" onclick="AddNewHeroPopup('.$_POST['team'].')">
                            <p>+</p>
                        </div>';
                }
            }
            else
            {
                echo "error";
            }
        }
        else if ($_POST['q'] == "getInfo")
        {
            $members = 0;
            $rating = 0;
            $image = "";
            
            $sql = "SELECT COUNT(*) FROM hero WHERE teamId = ".$_POST['team'];
            $result = $con->query($sql);
            
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $members = $row["COUNT(*)"];
            }
            else
            {
                $members = "error";
            }

            $sql = "SELECT rating FROM rating NATURAL JOIN hero, team WHERE hero.teamId = team.teamId AND team.teamId = ".$_POST['team'];
            $result = $con->query($sql);
                
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $rating += $row["rating"];
                }
                $rating = $rating / $result->num_rows;
            }
            else
            {
                $rating = "0";
            }

            $sql = "SELECT teamImage FROM team WHERE teamId = ".$_POST['team'];
            $result = $con->query($sql);

            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $image = $row["teamImage"];
            }
            else
            {
                $image = "error";
            }

            if ($members == "error" || $rating == "error" || $image == "error")
            {
                echo "error";
            }
            else
            {
                
                $return = array($image, $members, $rating);
                echo json_encode($return);
            }
        }
        else if ($_POST['q'] == "rateHero")
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

            echo '<div class="show-hero" heroID="'.$heroInfo["heroId"].'">';

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
            {
                echo '<div class="edit-hero editing icon-pencil-1" id="edit-button" onclick="EditHero('.$_POST["team"].', '.$heroInfo["heroId"].')"></div>';
            }

            echo '    
                <div id="show-hero-img">
                    <img id="hero-image-cnt" src="img/heroes/'.$heroInfo["heroImage"].'" height="250" width="250" />
                </div>
                <div id="show-hero-rate" onmouseleave="BackToRightRate()">
                    <i class="icon-'.($averageRating > 0 ? ($averageRating > 1 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(0, 1, 2, false)" onclick="RateHover(0, 1, 2, true)"></i>
                    <i class="icon-'.($averageRating > 2 ? ($averageRating > 3 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(1, 3, 4, false)" onclick="RateHover(1, 3, 4, true)"></i>
                    <i class="icon-'.($averageRating > 4 ? ($averageRating > 5 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(2, 5, 6, false)" onclick="RateHover(2, 5, 6, true)"></i>
                    <i class="icon-'.($averageRating > 6 ? ($averageRating > 7 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(3, 7, 8, false)" onclick="RateHover(3, 7, 8, true)"></i>
                    <i class="icon-'.($averageRating > 8 ? ($averageRating > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star" onmousemove="RateHover(4, 9, 10, false)" onclick="RateHover(4, 9, 10, true)"></i>
                </div>
                <div id="show-hero-info">
                    <span>
                        <div id="hero-name-place">'.$heroInfo["heroName"].'</div>
                    </span>
                    <span>
                        <div id="hero-desc-place">'.$heroInfo["heroDescription"].'</div>
                        <br><br>
                        <div id="hero-pwrs-place">'.$heroInfo["heroPower"].'</div>
                    </span>
                    </div>
                <div id="show-hero-comment">
                    <p>Write comment:</p>
                    <textarea id="RateComment" placeholder="Write comment, minimum 3 letters..." required></textarea>
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
                            <i class="icon-'.($comment["rating"] > 8 ? ($comment["rating"] > 9 ? 'star' : 'star-half-alt') : 'star-empty').' rate-star-comment"></i>';

                if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
                {
                    echo '<div class="remove-min remove-rate" onclick="RemoveRate('.$comment["ratingId"].', '.$_POST["team"].', '.$_POST["id"].')"></div>';
                }

                echo '
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
        else if ($_POST['q'] == "submitRate")
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
        else if ($_POST['q'] == "removeHero")
        {
            $sql = "DELETE FROM hero WHERE heroId = ".$_POST['id'];

            if ($con->query($sql) === TRUE) {
                echo "ok";
            }
            else 
            {
                echo "error";
            }
        }
        else if ($_POST['q'] == "removeRate")
        {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
            {
                $sql = "DELETE FROM rating WHERE ratingId = ".$_POST['rateId'];

                if ($con->query($sql) === TRUE) {
                    echo "ok";
                }
                else 
                {
                    echo "error";
                }
            }
        }
        else if ($_POST['q'] == "addHero")
        {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
            {
                $sql = "INSERT INTO hero VALUES (NULL, \"".$_POST['heroName']."\", \"".$_POST['heroDesc']."\", \"".$_POST['heroPwrs']."\", \"".$_POST['heroPicName']."\", ".intval($_POST['heroTeam']).")";

                if ($con->query($sql) === TRUE) {
                    echo "ok";
                }
                else 
                {
                    echo "error";
                }
            }
        }
        else if ($_POST['q'] == "editHero")
        {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true")
            {
                $sql = "UPDATE hero SET heroName = \"".$_POST['heroName']."\", heroDescription = \"".$_POST['heroDesc']."\", heroPower = \"".$_POST['heroPwrs']."\", heroImage = \"".$_POST['heroPicName']."\" WHERE heroId = ".$_POST['heroId'];

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
    }
?>