<?php
    session_start();
?>

<?php
include("../LOGBDD/connecteBDD.php");

$noheb = $_REQUEST["noheb"];
$code = $_REQUEST["code"];
$nom = $_REQUEST["nomheb"];
$nbplace = $_REQUEST["nbplace"];
$surface = $_REQUEST["surface"];
$internet = $_REQUEST["internet"];
$annee = $_REQUEST["annee"];
$secteur = $_REQUEST["secteur"];
$orientation = $_REQUEST["orientation"];
$etat = $_REQUEST["etat"];
$descr = $_REQUEST["descr"];
$photo = $_REQUEST["photo"];
$tarif = $_REQUEST["tarif"];


$requete = "UPDATE `hebergement` SET CODETYPEHEB = ?, NOMHEB = ?, NBPLACEHEB = ?, SURFACEHEB = ?, INTERNET = ?, ANNEEHEB = ?, SECTEURHEB = ?, ORIENTATIONHEB = ?, ETATHEB = ?, DESCRIHEB = ?, PHOTOHEB = ?, TARIFSEMHEB = ? WHERE NOHEB = ?";
$prepared_request = $pdo->prepare($requete);
$prepared_request->bindParam(1, $code);
$prepared_request->bindParam(2, $nom);
$prepared_request->bindParam(3, $nbplace);
$prepared_request->bindParam(4, $surface);
$prepared_request->bindParam(5, $internet);
$prepared_request->bindParam(6, $annee);
$prepared_request->bindParam(7, $secteur);
$prepared_request->bindParam(8, $orientation);
$prepared_request->bindParam(9, $etat);
$prepared_request->bindParam(10, $descr);
$prepared_request->bindParam(11, $photo);
$prepared_request->bindParam(12, $tarif);
$prepared_request->bindParam(13, $noheb);
$prepared_request->execute();

$ligne = $prepared_request->rowCount();



if ($ligne==1){
     header("location:../index.php");
}
else
     header("location:index.php");
?>