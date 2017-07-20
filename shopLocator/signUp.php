
<!DOCTYPE html>

<?php
if(isset($_POST['home'])){
    header("Location:home.php");
    exit();

}
include ('config.php');
if(!empty($_POST)) {

    $error = array();
    if (empty($_POST['nom']) ) {
        $error['nom'] = "nom invalide";
    }
    if (empty($_POST['prenom']) ) {
        $error['prenom'] = "prenom invalide";
    }
    if (empty($_POST['email'])) {
        $error['email'] = "email invalide";
    }
    if (empty($_POST['pass'])) {
        $error['pass'] = "pass invalide";
    }
    if($_POST['pass']!=$_POST['pass2']){
        $error['pass'] = "pass invalide";
    }
    if(empty($error)){

        $nom=$prenom=$email=$pass='';

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $nom = test_input($_POST['nom']);
            $prenom = test_input($_POST['prenom']);
            $email=test_input($_POST['email']);
            $pass=md5($_POST['pass']);

        }


        try{
            $requete=$bdd->prepare(
                "INSERT INTO login(nom,prenom,email,pass)
                  VALUES (:nom,:prenom,:email,:pass)"
            );
            $requete->bindParam(':nom',$nom);
            $requete->bindParam(':prenom',$prenom);
            $requete->bindParam(':email',$email);
            $requete->bindParam(':pass',$pass);

            $result=$requete->execute();
            session_start();
            $_SESSION['auth']=$result;
            header("Location:principal.php?welcom=1&nom=".$nom);

        }
        catch(PDOException $e ){
            echo "echec:".$e->getMessage();



        }
    exit( );
    }


}
?>
<?php
require ('header.php');
?>
<fieldset class="form-group">
    <legend>  Insciption</legend>

    <form method="POST" class="form-horizontal" action="">
    <div class="form-group">
        <label class="control-label col-sm-2" for="prenom">Prenom :</label>
        <div class="col-sm-10">
                <input type="text" name="prenom" class="form-control" placeholder="entrez votre prenom" id="prenom"/>
        </div></div>

        <div class="form-group">
        <label class="control-label col-sm-2" for="nom">Nom :</label>
        <div class="col-sm-10">
        <input type="text" name="nom" class="form-control" placeholder="entrez votre nom"id="nom" required/>
            <span class="col-sm-10" id='missPrenom'></span><br>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email"> Mail :</label>
        <div class="col-sm-10">
        <input type="text" name="email" class="form-control"placeholder="entrez votre email" id="email" required/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pass">Mote de passe :</label>
        <div class="col-sm-10">
        <input type="password" name="pass" class="form-control"placeholder="mote de passe" id="pass" required/>
        </div>
    </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pass2">Rentrez votre mote de passe :</label>
            <div class="col-sm-10">
                <input type="password" name="pass2" class="form-control"placeholder="mote de passe" id="pass2" required/>
            </div>
        </div>

    <div class="form-group">
        <input class="col-sm-offset-4 btn btn-info btn-lg"  type="submit" id="bouton_envoi" value="inscription"/>
        <button class="col-sm-offset-2  btn btn-success btn-lg" type="submit"  name="home">Retour Accueil  <span class="glyphicon glyphicon-share-alt"></span></button>
    </div>

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