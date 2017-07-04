<!DOCTYPE html>
<html>
<head>
    <title>PHP & MYSQL</title>
</head>
<body>
<?php
// define variables and set to empty values
$nom=$prenom=$mail='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = test_input($_POST["nom"]);
    $prenom = test_input($_POST["prenom"]);
    $mail = test_input($_POST["mail"]);


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    nom:    <input type="'text" name="nom"><br/>
    prenom: <input type="text" name="prenom"><br/>
    mail: <input type="text" name="mail"><br/>
    <input type="submit" name="submit" value="submit">
</form>
    <?php
    $serveur="localhost";
    $login="root";
    $pass="root";
    try{
    $connetion=new PDO("mysql:host=$serveur;dbname=test2",$login,$pass);
    $connetion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $requete=$connetion->prepare(
        "INSERT INTO visiteur(nom,prenom,mail)
                  VALUES (:nom,:prenom,:mail)"
    );
    $requete->bindParam(':nom',$nom);
    $requete->bindParam(':prenom',$prenom);
    $requete->bindParam(':mail',$mail);

    $requete->execute();

    }
    catch(PDOException $e ){
        echo "echec:".$e->getMessage();

        }



?>
</body>
</html>