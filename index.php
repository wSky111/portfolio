<?php
    session_start(); 
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
        <button class="connexion">
            <?php 
                if(isset($_SESSION["user"]) && isset($_SESSION["mdp"])) echo "<a href='logout.php'>Se déconnecter</a>";
                else echo "<a href='log.php'>S'identifier</a>";
            ?>
        </button>
        </div>
    </div>
    <?php
       if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && isset($_SESSION['type'])){
        
       } else {
        echo'<div class="menu">';
        echo '<a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a>';
    echo'</div>';
       }
    ?>
      <!-- nav bar vacancier --> 
      <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "Vacancier" ):?>
        <div class="menu">
         <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a>
     </div>
    
    <?php endif; ?>
    <!-- nav bar vacancier -->  


    <!-- nav bar gestionnaire -->  
    <?php if (isset($_SESSION['type']) && $_SESSION['type']== "Gestionnaire" ): ?>
    <div class="menu">
        <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a><a class="menuchalet" href="enregistrement.php">Enregistrement hébergements</a>
    </div>
    
    <?php endif; ?>
    <!-- nav bar gestionnaire -->  


    <!-- nav bar admin -->
    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "Administrateur" ): ?> 
    <div class="menu">
        <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a><a class="menuchalet" href="enregistrement.php">Enregistrement hébergements</a><a class="menuchalet" href="Identifiant.php">Identifiant</a>
    </div>
    
    <?php endif; ?>
    <!-- nav bar admin --> 
    <form action="searchnouser.php" method="get">
    <div class="recherche">
        <input class="search2" name="search" type="search"><input class="search" type="submit" value="Rechercher">

    </div>
    </form>

    <div class="mobilier">
        <div class="chalet">
            <img class="imgchalet" src="IMAGE/test2.png">
            <div class="poschalet">
            <a href="consultation.php?nom=C1" class="txtchalet">Chalet</a>
            </div>
        </div>

        <div class="appartement">
            <img class="imgappartement" src="IMAGE/test3.webp">
            <div class="posappartement">
            <a href="consultation.php?nom=A1" class="txtappartement">Appartement</a>
            </div>
        </div>

        <div class="studio">
            <img class="imgstudio" src="IMAGE/test4.jpg">
            <div class="posstudio">
            <a href="consultation.php?nom=S1" class="txtstudio">Studio</a>
            </div>
        </div>
    </div>
    
    <?php if (isset($_SESSION['type']) && $_SESSION['type']== "Gestionnaire"): ?>
        <form method="POST" action="PHP/researchdate.php">
    <div class="datesearch">
        Date de début :<select class="" name="DATEDEBSEM"> 
            <option ></option>
            <?php
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `DATEDEBSEM`, `DATEFINSEM` FROM `semaine`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);    
                
                
            
                foreach($result as $row){

                    echo '<option value="' .$row['DATEDEBSEM']. '">' . $row['DATEDEBSEM']. '</option>';
                }
                echo '</select><br>';
           
            ?>
            Numéro d'hébergements:<select class="" name="NOHEB">
            <option></option>
                 <?php
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `NOHEB` FROM `resa`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);    
                
                
            
                foreach($result as $row){

                    echo '<option value="' .$row['NOHEB']. '">' . $row['NOHEB']. '</option>';
                }
                echo '</select><br>';
           
            ?>

        <input type="submit"><br>
        <a href="PHP/listeresa.php">liste réservation</a>
        </div>
        </form>
        <?php endif; ?>

        <?php if (isset($_SESSION['type']) && $_SESSION['type']== "Administrateur"): ?>
        <form method="POST" action="PHP/researchdate.php">
    <div class="datesearch">
        Date de début :<select class="" name="DATEDEBSEM"> 
            <option ></option>
            <?php
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `DATEDEBSEM`, `DATEFINSEM` FROM `semaine`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);    
                
                
            
                foreach($result as $row){

                    echo '<option value="' .$row['DATEDEBSEM']. '">' . $row['DATEDEBSEM']. '</option>';
                }
                echo '</select><br>';
           
            ?>
            Numéro d'hébergements:<select class="" name="NOHEB">
            <option></option>
                 <?php
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `NOHEB` FROM `resa`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);    
                
                
            
                foreach($result as $row){

                    echo '<option value="' .$row['NOHEB']. '">' . $row['NOHEB']. '</option>';
                }
                echo '</select><br>';
           
            ?>

        <input type="submit"><br>
        <a href="PHP/listeresa.php">liste réservation</a>
        </div>
        </form>
        <?php endif; ?>

    
            </form>
    
</body>
</html>