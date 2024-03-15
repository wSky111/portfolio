<?php
    session_start();
   
    if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && $_SESSION["type"] == "Administrateur"){
        
    } else {
        header('location:log.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Vacances Alpes</title>
</head>
<body>
    <div class="banniere">
        <div class="bantitle">
        <h1 class="Title">Village Vacances Alpes</h1>
        </div>
        <div class="banbutton">
        <button class="connexion"><a href="0logout.php">Se déconnecter</a></button>
        </div>
    </div>
        
    <div class="menu">
    <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a><a class="menuchalet" href="enregistrement.php">Enregistrement hébergements</a><a class="menuchalet" href="indexuser.php">Retour</a>
    </div>

    <div class="mobilier">
    <?php
	include("LOGBDD/connecteBDD.php");
    $requete="SELECT *FROM `compte`";
    $resultat= $pdo->query($requete);
    
    ?>

    <center><table border="1" class="table-style">
        <tr><td class="td-style">Nom du compte</td><td class="td-style">Prenom du compte</td><td class="td-style">Type de compte</td><td class="td-style">Adresse mail du compte</td><td class="td-style">Telephone</td><td class="td-style">Telephone portable</td></tr>

    <?php while($enreg=$resultat->fetch())
    {
    ?>
    <tr>
    <td><?php echo $enreg["NOMCPTE"];?></td>
    <td><?php echo $enreg["PRENOMCPTE"];?></td>
    <td><?php echo $enreg["TYPECOMPTE"];?></td>
    <td><?php echo $enreg["ADRMAILCPTE"];?></td>
    <td><?php echo $enreg["NOTELCPTE"];?></td>
    <td><?php echo $enreg["NOPORTCPTE"];?></td>
    </tr>
    <?php  } ?>
    </table></center>
        
    </div>
    
</body>
</html>
