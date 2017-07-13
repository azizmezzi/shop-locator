<?php    include ('config.php');
require ('header.php');
?>

<?php

try {

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
<br/>
<br/>
    <script src=" //code.jquery.com/jquery-1.12.4.js "></script>
    <script src=" https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js "></script>
    <script src=" https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js "></script>
    <script>

        $(document).ready(function() {
            $('#example').DataTable();
        });</script>
<table id="example" class="table table-hover" class="table table-striped table-bordered" width="100%" cellspacing="0" border="1" style="margin: auto;">
    <thead>
    <tr><th>TITRE</th>

        <th>TYPE</th>

        <th>VILLE</th>
        <th>ACTION</th>


    </tr>
    </thead>
    <tbody>
    <?php
    while($donnees=$requet->fetch())
    {?>
        <tr>
            <td> <?php echo($donnees['titre']); ?>    </td>
            <td> <?php echo ($donnees['type']);?> </td>

            <td> <?php echo($donnees['ville']); ?>    </td>
            <td>

               <a  href="geoPosition.php?con=2&numid=<? echo $donnees['id'];?>">VOIRE</a>
            </td>


        </tr>
    <?php }?>
    </tbody>
</table>




<br/>
<br/>
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

    <?php  require  'footer.php';?>