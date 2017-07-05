<?php
session_start();
require ('config.php');
logged();

require ('header2.php');
?>

<h1 style="text-align: center"> shop locator</h1>
<h1 style="text-align: center"><?

    if(isset($_GET['welcom'])){$welcom=$_GET['welcom'];
        if($welcom!=0){echo "welcom ".$_GET['nom'];} }
    ?>
</h1 style="text-align: center">
<h1><?
    if(isset($_GET['update'])){$update=$_GET['update'];
        if($update!=0){echo "successful update";} }
    ?>

</h1>
<h1 style="text-align: center"><?
    if(isset($_GET['creation'])){$creation=$_GET['creation'];
        if($creation!=0){echo "successful creation";} }
    ?></h1>
<h1 style="text-align: center"><?
    if(isset($_GET['delete'])){$delete=$_GET['delete'];
        if($delete!=0){echo "successful delete";} }
    ?></h1>
<form action="creation.php" method="post">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="creation" >
</form>
<?php

try {
    $requet = $bdd->prepare("
               SELECT * FROM shop");
    $requet->execute();
    }
catch(PDOException $e){
    echo 'echec'.$e->getMessage();
}
?>
<br/>
<br/>
<table class="table table-condensed"    >
    <thead>
<tr><th>TITRE</th>

    <th>TYPE</th>
    <th>ADRESSE</th>
    <th>choix</th>

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

        <td>

                <a href="modification.php?numid=<? echo $donnees['id'];?>">modification</a><a href="supression.php?numid=<? echo $donnees['id'];?>"> | suppression</a>

        </td>

    </tr>
    <?php }





   ?>

    </tbody>
</table>
<?php
require ('footer.php');
?>