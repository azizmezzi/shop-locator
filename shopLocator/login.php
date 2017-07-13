<?php
if(isset($_POST['home'])){
header("Location:home.php");
exit();

}
session_start();

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

<?php
require ('header.php');
?>
<form method="post" class="form-horizontal" >
    <fieldset>
        <legend >Se connecter</legend>
        <div class="form-group">
        <label class="control-label col-sm-2" for="nom">nom:</label>
            <div class="col-sm-10">
        <input  type="text" name="nom"class="form-control" placeholder="Identification">
        </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2"for="pass">mote de passe:</label>
            <div class="col-sm-10">
        <input   type="password" name="pass" class="form-control" placeholder="Mote de passe">
        </div>
        </div>
        <div class="form-group">
        <button class="col-sm-offset-4 btn btn-info btn-lg" type="submit" >submit</button>
        <input  type="submit" name="home" class="col-sm-offset-2  btn btn-success btn-lg" value="home">
        </div ></fieldset>
</form>
<?php
require ('footer.php');
?>