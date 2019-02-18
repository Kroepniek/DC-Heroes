var teams = [
    document.getElementsByClassName('team')[0], document.getElementsByClassName('team')[1],
    document.getElementsByClassName('team')[2], document.getElementsByClassName('team')[3],
    document.getElementsByClassName('team')[4]
];

function ChangeTeam(team)
{
    teams.forEach(otherTeam => {
        otherTeam.style.height = "30px";
        otherTeam.children[0].style.color = "black";
    });
    team.style.height = "160px";
    team.children[0].style.color = "#0282F9";
    var teamID = team.getAttribute("teamID");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")
            {
                alert("Server error, try later.");            
            }
            else
            {
                document.getElementById('heroes').innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("team="+teamID);
}

function RateHero(team, heroID)
{
    var teamID = team.getAttribute("teamID");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")
            {
                alert("Server error, try later.");            
            }
            else
            {
                var rating = this.responseText.substr(this.responseText.indexOf('!') + 3);
                rating = rating.substr(0, (rating.charAt(1) == '-' ? 1 : 2));
                SetRightRate(rating);
                document.getElementById('rating').innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("team="+teamID+"&id="+heroID);
}

teams.forEach(team => {
    team.addEventListener("click", function(){ChangeTeam(team)});
});

ChangeTeam(document.getElementsByClassName('team')[0]);