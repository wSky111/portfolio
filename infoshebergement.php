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
        <div class="banbutton2">
        <button class="connexion">
            <?php 
                if(isset($_SESSION["user"]) && isset($_SESSION["mdp"])) echo "<a href='logout.php'>Se déconnecter</a>";
                else echo "<a href='log.php'>S'identifier</a>";
            ?>
        </button>
        </div>
    </div>
        
    <div class="menu">
        <a class="menuchalet" href="consultationnouser.php?nom=C1">Chalet</a><a href="consultationnouser.php?nom=A1" class="menuappartement">Appartement</a><a href="consultationnouser.php?nom=S1" class="menustudio">Studio</a><a href="index.php" class="menuretour">Retour</a>
    </div>
    <!--Vacancier-->
    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "Vacancier" ):?>
        <?php
	include("LOGBDD/connecteBDD.php");
	$code = $_GET['num'];
    $sql="SELECT * FROM `hebergement` WHERE NOMHEB = :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    
    ?>
       
    <?php while($enreg=$stmt->fetch())
    {
    ?>
    <div style="width:1000px; margin-left:20px; margin-top:10px; border-radius:8px;float:left;">
    <div style="width:100px; height:600px; height:300px;">
    <?php echo "<img src='site_images/".$enreg['PHOTOHEB']."' style='margin-top:10px;width:640px;height:420px;border-radius:8px;margin-left:145px;'>"?>
    </div>
    <div style="width:250px; margin-left:190px;margin-top:140px;">

    <div style="width:240px;height:380px;float:left;">
    <?php echo "<input type='hidden' name='NOHEB' class='' value='" . $enreg["NOHEB"] . "'>"; ?>
    <p style="color:grey; font-size:18px;">Nom hébergement :</p>
    <?php echo $enreg["NOMHEB"];?>
    <p style="color:grey; font-size:18px;">Nombre de place :</p>
    <?php echo $enreg["NBPLACEHEB"];?>
    <p style="color:grey; font-size:18px;">Surface de l'hébergement :</p>
    <?php echo $enreg["SURFACEHEB"];?>
    <p style="color:grey; font-size:18px;">Internet :</p>
    <?php  if($enreg["INTERNET"]==1)echo "oui";
            if($enreg["INTERNET"]==0)echo "non";?>
    <p style="color:grey; font-size:18px;">Année herbegement :</p>
    <?php echo $enreg["ANNEEHEB"];?>
    </div>
   
    <div style="width:240px;height:380px;margin-left:380px;">
    <p style="color:grey; font-size:18px;">Secteur hebergement :</p>
    <?php echo $enreg["SECTEURHEB"];?>
    <p style="color:grey; font-size:18px;">Orientation hebergement :</p>
    <?php echo $enreg["ORIENTATIONHEB"];?>
    <p style="color:grey; font-size:18px;">Etat hebergement :</p>
    <?php echo $enreg["ETATHEB"];?>
    <p style="color:grey; font-size:18px;">Description hebergement :</p>
    <?php echo $enreg["DESCRIHEB"];?>
    <p style="color:grey; font-size:18px;">Tarif semaine hebergement :</p>
    <?php echo $enreg["TARIFSEMHEB"];?>€
    </div>
    </div>
    </div>
    <form action="PHP/resavac.php" method="post">
    <input class="addsizeinput" class="addsizeinput" type="hidden" name="NORESA">
    <?php echo "<input type='hidden' name='NOHEB' class='' value='" . $enreg["NOHEB"] . "'>"; ?>
    <?php echo "<input type='hidden' name='TARIFSEMHEB' class='' value='" . $enreg["TARIFSEMHEB"] . "'>"; ?>
    <?php echo "<input type='hidden' name='user' class='' value='" . $_SESSION["user"] . "'>"; ?>
        <div style="width:420px;border:1px solid black;height:100px;margin-left:1000px;margin-top:10px;border-radius:8px;">
        Nombre de personne: <input type="number" max='<?php echo $enreg["NBPLACEHEB"]?>' min="1" name="NBOCCUPANT"><br>
        Date début:<select class="" name="DATEDEBSEM"> <?php
                include("LOGBDD/connecteBDD.php");

                $requete= "SELECT `DATEDEBSEM`, `DATEFINSEM` FROM `semaine`";
                $stmt = $pdo->prepare($requete);
                $stmt->execute();
                $result= $stmt->fetchall(PDO::FETCH_ASSOC);    
                
                
            
                foreach($result as $row){

                    echo '<option value="' .$row['DATEDEBSEM']. '">' . $row['DATEDEBSEM']. '</option>';
                }
                echo '</select>';
           
            ?>
            <input style="width:150px;height: 30px;border-radius: 20px;border: none;background-color: grey;margin-left:120px;margin-top:10px;" type="submit" value="Reservez">
        
    </div>
            </form>
    <?php  } ?>
    <?php endif; ?>
    <!--Vacancier-->

    <!--Gestionnaire-->
    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "Gestionnaire" ):?>
        <form action="PHP/updateheb.php" method="post">
        <div style="margin-left:800px;">
    <?php 
    include("LOGBDD/connecteBDD.php"); 
    $code = $_GET['num'];

    $sql = "SELECT * FROM `hebergement` WHERE NOMHEB = :code";
    $stmt = $pdo ->prepare($sql);
    $stmt ->bindParam(':code', $code);
    $stmt -> execute();
