
<?php
try {
    include ('config.php');

    $req=" SELECT * FROM shop";
    $requet = $bdd->prepare($req);

    $requet->execute();

}
catch(PDOException $e){
    echo 'echec'.$e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>home</title>
    <meta charset="UTF-8">

</head>
<body>
<h1 style="text-align: center"> shop locator</h1>

<div style="margin-left: auto;
  margin-right: auto ;width: 20% ">
    <form method="POST" action="login.php">  <input  style="float:left;padding: 10px" type="submit" value="login" id="submit"></form>
    <form method="POST" action="signUp.php">  <input style="margin-left: 100px;padding: 10px" type="submit" value="sign up" id="submit"></form>

</div>
<br/>
<br/>
<table border="1" style="margin: auto">
    <tr><td>TITRE</td>

        <td>TYPE</td>
        <td>ADRESSE</td>
        <td>code postal</td>
        <td>pays</td>
        <td>ville</td>
        <td>heur d'ouverture</td>
        <td>jour d'ouverture</td>


    </tr>
    <?php
    while($donnees=$requet->fetch())
    {?>
        <tr>
            <td> <?php echo($donnees['titre']); ?>    </td>
            <td> <?php echo ($donnees['type']);?> </td>
            <td> <?php echo($donnees['adresse']); ?>    </td>
            <td> <?php echo($donnees['code postal']); ?>    </td>
            <td> <?php echo ($donnees['pays']);?> </td>
            <td> <?php echo($donnees['ville']); ?>    </td>
            <td> <?php echo($donnees['heur ouverture']); ?>    </td>
            <td> <?php echo($donnees['jour ouverture']); ?>    </td>


        </tr>
    <?php } ?>


</table>

</body>
</html>