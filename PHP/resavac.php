<?php
include("../LOGBDD/connecteBDD.php");
$noresa = $_REQUEST["NORESA"];
$_SESSION = $_POST['user'];
$datedebsem =$_REQUEST["DATEDEBSEM"];
$noheb = $_REQUEST["NOHEB"];
$codeetat = "AR";
$dateresa = date("Y-m-d");

$datearrhes = date("Y-m-d");
$montantarrhes = $_REQUEST["TARIFSEMHEB"]*0.2;
$nboccupant = $_REQUEST["NBOCCUPANT"];
$tarifsemheb = $_REQUEST["TARIFSEMHEB"];



$sql = "INSERT INTO resa ( NORESA, USER, DATEDEBSEM, NOHEB, DATERESA, DATEARRHES, CODEETATRESA, MONTANTARRHES, NBOCCUPANT, TARIFSEMRESA) VALUES (:NORESA, :user,:DATEDEBSEM,:NOHEB, :DATERESA, :DATEARRHES + interval 4 day, :CODEETAT, :MONTANTARRHES, :NBOCCUPANT,:TARIFSEMHEB)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':NORESA',$noresa);
$stmt->bindParam(':user',$_SESSION);
$stmt->bindParam(':DATEDEBSEM',$datedebsem);
$stmt->bindParam(':NOHEB',$noheb);
$stmt->bindParam(':DATERESA',$dateresa);
$stmt->bindParam(':DATEARRHES',$datearrhes);
$stmt->bindParam(':CODEETAT',$codeetat);
$stmt->bindParam(':MONTANTARRHES',$montantarrhes);
$stmt->bindParam(':NBOCCUPANT',$nboccupant);
$stmt->bindParam(':TARIFSEMHEB',$tarifsemheb);

#$stmt->debugDumpParams();

if ($stmt->execute()) {
    echo "<center><p>Enregistrement effectué</p></center>";
    echo "<center>";
    echo $noresa;
    echo '<br>';
    echo $datedebsem;
    echo "</center>";
    echo '<center><a href="../index.php">Retour</a></center>';
} else {
    echo "<center><h1>Erreur lors de l'enregistrement</h1></center>";
    $error_info = $stmt->errorInfo();
    echo "<center><p>" . $error_info[2] . "</p></center>";
}



?>
