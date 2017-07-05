
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
    var_dump($error);

}
?>
<?php
require ('header.php');
?>
<fieldset class="form-group">
    <legend>Se connecter</legend>

    <form method="POST" class="form-horizontal" action="">
    <div class="form-group">
        <label class="control-label col-sm-2" for="prenom">entre votre prenom:</label>
        <div class="col-sm-10">
                <input type="text" name="prenom" class="form-control" placeholder="prenom" id="prenom"/>
        </div></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nom">entre votre nom:</label>
        <div class="col-sm-10">
        <input type="text" name="nom" class="form-control" placeholder="nom"id="nom"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">entre votre email:</label>
        <div class="col-sm-10">
        <input type="text" name="email" class="form-control"placeholder="email" id="email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pass">entre votre mote de passe:</label>
        <div class="col-sm-10">
        <input type="password" name="pass" class="form-control"placeholder="mote de passe" id="pass"/>
        </div>
    </div>

    <div class="form-group">
        <input class="col-sm-offset-4 btn btn-info btn-lg"  type="submit"  value="sign in"/>
        <button class="col-sm-offset-2  btn btn-success btn-lg" type="submit"  name="home">retour home</button>
    </div>

</fieldset>

<?php
require ('footer.php');
?>