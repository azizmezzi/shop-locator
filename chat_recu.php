<?php


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
try{
    $bdd=new PDO("mysql:host=127.0.0.1;dbname=chat",'root','root');
    $req=$bdd->prepare(
        "INSERT INTO chat(pseudo,message) VALUES (:pseudo,:message)");
    $pseudo=test_input($_POST['pseudo']);
    $message=test_input($_POST['message']);
    $req->bindParam(':pseudo',$pseudo);
    $req->bindParam(':message',$message);
    $req->execute();
    header("Location:chat.php");
}
catch(PDOException $e){
    die('Erreur : '.$e->getMessage());
}
?>