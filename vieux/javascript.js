// Fonction qui permet de diriger l'utilisateur admin vers le site ADMIN
//
function traiteSiAdmin(allerVers)
{
    var courriel = document.getElementById("exampleInputEmail1").value;
    var motDePasse = document.getElementById("exampleInputPassword1").value;
    courriel = courriel.trim();
    motDePasse = motDePasse.trim();

    if (courriel == "admin" && motDePasse == "admin")
    {
        window.document.location.href = '../admin/index.html';     
    }
    else
    {
        window.document.location.href = allerVers;     
    } 
}

// Fonction qui permet de diriger un type button vers un page spécifique
//
function traiteConnexion(allerVers)
{
    window.document.location.href = allerVers;     
}