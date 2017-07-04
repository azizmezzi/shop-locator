<?php
if(isset($_POST['home'])){
header("Location:home.php");
exit();

}
session_start();
require "auth.php";

if(!empty($_POST)) {
        $error = array();
        if (empty($_POST['nom']) )
         {
          $error['nom'] = "nom invalide";
           }
        if (empty($_POST['pass'])  )
           {
        $error['pass'] = "password invalide";
           }  if(empty($error)){
            if(!empty($_POST)&&!empty($_POST['nom'])&&!empty($_POST['pass']))
            {
            $pass=md5($_POST['pass']);
            $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
            $req=$bdd->prepare("
             SELECT * FROM login   WHERE (nom=:nom OR email=:email) AND pass=:pass  ");
            $req->bindParam(':nom',$_POST['nom']);
            $req->bindParam(':email',$_POST['nom']);

                $req->bindParam(':pass',$pass);
            $req->execute();
            $data=$req->fetchAll();
            if(count($data)>0   )
            {
                $_SESSION['auth']=$data;
                header("Location:principal.php?welcom=1&nom=".$_POST['nom']);
            }else {

                echo "mauvais identifiant";
            }
        }

    }
    var_dump($error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <meta charset="UTF-8">

</head>
<body>
<?php

?>
<form method="post" >
    <fieldset>
        <legend>Se connecter</legend>
        <input type="text" name="nom" placeholder="Identification">
        <input type="text" name="pass" placeholder="Mote de passe">
        <button type="submit" >submit</button>
        <input type="submit" name="home" value="home">
    </fieldset>
</form>
</body>
</html>