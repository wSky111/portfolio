<?php
    session_start();
   
    if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && isset($_SESSION['type']) && $_SESSION['type'] == "Administrateur" ||  $_SESSION['type'] == "Gestionnaire"){
        
    } else {
        header('location:log.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="PHP/addhebergement.php" method="post" enctype="multipart/form-data">
    <div class="banniere">
        <div class="bantitle">
        <h1 class="Title">Village Vacances Alpes</h1>
        </div>
        <div class="banbutton">
        <button class="connexion">
            <?php 
                if(isset($_SESSION["user"]) && isset($_SESSION["mdp"])) echo "<a href='logout.php'>Se déconnecter</a>";
                else echo "<a href='log.php'>S'identifier</a>";
            ?>
        </button>
        </div>
    </div>
        
    <div class="menu">
    <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a><a class="menuchalet" href="enregistrement.php">Enregistrement hébergements</a><a href="../index.php" class="menuretour">Retour</a>
    </div>

    <?php
	include("../LOGBDD/connecteBDD.php");
    $sql="SELECT * FROM `resa`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    ?>

    <center><table border="1" class="">
        <tr><td class="td-style">NORESA</td><td class="td-style">USER</td><td class="td-style">DATEDEBSEM</td><td class="td-style">CODEETATRESA</td><td class="td-style">DATERESA</td><td class="td-style">DATEARRHES</td><td class="td-style">MONTANTARRHES</td><td class="td-style">NBOCCUPANT</td><td class="td-style">TARIFSEMRESA</td><td class="td-style">Modifier les réservations</td></tr>

    <?php while($enreg=$stmt->fetch())
    {
    ?>
    <tr>
    <td><?php echo $enreg["NORESA"];?></td>
    <td><?php echo $enreg["USER"];?></td>
    <td><?php echo $enreg["DATEDEBSEM"];?></td>
    <td><?php echo $enreg["CODEETATRESA"];?></td>
    <td><?php echo $enreg["DATERESA"];?></td>
    <td><?php echo $enreg["DATEARRHES"];?></td>
    <td><?php echo $enreg["MONTANTARRHES"];?></td>
    <td><?php echo $enreg["NBOCCUPANT"];?></td>
    <td><?php echo $enreg["TARIFSEMRESA"];?></td>
    <td><?php echo"<a href='2infosresa.php?num=",$enreg['NORESA'],"''>Modifier</a>";?></td>        
    

    

    </tr>
    <?php  } ?>
    </table></center>

  

    
    
</body>
</html>