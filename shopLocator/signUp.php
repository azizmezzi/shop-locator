
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
<html>
<head>
    <title>sign up</title>
    <meta charset="UTF-8">
</head>
<body>

<fieldset>
    <legend>Se connecter</legend>

    <form method="POST" action="">
    <p>
        <label for="prenom">entre votre prenom:</label>
        <input type="text" name="prenom" id="prenom"/>
    </p>
    <p>
        <label for="nom">entre votre nom:</label>
        <input type="text" name="nom" id="nom"/>
    </p>
    <p>
        <label for="email">entre votre email:</label>
        <input type="text" name="email" id="email"/>
    </p>
    <p>
        <label for="pass">entre votre mote de passe:</label>
        <input type="password" name="pass" id="pass"/>
    </p>

    <p>
        <input type="submit" value="sign in"/>
        <br/>
        <button type="submit" name="home">retour home</button>
    </p>

</fieldset>

</body>
</html>