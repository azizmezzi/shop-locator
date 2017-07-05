<?php require ('header.php');
?>

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

<br/>
<br/>
<h1 class="h1 col-sm-offset-4">Shop Locator</h1>
<table class="table table-hover" border="1" style="margin: auto;">
    <thead>
    <tr><th>TITRE</th>

        <th>TYPE</th>
        <th>ADRESSE</th>
        <th>code postal</th>
        <th>pays</th>
        <th>ville</th>
        <th>heur d'ouverture</th>
        <th>jour d'ouverture</th>


    </tr>
    </thead>
    <tbody>
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

    </tbody>
</table>
<?php  require  'footer.php';?>