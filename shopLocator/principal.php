<?php
session_start();
require ('config.php');
logged();


require ('header2.php');
?>

<h1 style="h1"> Shop Locator</h1>
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
    <button class="col-sm-offset-10  btn btn-primary btn-lg" type="submit"  > Ajouter un Shop  <span class="glyphicon glyphicon-plus"></span></button>
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
    <script src=" //code.jquery.com/jquery-1.12.4.js "></script>
    <script src=" https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js "></script>
    <script src=" https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js "></script>
    <script>

        $(document).ready(function() {
            $('#example').DataTable();
        });</script>
<table id="example" class="table table-hover" class="table table-striped table-bordered" width="100%" cellspacing="0"     >
    <thead>
<tr><th style=" text-align: center;">TITRE</th>

    <th style=" text-align: center;">TYPE</th>
    <th style=" text-align: center;">VILLE</th>
    <th style=" text-align: center;">ACTION</th>

</tr>
    </thead>
    <tbody>
    <?php
    while($donnees=$requet->fetch())
    {?>
    <tr>
        <td style=" text-align: center;"> <?php echo($donnees['titre']); ?>    </td>
        <td style=" text-align: center;"> <?php echo ($donnees['type']);?> </td>
        <td style=" text-align: center;"> <?php echo($donnees['ville']); ?>    </td>

        <td style=" text-align: center;">

            <p> <a href="modification.php?numid=<? echo $donnees['id'];?>">Modification</a> | <a href="supression.php?numid=<? echo $donnees['id'];?>">Suppression</a> | <a href="geoPosition.php?con=1&numid=<? echo $donnees['id'];?>">Voire</a></p>
        </td>

    </tr>
    <?php }   ?>

    </tbody>
</table>
    <div id="map"></div>
<?php

try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $requete=$bdd->prepare("SELECT * FROM shop");
    $requete->execute();
}
catch (PDOException $e){echo"erreur".$e->getMessage();}
?>
    <script>
        var map = L.map('map').setView([ 36.819 ,  36.819 ], 6);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var myArray1=[];
        var myArray2=[];
        var titre=[];
        <?php while ($donnee=$requete->fetch()){?>

        myArray1.push(<?php echo $donnee['attitude'];?>);
        myArray2.push(<?php echo $donnee['longititude'];?>);

            L.marker([myArray1[0], myArray2[0]]).addTo(map)
            .bindPopup('<?php echo $donnee['titre'];?> <br/> <?php echo $donnee['type'];?> ')
            .openPopup();
        myArray1.shift();
        myArray2.shift();

        <?php } ?>

    </script>
<br/>
<br/>
<?php
require ('footer.php');
?>