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
    xmlhttp.send("team="+teamID+"&q=changeTeam");
}

function RateHero(teamID, heroID)
{
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
    xmlhttp.send("team="+teamID+"&id="+heroID+"&q=rateHero");
}

function GetInfo(team)
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
                if (this.responseText != "error")
                {
                    var response = JSON.parse(this.responseText);
                    team.children[2].innerHTML = '<img src="img/' + response[0] + '" class="team-foto"></img>';
                    team.children[3].innerHTML = "Amount members: " + response[1];
                    team.children[4].innerHTML = '<div class="info-stars">' +
                    '<i class="icon-'+(response[2] > 0 ? (response[2] > 1 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-info"></i>' +
                    '<i class="icon-'+(response[2] > 2 ? (response[2] > 3 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-info"></i>' +
                    '<i class="icon-'+(response[2] > 4 ? (response[2] > 5 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-info"></i>' +
                    '<i class="icon-'+(response[2] > 6 ? (response[2] > 7 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-info"></i>' +
                    '<i class="icon-'+(response[2] > 8 ? (response[2] > 9 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-info"></i></div>';
                }
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("team="+teamID+"&q=getInfo");
}

function RemoveHero(teamID, heroID)
{
    var team = teams[teamID - 1];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")
            {
                alert("Server error, try later.");            
            }
            else
            {
                ChangeTeam(team);
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+heroID+"&q=removeHero");
}

function RemoveRate(rateID, teamID, heroID)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "error")
            {
                alert("Server error, try later.");            
            }
            else
            {
                RateHero(teamID, heroID);
                GetInfo(document.getElementsByClassName('team')[teamID - 1]);
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+heroID+"&team="+teamID+"&rateId="+rateID+"&q=removeRate");
}

function AddNewHeroPopup()
{
    var main = document.getElementById('container');

    //Background
    var alphaBg = document.createElement("div");
    alphaBg.id = "alpha-bg";
    
    main.appendChild(alphaBg);

    //Popup
    var popupBg = document.createElement("div");
    popupBg.id = "popup-bg";

    alphaBg.appendChild(popupBg);

    //Popup labels, inputs

    //Hero Name
    var label = document.createElement("p");
    label.classList = "popup-label";
    var node = document.createTextNode("Set Hero name:");
    var input = document.createElement("input");
    input.type = "text";
    input.name = "hero-name";
    input.classList = "popup-input";
    label.appendChild(node);

    popupBg.appendChild(label);
    popupBg.appendChild(input);

    //Hero Description
    label = document.createElement("p");
    label.classList = "popup-label";
    node = document.createTextNode("Set Hero description:");
    input = document.createElement("textarea");
    input.type = "text";
    input.name = "hero-desc";
    input.classList = "popup-text";
    input.rows = 5;
    label.appendChild(node);
    
    popupBg.appendChild(label);
    popupBg.appendChild(input);
    
    //Hero Image
    label = document.createElement("p");
    label.classList = "popup-label";
    node = document.createTextNode("Set Hero picture:");
    input = document.createElement("input");
    input.type = "file";
    input.name = "hero-picture";
    input.classList = "popup-picture";
    label.appendChild(node);
    
    popupBg.appendChild(label);
    popupBg.appendChild(input);
}

window.onload = function()
{
    teams.forEach(team => {
        GetInfo(team);
    });
}

teams.forEach(team => {
    team.addEventListener("click", function(){ChangeTeam(team)});
});

ChangeTeam(document.getElementsByClassName('team')[0]);