?>
     <?php while($row=$stmt->fetch())
    {
    ?>

       <?php 
       echo "<input type='hidden' name='noheb' class='' value='" . $row["NOHEB"] . "'>";
        echo "<p class=''>Nom de l'hebergement</p>";
        echo "<input name='nomheb' class='' value='" . $row["NOMHEB"] . "'>";
        echo "<p class=''>Code type hebergement</p>";
        echo "<input name='code' class='' value='" . $row["CODETYPEHEB"] . "'>";
		echo "<p class=''>Nombre de place de l'hebergement</p>";
        echo "<input name='nbplace' class='' type='number' min='1' max='99' value='" . $row["NBPLACEHEB"] . "'>";
		echo "<p class=''>Surface de l'hebergement</p>";
        echo "<input name='surface' class='' type='number' min='1' max='999' value='" . $row["SURFACEHEB"] . "'>";
        echo "<p class=''>Internet</p>";
        echo "<input name='internet' class='' value='" . $row["INTERNET"] . "'>";
        echo "<p class=''>Année de l'hebergement</p>";
        echo "<input name='annee' class='' type='number' min='0' max='2050' value='" . $row["ANNEEHEB"] . "'>";
        echo "<p class=''>Secteur de l'hebergement</p>";
        echo "<input name='secteur' class='' value='" . $row["SECTEURHEB"] . "'>";
        echo "<p class=''>Orientation de l'hebergement</p>";
        echo "<input name='orientation' class='' value='" . $row["ORIENTATIONHEB"] . "'>";
        echo "<p class=''>Etat de l'hebergement</p>";
        echo "<input name='etat' class='' value='" . $row["ETATHEB"] . "'>";
        echo "<p class=''>Description de l'hebegement</p>";
        echo "<input name='descr' class='' value='" . $row["DESCRIHEB"] . "'>";
        echo "<p class=''>Photo de l'hebergement</p>";
        echo "<input name='photo' type='hidden' class='' value='" . $row["PHOTOHEB"] . "'>";
        echo "<p class=''>Tarif par semaine de l'hebergement</p>";
        echo "<input name='tarif' class='' value='" . $row["TARIFSEMHEB"] . "'>";?>
  
  <?php
    }
    ?>
</div>

<input class="addsizesubmit" type="submit" value="Enregistrer">
</form>
<?php endif; ?>

 <!--Gestionnaire-->
 

  <!--Administrateur-->
  <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "Administrateur" ):?>
        <div style="margin-left:800px;">
    <?php 
    include("LOGBDD/connecteBDD.php"); 
    $code = $_GET['num'];

    $sql = "SELECT * FROM `hebergement` WHERE NOMHEB = :code";
    $stmt = $pdo ->prepare($sql);
    $stmt ->bindParam(':code', $code);
    $stmt -> execute();
