var emailsUtilisateursChecked = new Array();
//Array Remove 
Array.prototype.remove = function (from, to)
{
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};

//fonction appele a c chak fois k il y a un check ou uncheck pour prendre
//l email des utilisateurt checked
function checkall(input)
{
    alert(input.value);
}

function eventCheck(email)
{
    i = 0;
    //on cherche l email dans le tableau
    while (i < emailsUtilisateursChecked.length)
    {
        if (emailsUtilisateursChecked[i] == email)
        {//si on le trouve on l enleve et on kitte
            emailsUtilisateursChecked.remove(i);
            //alert(emailsUtilisateursChecked);
            return;
        }

        i++;
    }

    //puisk l email ne s y trouve pas on l ajoute
    emailsUtilisateursChecked.push(email);
    //alert(emailsUtilisateursChecked);
}

function modifyUser()
{
    if (emailsUtilisateursChecked.length > 1 || emailsUtilisateursChecked.length < 1)
    {
        alert("veillez  cocher un et un seul  utilisateur pour la modification");
        return;
    }
    email = emailsUtilisateursChecked[0];

    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("modifUser").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "addUtilisateur.php?modifier=1&&email=" + email, true);
    xmlhttp.send();
}

function addUser()
{
    email = "darcia@yahoo.fr";

    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("modifUser").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "addUtilisateur.php?ajouter=1&email=" + email, true);
    xmlhttp.send();
}

function deleteUser()
{
    if (emailsUtilisateursChecked.length > 1 || emailsUtilisateursChecked.length < 1)
    {
        alert("veillez  cocher un et un seul  utilisateur pour la suppression");
        return;
    }
    email = emailsUtilisateursChecked[0];

    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("modifUser").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "deleteUser.php?rechercher=1&&email=" + email, true);
    xmlhttp.send();
}

function confirmDelete(id)
{

    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("deleteUser").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "deleteUser.php?suppr=1&&id=" + id, true);
    xmlhttp.send();
}



function controle()
{
    mdp = document.getElementById("mdp").value;
    vmdp = document.getElementById("vmdp").value;
    if (mdp != "")
    {
        if (mdp.length >= 5)
        {
            document.getElementById("saveUserBtn").disabled = false;
            document.getElementById("notification").className = "alert-info alert-dismissable";
            document.getElementById("notification").innerHTML = "Le mot de passe est OK. ";
            if (mdp == vmdp)
            {
                document.getElementById("saveUserBtn").disabled = false;
                document.getElementById("notification").className = "alert-info alert-dismissable";
                document.getElementById("notification").innerHTML = "Les mots de passe correspondent maintenant. ";
            } else
            {
                document.getElementById("saveUserBtn").disabled = true;
                document.getElementById("notification").className = "alert-danger alert-dismissable";
                document.getElementById("notification").innerHTML = "Les mots de passe ne correspondent pas ! VÃ©rifiez encore.";
            }
        } else
        {
            document.getElementById("saveUserBtn").disabled = true;
            document.getElementById("notification").className = "alert-danger alert-dismissable";
            document.getElementById("notification").innerHTML = "Le mot de passe est trop court. Il doit Ãªtre supÃ©rieur ou Ã©gal Ã  5 caractÃ¨res";
        }
    }
}
