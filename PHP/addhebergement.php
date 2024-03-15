<?php
include("../LOGBDD/connecteBDD.php");
$noheb = $_REQUEST["NOHEB"];
$codetypeheb = $_REQUEST["CODETYPEHEB"];
$nomheb = $_REQUEST["NOMHEB"];
$nbplaceheb = $_REQUEST["NBPLACEHEB"];
$surfaceheb = $_REQUEST["SURFACEHEB"];
$internet = $_REQUEST["INTERNET"];
$anneeheb = $_REQUEST["ANNEEHEB"];
$secteurheb = $_REQUEST["SECTEURHEB"];
$orientationheb = $_REQUEST["ORIENTATIONHEB"];
$etatheb = $_REQUEST["ETATHEB"];
$descriheb = $_REQUEST["DESCRIHEB"];
$tarifsemheb = $_REQUEST["TARIFSEMHEB"];

$file = $_FILES["PHOTOHEB"];
$file_name = $_FILES["PHOTOHEB"]["name"];
$file_tmp_name = $_FILES["PHOTOHEB"]["tmp_name"];

$path= "site_images/$file_name";


$sql= "INSERT INTO `hebergement`( NOHEB, CODETYPEHEB, NOMHEB, NBPLACEHEB, SURFACEHEB, INTERNET, ANNEEHEB, SECTEURHEB, ORIENTATIONHEB, ETATHEB, DESCRIHEB, PHOTOHEB, TARIFSEMHEB) VALUES (:NOHEB, :CODETYPEHEB, :NOMHEB, :NBPLACEHEB, :SURFACEHEB, :INTERNET, :ANNEEHEB, :SECTEURHEB, :ORIENTATIONHEB, :ETATHEB, :DESCRIHEB, :PHOTOHEB, :TARIFSEMHEB)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':NOHEB', $noheb);
$stmt->bindParam(':CODETYPEHEB', $codetypeheb);
$stmt->bindParam(':NOMHEB', $nomheb);
$stmt->bindParam(':NBPLACEHEB', $nbplaceheb);
$stmt->bindParam(':SURFACEHEB', $surfaceheb);
$stmt->bindParam(':INTERNET', $internet);
$stmt->bindParam(':ANNEEHEB', $anneeheb);
$stmt->bindParam(':SECTEURHEB', $secteurheb);
$stmt->bindParam(':ORIENTATIONHEB', $orientationheb);
$stmt->bindParam(':ETATHEB', $etatheb);
$stmt->bindParam(':DESCRIHEB', $descriheb);
$stmt->bindParam(':PHOTOHEB', $file_name);
$stmt->bindParam(':TARIFSEMHEB', $tarifsemheb);

if ($stmt->execute()) {
    move_uploaded_file($file_tmp_name, $path);
    echo "<center><p>Confirmation de l'enregistrement</p></center>";
    echo '<center><a href="../index.php">Retour</a></center>';
} else {
    echo "<center><h1>Erreur lors de l'enregistrement</h1></center>";
    $error_info = $stmt->errorInfo();
    echo "<center><p>" . $error_info[2] . "</p></center>";
}

$pdo = null;
?>
