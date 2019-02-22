var teams = [
    document.getElementsByClassName('team')[0], document.getElementsByClassName('team')[1],
    document.getElementsByClassName('team')[2], document.getElementsByClassName('team')[3],
    document.getElementsByClassName('team')[4]
];

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
                    team.children[4].innerHTML = '<div class="comment-stars">' +
                    '<i class="icon-'+(response[2] > 0 ? (response[2] > 1 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-comment"></i>' +
                    '<i class="icon-'+(response[2] > 2 ? (response[2] > 3 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-comment"></i>' +
                    '<i class="icon-'+(response[2] > 4 ? (response[2] > 5 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-comment"></i>' +
                    '<i class="icon-'+(response[2] > 6 ? (response[2] > 7 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-comment"></i>' +
                    '<i class="icon-'+(response[2] > 8 ? (response[2] > 9 ? 'star' : 'star-half-alt') : 'star-empty')+' rate-star-comment"></i></div>';
                }
            }
        }
    };
    xmlhttp.open("POST", "getFromDB.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("team="+teamID+"&getInfo=true");
}

window.onload = function()
{
    teams.forEach(team => {
        GetInfo(team);
    });
}
