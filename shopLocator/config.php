<?php
function test_input($dat)
{
$data = trim($dat);
$data = stripslashes($dat);
$data = htmlspecialchars($dat);
return $dat;
}
$bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function update($requet){
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
    $req=$bdd->prepare($requet);

    return $req->execute();
}
function connection()
{
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $bdd;
}
function logged(){
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth']))
    {
        header('Location:login.php');
        exit();
    }
}

?>