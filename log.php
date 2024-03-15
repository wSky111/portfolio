<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Village Vacances Alpes</title>
</head>
<body class="connexionbody">
    <form method="post" action="PHP/logon.php">
        <div class="principale">
            <h1>Villages Vacances Alpes</h1><br>
            <p class="ajust">Identifiant :</p>
            <input class="taille1" type="text" name="user" placeholder="Entrez votre nom d'utilisateur"><br>
            <p class="ajust">Mot de passe :</p>
            <input class="taille1" type="password" name="mdp" placeholder="Entrez votre mot de passe"><br>
            <input type="submit" class="login" value="Connexion"><br>
            <button class="retour"><a href="index.php" >Retour page principale</a></button>
</body>
</html>