var stars = document.getElementsByClassName('rate-star');
var rightRate = 0;
var curRate = 0;
var tempRate = -1;

var teams = [
    document.getElementsByClassName('team')[0], document.getElementsByClassName('team')[1],
    document.getElementsByClassName('team')[2], document.getElementsByClassName('team')[3],
    document.getElementsByClassName('team')[4]
];

function SetRightRate(x)
{
    rightRate = x;
}

function RateHover(index, left, right, click)
{
    if (event.clientX > stars[index].offsetLeft && event.clientX < stars[index].offsetLeft + 32)
    {
        curRate = left;
    }
    else if (event.clientX > stars[index].offsetLeft + 32 && event.clientX < stars[index].offsetLeft + 64)
    {
        curRate = right;
    }

    if (click)
    {
        rightRate = curRate;
        document.getElementById('RateComment').focus();
    }

    if (curRate != tempRate)
    {
        tempRate = curRate;

        for (var x = 0; x < stars.length; x++)
        {
            stars[x].classList = "icon-star-empty rate-star";
        }

        for (var i = 0; i < Math.ceil(curRate / 2); i++)
        {
            if (i == Math.ceil(curRate / 2) - 1)
            {
                if (curRate % 2 != 0)
                {
                    stars[i].classList = "icon-star-half-alt rate-star";
                }
                else
                {
                    stars[i].classList = "icon-star rate-star";
                }
            }
            else
            {
                stars[i].classList = "icon-star rate-star";
            }
        }
    }
}

function BackToRightRate()
{
    for (var x = 0; x < stars.length; x++)
    {
        stars[x].classList = "icon-star-empty rate-star";
    }

    for (var i = 0; i < Math.ceil(rightRate / 2); i++)
    {
        if (i == Math.ceil(rightRate / 2) - 1)
        {
            if (rightRate % 2 != 0)
            {
                stars[i].classList = "icon-star-half-alt rate-star";
            }
            else
            {
                stars[i].classList = "icon-star rate-star";
            }
        }
        else
        {
            stars[i].classList = "icon-star rate-star";
        }
    }

    curRate = 0;
    tempRate = -1;
}

function SubmitRate(team)
{
    var teamID = team;
    var heroID = document.getElementsByClassName('show-hero')[0].getAttribute("heroID");
    var rating = rightRate;
    var rateComment = document.getElementById('RateComment').value;
    alert(rateComment);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")
            {
                alert("Server error, try later.");            
            }
            else
            {
                alert(this.responseText);
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("team="+teamID+"&id="+heroID+"&rating="+rating+"&rateComment="+rateComment);
}