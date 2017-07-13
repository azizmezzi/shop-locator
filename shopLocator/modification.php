<?php
session_start();
require ('config.php');
logged();
$id= $_GET["numid"];

$req=$bdd->prepare("
SELECT * FROM shop WHERE `id`=:id    ");
$req->bindParam(":id",$id);
$req->execute();
$jour=$longititude=$attitude=$titre = $adresse = $type = $heur  = $pays = $ville = $code = '';

while($donnees=$req->fetch())

{$titre = ($donnees["titre"]);
$adresse = ($donnees["adresse"]);
$type = ($donnees["type"]);
$code = ($donnees["code postal"]);
$pays = ($donnees["pays"]);
$ville = ($donnees["ville"]);
$attitude = ($donnees["attitude"]);
$longititude = ($donnees["longititude"]);
$heur = ($donnees["heur ouverture"]);
$jour = ($donnees["jour ouverture"]);}
?>

<?php
try {
if (isset($_POST['env'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!empty($_POST["titre"])) {$titre = test_input($_POST["titre"]);}
        if(!empty($_POST["adresse"])) {$adresse = test_input($_POST["adresse"]);}
        if(!empty($_POST["type"])){$type = test_input($_POST["type"]);}
        if(!empty($_POST["code"])){$code = test_input($_POST["code"]);}
        if(!empty($_POST["pays"])){$pays = test_input($_POST["pays"]);}
        if(!empty($_POST["ville"])){$ville = test_input($_POST["ville"]);}
        if(!empty($_POST["attitude"])){$attitude = test_input($_POST["attitude"]);}
        if(!empty($_POST["longititude"])){$longititude = test_input($_POST["longititude"]);}
        if(!empty($_POST["heur"])){$heur = test_input($_POST["heur"]);}
        if(!empty($_POST["jour"])){$jour = $_POST["jour"];}

    }

    $requet = $bdd->prepare("
    UPDATE `shop` 
    SET `titre`=:titre,
    `type`=:type,
    `adresse`=:adresse,
    `code postal`=:code ,
    `pays`=:pays,
    `ville`=:ville,
    `attitude`=:attitude,
    `longititude`=:longititude,
    `heur ouverture`=:heur ,
    `jour ouverture`=:jour
      WHERE `id`= :id ");
    $requet->bindParam(":titre",$titre);
    $requet->bindParam(":type",$type);
    $requet->bindParam(":adresse",$adresse);
    $requet->bindParam(":id",$id);
    $requet->bindParam(":code",$code);
    $requet->bindParam(":pays",$pays);
    $requet->bindParam(":ville",$ville);
    $requet->bindParam("attitude",$attitude);
    $requet->bindParam("longititude",$longititude);
    $requet->bindParam(":heur",$heur);
    $requet->bindParam(":jour",$jour);

    $requet->bindParam(":id",$id);
    $resultat=$requet->execute();
    if($resultat!=0){

        header("Location: principal.php?update=1");
    }
    }



}
catch(PDOException $e){
    echo 'echec'.$e->getMessage();
}





while($donnees=$req->fetch()) {
    $titre = ($donnees["titre"]);
    $adresse = ($donnees["adresse"]);
    $type = ($donnees["type"]);
    $code = ($donnees["code postal"]);
    $pays = ($donnees["pays"]);
    $ville = ($donnees["ville"]);
    $attitude = ($donnees["attitude"]);
    $longititude = ($donnees["longititude"]);
    $heur = ($donnees["heur ouverture"]);

}



?>
<?php
require ('header2.php');
?>
<fieldset class="form-group">
    <legend>Modification</legend>


<form  method="post"  class="form-horizontal">

    <div class="form-group">
        <label class="control-label col-sm-2" for="titre" >Nom ** : </label>
        <div class="col-sm-10">
        <input  type="text" name="titre"  value="<?php echo $titre?>"id="nom">
            <span class="col-sm-10" id='missPrenom'></span><br>

        </div></div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="type">Type :</label>
        <div class="col-sm-10">
        <select name="type" id="type">
            <option value="market" >market</option>
            <option value="express" >express</option>
            <option value="outlet"  >outlet</option>
        </select>
        </div></div>
    <fieldset class="col-sm-offset-1">
        <legend>Adresse :</legend>
    <div class="form-group">
        <label class="control-label col-sm-2" for="adresse">Adresse **:</label>
             <div class="col-sm-10">
                 <input type="text" name="adresse"  value="<?php echo $adresse?>"id="adresse">
        </div>
    </div>
    <div class="form-group">  <label class="control-label col-sm-2" for="code">Code postal **:</label>
        <div class="col-sm-10">

        <input type="text" name="code"  value="<?php echo $code?>" id="code">
        </div></div>
    <div class="form-group ">  <label class="control-label col-sm-2" for="pays">Pays **:</label>
        <div class="col-sm-10">
        <input  type="text" name="pays"  value="<?php echo $pays?>" id="pays">
        </div></div>
    <div class="form-group">  <label class="control-label col-sm-2" for="ville">Ville **:</label>
        <div class="col-sm-10">
        <input type="text" name="ville"  value="<?php echo $ville?>" id="ville">
        </div></div>
    </fieldset>
    <div class="form-group">  <label class="control-label col-sm-2"for="attitude">Attitude **:</label>
        <div class="col-sm-10">
            <input type="text" name="attitude" value="<?php echo $attitude?>" id="attitude">
        </div></div>
    <div class="form-group">  <label class="control-label col-sm-2"for="longititude"> Longititude **:</label>
        <div class="col-sm-10">
            <input type="text" name="longititude" value="<?php echo $longititude?>" id="longititude">
        </div></div>
    <div class="form-group">  <label class="control-label col-sm-2"for="heur">Heure d'ouverture :</label>
        <div class="col-sm-10">
        <input type="text" name="heur"  value="<?php echo $heur?>" id="heur">
        </div></div>
    <div class="form-group">  <label class="control-label col-sm-2" for="jour">Jours :</label>
        <div class="col-sm-10">
        <select name="jour" id="jour"multiple>
            <option value="lundi"  >lundi</option>
            <option value="mardi"  >mardi</option>
            <option value="mercredi"  >mercredi</option>
            <option value="jeudi"  >jeudi</option>
            <option value="vendredi"  >vendredi</option>
            <option value="samdi"  >samdi</option>
            <option value="dimanche"  >dimanche</option>
        </select>
        </div>
    </div>
    <div class="form-group" >
        <input type="submit" name="env" id="bouton_envoi" value="modification " class="col-sm-offset-4 btn btn-info btn-lg"  />
    </div>
</form>
</fieldset>

    <script>
        var formValid = document.getElementById('bouton_envoi');
        var nom = document.getElementById('nom');
        var missPrenom = document.getElementById('missPrenom');
        var prenomValid = /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/;

        formValid.addEventListener('click', validation);

        function validation(event){
            //Si le champ est vide
            if (nom.validity.valueMissing) {
                event.preventDefault();
                missPrenom.textContent = 'Nom manquant';
                missPrenom.style.color = 'red';
                //Si le format de données est incorrect
            }else if(prenomValid.test(nom.value)==false){

                event.preventDefault();
                missPrenom.textContent = 'format incorrect';
                missPrenom.style.color = 'orange';
            }else{

            }
        }
    </script>
<?php
require ('footer.php');
?>