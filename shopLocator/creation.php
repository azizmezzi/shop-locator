
<?php
session_start();
require ('config.php');
logged();


if(!empty($_POST))
{
   $attitude= $longititude=$titre=$adresse=$type=$heur=$jour=$pays=$ville=$code='';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = test_input($_POST["titre"]);
        $adresse=test_input($_POST["adresse"]);
        $type = test_input($_POST["type"]);
        $code = test_input($_POST["code"]);
        $pays=test_input($_POST["pays"]);
        $ville = test_input($_POST["ville"]);
        $attitude = test_input($_POST["attitude"]);
        $longititude = test_input($_POST["longititude"]);
        $heur=test_input($_POST["heur"]);
        $jour=test_input($_POST["jour"]);


    }
    try {
        $requet = $bdd->prepare("
    INSERT INTO shop(`titre`,`adresse`,`type`,`code postal`,`pays`,`ville`,`attitude`,`longititude`,`heur ouverture`,`jour ouverture`)
    VALUES (:titre,:adresse,:type,:code ,:pays,:ville,:attitude,:longititude,:heur ,:jour ) ");
        $requet->bindParam("titre",$titre);
        $requet->bindParam("adresse",$adresse);
        $requet->bindParam("type",$type);
        $requet->bindParam("code",$code);
        $requet->bindParam("pays",$pays);
        $requet->bindParam("ville",$ville);
        $requet->bindParam("attitude",$attitude);
        $requet->bindParam("longititude",$longititude);
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
<?php
require ('header2.php');
?>

<fieldset class="form-group">
    <legend>Creation </legend>


    <form  method="post"  class="form-horizontal">

        <div class="form-group">
            <label class="control-label col-sm-2" for="titre" >Nom : </label>
            <div class="col-sm-10">
                <input  type="text" name="titre" id="nom" required>
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
                <label class="control-label col-sm-2" for="adresse">Adresse :</label>
                <div class="col-sm-10">
                    <input type="text" name="adresse"  id="adresse"required>
                </div>
            </div>
            <div class="form-group">  <label class="control-label col-sm-2" for="code">Code postal :</label>
                <div class="col-sm-10">

                    <input type="text" name="code"   id="code" required>
                </div></div>
            <div class="form-group ">  <label class="control-label col-sm-2" for="pays">Pays :</label>
                <div class="col-sm-10">
                    <input  type="text" name="pays"   id="pays"required>
                </div></div>
            <div class="form-group">  <label class="control-label col-sm-2" for="ville">Ville :</label>
                <div class="col-sm-10">
                    <input type="text" name="ville"  id="ville"required>
                </div></div>
        </fieldset>
        <div class="form-group">  <label class="control-label col-sm-2"for="attitude">Attitude :</label>
            <div class="col-sm-10">
                <input type="text" name="attitude"  id="attitude"required>
            </div></div>
        <div class="form-group">  <label class="control-label col-sm-2"for="longititude"> <L></L>ongititude :</label>
            <div class="col-sm-10">
                <input type="text" name="longititude"  id="longititude"required>
            </div></div>
        <div class="form-group">  <label class="control-label col-sm-2"for="heur"required>Heure d'ouverture :</label>
            <div class="col-sm-10">
                <input type="text" name="heur"  id="heur">
            </div></div>
        <div class="form-group">  <label class="control-label col-sm-2" for="jour"required>Jours :</label>
            <div class="col-sm-10">
                <select class="selectpicker" name="jour" id="jour" multiple>
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
            <input type="submit" name="env" id="bouton_envoi" value="Creation " class="col-sm-offset-4 btn btn-info btn-lg"  />
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