
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
        <div class="banbutton2">
        <button class="connexion"><a href="0login.php">Se connecter</a></button>
        </div>
    </div>
        
    <div class="menu">
    <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href=" consultation.php?nom=S1" class="menustudio">Studio</a><a href="index.php" class="menuretour">Retour</a>
    </div>

    <?php
	include("LOGBDD/connecteBDD.php");

    $search = $_GET['search'];
    $sql="SELECT * FROM `hebergement` WHERE CONCAT(CODETYPEHEB, NOMHEB, NBPLACEHEB, SURFACEHEB, INTERNET, ANNEEHEB, SECTEURHEB, ORIENTATIONHEB, ETATHEB, DESCRIHEB, TARIFSEMHEB) LIKE '%$search%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    ?>
       
    <?php while($enreg=$stmt->fetch())
    {
    ?>
    <div style="border:1px solid black; width:1000px; height:450px; margin-left:500px; margin-top:10px; border-radius:8px;">
    <div style="width:100px; height:600px; height:300px; float:left;">
    <?php echo "<img src='site_images/".$enreg['PHOTOHEB']."' style='margin-top:10px;width:640px;height:420px;border-radius:8px;margin-left:5px;'>"?>
    </div>
    <div style="float:left; width:280px; margin-left:560px;margin-top:80px;">
    <p class="nomheb">Nom hébergement : <?php echo $enreg["NOMHEB"];?></p>
    <p class="nbplaceheb">Nombre de place : <?php echo $enreg["NBPLACEHEB"];?> place</p>
    <p class="surfaceheb">Surface de l'hébergement : <?php echo $enreg["SURFACEHEB"];?> m²</p>
    <p class="secteurheb">Tarif/semaine de l'hébergement : <?php echo $enreg["TARIFSEMHEB"];?> €</p>
    <button class="consulter"><?php if(isset($_SESSION["type"]) && $_SESSION["type"] == "Gestionnaire")
                                        echo"<a href='infoshebergement.php?num=",$enreg['NOMHEB'],"''>Consulter</a>";
                                        elseif(isset($_SESSION["type"]) && $_SESSION["type"] == "Administrateur")
                                        echo"<a href='infoshebergement.php?num=",$enreg['NOMHEB'],"''>Consulter</a>";
                                    elseif(isset($_SESSION["type"]) && $_SESSION["type"] == "Vacancier")
                                        echo"<a href='infoshebergement.php?num=",$enreg['NOMHEB'],"''>Consulter</a>";
                                ?>
                                <?php
                                if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && isset($_SESSION['type'])){
                                 
                                } else {
                                    echo"<a href='infoshebergement.php?num=",$enreg['NOMHEB'],"''>Consulter</a>";
                                }
                             ?>
    </div>
    </div>
          
    

    

    
    <?php  } ?>
    
</body>
</html>