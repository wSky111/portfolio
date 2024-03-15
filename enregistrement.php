<?php
    session_start();
   
    if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && isset($_SESSION['type']) && $_SESSION['type'] == "Administrateur" ||  $_SESSION['type'] == "Gestionnaire"){
        
    } else {
        header('location:log.php');
    }
    
?>
<?php 
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `CODETYPEHEB`, `NOMTYPEHEB` FROM `type_heb`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);      
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
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
    <a class="menuchalet" href="consultation.php?nom=C1">Chalet</a><a href="consultation.php?nom=A1" class="menuappartement">Appartement</a><a href="consultation.php?nom=S1" class="menustudio">Studio</a><a class="menuchalet" href="enregistrement.php">Enregistrement hébergements</a><a href="index.php" class="menuretour">Retour</a>
    </div>

    <div class="addcenter">

        <h1 class="addsizetitle">Ajout d'un hébergements</h1>

        <h1 class="noHeb"></h1>
        <input class="addsizeinput" class="addsizeinput" type="hidden" name="NOHEB">

        <h1 class="addsizetext">Code type hébergements</h1>
        <select class="addsizeselect" name="CODETYPEHEB">
            <?php
                foreach($result as $row){

                    echo '<option value="' .$row['CODETYPEHEB']. '">' . $row['NOMTYPEHEB']. '</option>';
                }
                echo '</select>';
            ?>
        </select>

        <h1 class="addsizetext">Nom hébergements</h1>
        <input class="addsizeinput" type="text" name="NOMHEB">

        <h1 class="addsizetext">Nombre de place</h1>
        <input class="addsizeinput" type="number" min="1" max="99" name="NBPLACEHEB">

        <h1 class="addsizetext">Surfarce de l'hébergements</h1>
        <input class="addsizeinput" type="number" min="1" max="999" name="SURFACEHEB">

        <h1 class="addsizetext">Internet</h1>
        <input class="addsizeradio" type="radio" name="INTERNET" value="1">oui<input class="" type="radio" name="INTERNET" value="0">non

        <h1 class="addsizetext">Année hébergements</h1>
        <input class="addsizeinput" type="number" min="0" max="2050" name="ANNEEHEB">

        <h1 class="addsizetext">Secteur de l'hébergements</h1>
        <select class="addsizeinput" name="SECTEURHEB">
            <option>Secteur A</option>
            <option>Secteur B</option>
            <option>Secteur C</option>
            <option>Secteur D</option>
            <option>Secteur E</option>
            <option>Secteur F</option>
        </select>

        <h1 class="addsizetext">Orientation hébergements</h1>
        <select class="addsizeselect" name="ORIENTATIONHEB">
            <option>Nord</option>
            <option>Est</option>
            <option>Ouest</option>
            <option>Sud</option>
        </select>       

        <h1 class="addsizetext">Etat de l'hébergements</h1>
        <select class="addsizeselect" name="ETATHEB">
            <option>Neuf</option>
            <option>d'occasion</option>
        </select>

        <h1 class="addsizetext">Description de l'hébergements</h1>
        <input class="addsizeinput" type="tel" name="DESCRIHEB">

        <h1 class="addsizetext">Photo de l'hébergements</h1>
        <input class="addsizeinput" type="file" name="PHOTOHEB">

        <h1 class="addsizetext">Tarif/semaine de l'hébergements</h1>
        <input class="addsizeinput" type="" name="TARIFSEMHEB"><br>

        <input class="addsizesubmit" type="submit" value="Enregistrer">

    </div>

    </form>
</body>
</html>