
<?php
session_start();
include ('config.php');

if(!isset($_SESSION['auth'])){
    header('Location:login.php');
    exit();}


if(!empty($_POST))
{
    $titre=$adresse=$type=$heur=$jour=$pays=$ville=$code='';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = test_input($_POST["titre"]);
        $adresse=test_input($_POST["adresse"]);
        $type = test_input($_POST["type"]);
        $code = test_input($_POST["code"]);
        $pays=test_input($_POST["pays"]);
        $ville = test_input($_POST["ville"]);
        $heur=test_input($_POST["heur"]);
        $jour=test_input($_POST["jour"]);


    }
    try {
        $requet = $bdd->prepare("
    INSERT INTO shop(`titre`,`adresse`,`type`,`code postal`,`pays`,`ville`,`heur ouverture`,`jour ouverture`)
    VALUES (:titre,:adresse,:type,:code ,:pays,:ville,:heur ,:jour ) ");
        $requet->bindParam("titre",$titre);
        $requet->bindParam("adresse",$adresse);
        $requet->bindParam("type",$type);
        $requet->bindParam("code",$code);
        $requet->bindParam("pays",$pays);
        $requet->bindParam("ville",$ville);
        $requet->bindParam("heur",$heur);
        $requet->bindParam("jour",$jour);
        $requet->execute();


    }
    catch(PDOException $e){
        echo 'echec'.$e->getMessage();
    }
  header("Location: principal.php?creation=1");

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>modification</title>
    <meta charset="UTF-8">

</head>
<body>
<?php include ('logout.php');
?>
<form  method="post"  >

    <p>  <label for="titre">titre de shop</label>
        <input type="text" name="titre" id="titre">
    </p>
    <p><label for="type">type de shop</label>
        <select name="type" id="type">
            <option value="market"  >market</option>
            <option value="express"  >express</option>
            <option value="outlet"  >outlet</option></select>
    </p>
    <p>  <label for="adresse">adresse de shop</label>
        <input type="text" name="adresse" id="adresse">
    </p>
    <p>  <label for="code">code postal de shop</label>
        <input type="text" name="code" id="code">
    </p>
    <p>  <label for="pays">pays de shop</label>
        <input type="text" name="pays" id="pays">
    </p>
    <p>  <label for="ville">ville de shop</label>
        <input type="text" name="ville" id="ville">
    </p>
    <p>  <label for="heur">heur ouverture de shop</label>
        <input type="text" name="heur" id="heur">
    </p>
    <p>  <label for="jour">heur ouverture de shop</label>
        <select name="jour" id="jour">
            <option value="lundi"  >lundi</option>
            <option value="mardi"  >mardi</option>
            <option value="mercredi"  >mercredi</option>
            <option value="jeudi"  >jeudi</option>
            <option value="vendredi"  >vendredi</option>
            <option value="samdi"  >samdi</option>
            <option value="dimanche"  >dimanche</option>
        </select>

    </p>
    <p>
        <input type="submit" name="creation" />
    </p>
</form>

</body>
</html>