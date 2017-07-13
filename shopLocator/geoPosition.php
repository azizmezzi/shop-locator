<?php

session_start();
require ('config.php');


require ('header2.php');
$id=$_GET['numid'];
$con=$_GET['con'];
$req=$bdd->prepare("
SELECT * FROM shop WHERE `id`=:id    ");
$req->bindParam(":id",$id);
$req->execute();
while($donnees=$req->fetch())

{
    ?>


    <h1 class="h1"> SHOP : <?php echo($donnees['titre']); ?>    <a href="principal.php" class="col-sm-offset-7 btn btn-success btn-lg" >Retour Accueil</a></h1>


<br>
    <table class="table table-condensed">
    <thead>
    <tr>
        <th>TITRE</th>

        <th>TYPE</th>
        <th>ADRESSE</th>
        <th>code postal</th>
        <th>pays</th>
        <th>ville</th>
        <th>attitude</th>
        <th>longititude</th>
        <th>heur d'ouverture</th>
        <th>jour d'ouverture</th>


    </tr>
    </thead>
    <tbody>
    <tr>
        <td id="titre"> <?php echo($donnees['titre']); ?>    </td>
        <td id="type"> <?php echo ($donnees['type']);?> </td>
        <td id="adresse"> <?php echo($donnees['adresse']); ?>    </td>
        <td> <?php echo($donnees['code postal']); ?>    </td>
        <td> <?php echo ($donnees['pays']);?> </td>
        <td> <?php echo($donnees['ville']); ?>    </td>
        <td id="lat"> <?php echo($donnees['attitude']); ?>    </td>
        <td id="lng"> <?php echo($donnees['longititude']); ?>    </td>
        <td> <?php echo($donnees['heur ouverture']); ?>    </td>

        <td> <?php echo $donnees['jour ouverture']     ;?>    </td>


    </tr>
<?php } ?>
    </tbody>

    </table>
    <div id="map"></div>

    <script type="text/javascript">
        var titre=document.getElementById('titre').innerHTML;
        var type=document.getElementById('type').innerHTML;
        var adresse=document.getElementById('adresse').innerHTML;

        var description=titre + "<br> " + type + "<br> " +adresse ;
       var lat=document.getElementById('lat').innerHTML;
       var lng=document.getElementById('lng').innerHTML;
       var map = L.map('map').setView([lat, lng], 3);

       L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
           attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
       }).addTo(map);

       L.marker([lat, lng]).addTo(map)
           .bindPopup(description)
           .openPopup();
    </script>
<?php
require ('footer.php');
?>