?>
     <?php while($row=$stmt->fetch())
    {
    ?>

       <?php echo "<p class=''>Nom de l'hebergement</p>";
        echo "<input name='' class='' value='" . $row["NOMHEB"] . "'>";
		echo "<p class=''>Nombre de place de l'hebergement</p>";
        echo "<input name='' class='' type='number' min='1' max='99' value='" . $row["NBPLACEHEB"] . "'>";
		echo "<p class=''>Surface de l'hebergement</p>";
        echo "<input name='' class='' type='number' min='1' max='999' value='" . $row["SURFACEHEB"] . "'>";
        echo "<p class=''>Internet</p>";
        echo "<input name='' class='' value='" . $row["INTERNET"] . "'>";
        echo "<p class=''>Année de l'hebergement</p>";
        echo "<input name='' class='' type='number' min='0' max='2050' value='" . $row["ANNEEHEB"] . "'>";
        echo "<p class=''>Secteur de l'hebergement</p>";
        echo "<input name='' class='' value='" . $row["SECTEURHEB"] . "'>";
        echo "<p class=''>Orientation de l'hebergement</p>";
        echo "<input name='' class='' value='" . $row["ORIENTATIONHEB"] . "'>";
        echo "<p class=''>Etat de l'hebergement</p>";
        echo "<input name='' class='' value='" . $row["ETATHEB"] . "'>";
        echo "<p class=''>Description de l'hebegement</p>";
        echo "<input name='' class='' value='" . $row["DESCRIHEB"] . "'>";
        echo "<p class=''>Photo de l'hebergement</p>";
        echo "<input name='' type='file' class='' value='" . $row["PHOTOHEB"] . "'>";
        echo "<p class=''>Tarif par semaine de l'hebergement</p>";
        echo "<input name='' class='' value='" . $row["TARIFSEMHEB"] . "'>";?>
  
  <?php
    }
    ?>
</div>
<?php endif; ?>
 <!--Administrateur-->

    
    <?php
     if ($_SESSION['type'] == null  ):?>
    <?php
	include("LOGBDD/connecteBDD.php");
	$code = $_GET['num'];
    $sql="SELECT * FROM `hebergement` WHERE NOMHEB = :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    
    ?>
       
    <?php while($enreg=$stmt->fetch())
    {
    ?>
    <div style="width:1000px; margin-left:480px; margin-top:10px; border-radius:8px;">
    <div style="width:100px; height:600px; height:300px;">
    <?php echo "<img src='site_images/".$enreg['PHOTOHEB']."' style='margin-top:10px;width:640px;height:420px;border-radius:8px;margin-left:145px;'>"?>
    </div>
    <div style="width:250px; margin-left:190px;margin-top:140px;">

    <div style="width:240px;height:380px;float:left;">
    <p style="color:grey; font-size:18px;">Nom hébergement :</p>
    <?php echo $enreg["NOMHEB"];?>
    <p style="color:grey; font-size:18px;">Nombre de place :</p>
    <?php echo $enreg["NBPLACEHEB"];?>
    <p style="color:grey; font-size:18px;">Surface de l'hébergement :</p>
    <?php echo $enreg["SURFACEHEB"];?>
    <p style="color:grey; font-size:18px;">Internet :</p>
    <?php echo $enreg["INTERNET"];?>
    <p style="color:grey; font-size:18px;">Année herbegement :</p>
    <?php echo $enreg["ANNEEHEB"];?>
    </div>
   
    <div style="width:240px;height:380px;margin-left:380px">
    <p style="color:grey; font-size:18px;">Secteur hebergement :</p>
    <?php echo $enreg["SECTEURHEB"];?>
    <p style="color:grey; font-size:18px;">Orientation hebergement :</p>
    <?php echo $enreg["ORIENTATIONHEB"];?>
    <p style="color:grey; font-size:18px;">Etat hebergement :</p>
    <?php echo $enreg["ETATHEB"];?>
    <p style="color:grey; font-size:18px;">Description hebergement :</p>
    <?php echo $enreg["DESCRIHEB"];?>
    <p style="color:grey; font-size:18px;">Tarif semaine hebergement :</p>
    <?php echo $enreg["TARIFSEMHEB"];?>€
    </div>
    <button style="width:150px;height: 30px;border-radius: 20px;border: none;background-color: grey;margin-left:200px"><a href="log.php">Se connecter</a></button>

    </div>
    </div>
    <?php  } ?>
    <?php endif; ?>
</body>
</html>