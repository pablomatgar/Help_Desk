function displayComplaint(complaint){ //Displays a concrete complaint when clicking on it
    location.replace("./display.php?id=" + complaint);
}

function logIn(){ //Displays login form
    var div = document.getElementById("logIn");

    div.removeAttribute("hidden");
}

function load(){ //Load the view when you are inside the system (logged in)
    var div = document.getElementsByClassName("signinbtn").item(0);

    div.innerText = "LOG OUT";

    div.setAttribute('onclick','logOut()');

    var div = document.getElementsByClassName("signin_title").item(0);

    div.parentNode.removeChild(div);

}

function searchComplaint(){ //Search button
    if(document.forms["searchForm"]["search"].value==''){
        location.reload();
    }
    else{
        var items = document.getElementsByClassName("legend_style");
        for (i=0; i < items.length; i++) {
            if(items[i].getAttribute('onclick')!='displayComplaint('+document.forms["searchForm"]["search"].value+')'){
                items[i].parentNode.removeChild(items[i]);
            }
        }
    }  
}

function logOut(){ //Log out button
    var r = confirm("Are you sure you want to log out?");
    if (r == true) {
        location.replace("./index.php?action=logOut");
    }
}
