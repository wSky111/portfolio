<?php
    session_start();
?>

<html>
    <body>
        <?php
            include("../LOGBDD/connecteBDD.php");

            $user = $_POST["user"];
            $mdp = $_POST["mdp"];

           
            

            $requete = "SELECT * FROM compte WHERE USER = :user AND MDP = :mdp";
            $prepared_request = $pdo->prepare($requete);
            $prepared_request->bindParam(':user', $user);
            $prepared_request->bindParam(':mdp', $mdp);
            $prepared_request->execute();

            $ligne = $prepared_request->rowCount();
            $result = $prepared_request->fetch();

           

            if ($ligne==1 and $result['TYPECOMPTE'] =='Vacancier'){
                 header("location:../index.php");
                 $_SESSION["type"] = $result['TYPECOMPTE'];
                 $_SESSION["user"] = $_POST['user'];
                 $_SESSION["mdp"] = $_POST['mdp'];
                }
            else if ($ligne==1 and $result['TYPECOMPTE'] == 'Gestionnaire'){
                 header("location:../index.php");
                 $_SESSION["type"] = $result['TYPECOMPTE'];
                 $_SESSION["user"] = $_POST['user'];
                 $_SESSION["mdp"] = $_POST['mdp'];
                }
            else if ($ligne==1 and $result['TYPECOMPTE'] == 'Administrateur'){
                header("location:../index.php");
                $_SESSION["type"] = $result['TYPECOMPTE'];
                 $_SESSION["user"] = $_POST['user'];
                 $_SESSION["mdp"] = $_POST['mdp'];
            }
            else
                 header("location:../logfail.php");
                

        ?>
    </body>
</html>