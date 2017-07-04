<?php
if(isset($_POST['home'])){
    header("Location:home.php");
    exit();

}
        $nom=$prenom=$email=$pass='';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nom = test_input($_POST['nom']);
    $prenom = test_input($_POST['prenom']);
    $email=test_input($_POST['email']);
    $pass=md5($_POST['pass']);

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$serveur="localhost";
$login="root";
$password="root";
try{
    $connetion=new PDO("mysql:host=127.0.0.1;dbname=shop",$login,$password);
    $connetion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $requete=$connetion->prepare(
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
    header("Location:principal.php");

}
catch(PDOException $e ){
    echo "echec:".$e->getMessage();



}
?>